<x-app-layout>
    <x-navBar/>
    <h1 class="text-2xl font-bold mb-4">Modify Post</h1>

    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
            <textarea name="content" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none ">{{ $post->content }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
        </div>
    </form>
</x-app-layout>