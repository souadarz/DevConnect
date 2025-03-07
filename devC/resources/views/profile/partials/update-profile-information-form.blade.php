<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="w-full mx-auto p-6 bg-white shadow-lg rounded-lg flex flex-col md:flex-row gap-6">
        <div class="w-3/5 border">
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>

                <div>
                    <label for="picture">picture</label>
                    <input type="file" name="picture" class="w-full px-3 py-2 border border-gray-500 rounded-lg">
                </div>

                <div>
                    <x-input-label for="Bio" :value="__('Bio')" />
                    <textarea name="Bio" id="Bio" class="w-full rounded-lg"></textarea>
                </div>
                <div>
                    <x-input-label for="skills" :value="__('Skills')" />
                    <textarea name="skills" id="skills" class="w-full rounded-lg"></textarea>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
        <div class="w-full md:w-1/3 items-center text-center flex flex-col p-4 border rounded-lg">
            <img src="{{Storage::url($user->picture)}}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-700">
            <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-600 ">{{ $user->email }}</p>
            @if($user->Bio)
            <p class="mt-2 text-sm text-gray-700">Bio : {{ $user->Bio }}</p>
            @endif
            @if($user->skills)
            <div class="mt-4 flex flex-wrap gap-2">
                <span  class="text-gray-600" >Skills :</span>
                @foreach($user->skills as $skill)
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{ $skill->name }}</span>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</section>