<x-app-layout>
    <x-navBar />
    <h1 class="text-2xl font-bold m-8">Modify Post</h1>

    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
            <input type="text" name="content" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" value="{{ $post->content }}">
            <div class="w-48 h-48 flex-shrink-0">
                <img src="{{Storage::url($post->image)}}" alt="" class="w-full h-full object-cover rounded-lg">
            </div>
            <label for="link" class="block text-gray-700 font-bold mb-2 mt-4">link</label>
            <input type="text" name="link" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" value="{{ $post->link }}">
            <label for="image" class="block text-gray-700 font-bold mb-2 mt-4">image</label>
            <input type="file" name="image" class="w-full px-3 py-2 border border-gray-500 rounded-lg">
            <label for="code" class="block text-gray-700 font-bold mb-2  mt-4">Code</label>
            <textarea name="code" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none">{{ $post->code }}</textarea>
            <label for="tags" class="block text-gray-700 font-bold mb-2  mt-4">tags</label>
            <input type="text" name="tags" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
        </div>
    </form>
</x-app-layout>