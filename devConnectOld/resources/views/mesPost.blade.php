
<x-app-layout>
    <x-navBar/>
    <h1>test</h1>
    <h1 class="text-2xl font-bold ml-8 mt-8">My Posts</h1>

    <div class="flex flex-col space-y-4">
        @foreach ($posts as $post)
            <div class="mx-auto w-3/4 post_box flex flex-col rounded-lg border border-gray-200 bg-white px-4 py-4 hover:bg-gray-50">
            <div class="flex justify-end mb-5 space-x-4">
                    <a href="{{ route('post.edit',$post->id) }}" class="text-blue-500">Edit</a>
                    
                    <form action="{{ route('post.delete',$post->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce post ?');">

                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="cursor-pointer text-red-500">
                    </form>
                </div>
                
                <p class="text-gray-700">{{ $post->content }}</p>
                <span class="text-gray-500 text-sm">Publié le {{ $post->created_at->format('d/m/Y') }}</span>
            </div>
        @endforeach
    </div>
</x-app-layout>





















