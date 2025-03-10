<x-app-layout>
 <div class="bg-gray-100">
    <x-navBar />

    <h1 class="text-2xl font-bold ml-8 mt-32">My Posts</h1>

    <div class="flex flex-col space-y-4">
        @foreach ($posts->sortByDesc('created_at') as $post)
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
            <a href="{{$post->link}}" class="text-bleu-500">{{$post->link}}</a>
            @if(!empty($post->image))
            <div class=" h-96 flex-shrink-0">
                <img src="{{Storage::url($post->image)}}" alt="" class="w-full h-full object-cover rounded-lg">
            </div>
            @endif
            @if(!empty($post->code))
            <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200 ">
                <pre><code>{{ $post->code }}</code></pre>
            </div>
            @endif
            <span class="text-gray-500 text-sm">Publié le {{ $post->created_at->format('d/m/Y') }}</span>
            @if($post->tags)
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{ $tag->name }}</span>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>