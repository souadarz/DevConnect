<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skills;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        // dd($user);
        if ($request->filled('skills')) {
            $skills = explode(',', $request->skills);
            // dd($skills);
            foreach ($skills as $skill) {
                $skill = trim(strtolower($skill));
                $skill = Skills::firstOrCreate(['name' => $skill]);
                $request->user()->skills()->attach($skill->id);
            }

            // if ($request->hasFile('picture')) {
                // $picturePath = $request->file('picture')->store('profiles', 'public');
            
            $picturePath = $request->file('picture') ? $request->file('picture')->store('images', 'public') : null;
            $user->picture = $picturePath;

            if ($request->filled('Bio')) {
                $user->Bio = $request->Bio; 
            }
            $request->user()->save();
            // $user()->save();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
