<x-app-layout>

    <div class="bg-gray-50">
        <!-- Navigation -->
        <x-navBar />
      
        
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto pt-32 px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Profile Card -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="relative">
                            <div class="h-24 bg-gradient-to-tr from-blue-800 to-purple-700"></div>
                            @if(!empty($user->picture))
                            <div class="flex-shrink-0">
                                <img src="{{Storage::url($user->picture)}}" alt="Profile picture"
                                    class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-white shadow-md">
                            </div>
                            @else
                            <img src="https://avatar.iran.liara.run/public/boy" alt="Profile"
                                class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-white shadow-md" />
                            @endif
                        </div>
                        <div class="pt-14 p-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                                <a href="https://github.com" target="_blank" class="text-gray-600 hover:text-black">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                    </svg>
                                </a>
                            </div>
                            <!-- <p class="text-gray-600 text-sm mt-1">Senior Full Stack Developer</p>
                            <p class="text-gray-500 text-sm mt-2">Building scalable web applications with modern technologies</p> -->
                            <p class="text-gray-500 text-sm mt-2">{{ $user->Bio }} </p>

                            @if($user->skills)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($user->skills as $skill)
                                <span class="px-2 py-1 bg-purple-100 text-purple-900 rounded-full text-xs">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                            @endif

                            <div class="mt-4 pt-4 border-t">
                                <div class="flex justify-between text-sm">
                                    <!-- <form action=""> -->
                                    <a href="/connections">
                                        <span class="text-gray-500">Connections</span>
                                    </a>
                                    <span class="text-blue-600 font-medium">487</span>
                                    <!-- </form> -->
                                </div>
                                <div class="flex justify-between text-sm mt-2">
                                    <span class="text-gray-500">Posts</span>
                                    <span class="text-blue-600 font-medium">{{ $user->posts->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="bg-white rounded-xl shadow-sm p-4">
                        <h3 class="font-semibold mb-4">Trending Tags</h3>
                        <div class="space-y-2">
                            <!-- <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                                <span class="text-gray-600">#javascript</span>
                                <span class="text-gray-400 text-sm">2.4k</span>
                            </a>
                            <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                                <span class="text-gray-600">#react</span>
                                <span class="text-gray-400 text-sm">1.8k</span>
                            </a> -->
                            <a href="#" class="flex items-center justify-between hover:bg-gray-50 p-2 rounded">
                                <span class="text-gray-600"></span>
                                <span class="text-gray-400 text-sm">1.2k</span>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Main Feed -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Post Creation -->
                    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white rounded-xl shadow-sm p-4">
                            <div class="flex-col items-center space-x-4">

                                <!-- <button
                                 class="bg-gray-100 hover:bg-gray-200 text-gray-500 text-left rounded-lg px-4 py-3 flex-grow transition-colors duration-200">
                                 Share your knowledge or ask a question...
                             </button> -->
                                <label for="">Content</label>
                                <input type="text" name="content" class="w-full rounded-lg">
                            </div>

                            <div class="flex-col justify-between mt-4 pt-4 border-t">

                                <label for="">Code</label>
                                <textarea name="code" id="code" class="w-full rounded-lg"></textarea>

                                <label for="">image</label>
                                <input type="file" name="image" class="w-full px-3 py-2 border border-gray-500 rounded-lg">

                                <label for="">Link</label>
                                <input type="url" name="link" class="w-full rounded-lg">

                                <label for="">Tags</label>
                                <input type="text" name="tags" class="w-full rounded-lg">

                                <div class="flex justify-end mt-3">
                                    <button type="submit"
                                        class="bg-gradient-to-tr from-blue-800 to-purple-700 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Post</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Posts -->
                    @foreach($posts->sortByDesc('created_at') as $post)
                    <div class="bg-white rounded-xl shadow-sm">
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <a href="/userProfile/{{ $post->user->id }}">
                                        <img src="{{Storage::url($post->user->picture) }}" alt="User"
                                            class="w-12 h-12 rounded-full" />
                                    </a>
                                    <div>
                                        <h3 class="font-semibold">{{ $post->user->name }}</h3>
                                        <p class="text-gray-500 text-sm"> {{ $post->user->Bio }} </p>
                                        <p class="text-gray-400 text-xs">{{$post->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-2">
                                <p class="text-gray-700">{{ $post->content }}</p>
                                <a href="{{$post->link}}" class="text-bleu-500">{{$post->link}}</a>
                                @if(!empty($post->image))
                                <div class="flex-shrink-0">
                                    <img src="{{Storage::url($post->image)}}" alt="" class="w-full h-full object-cover rounded-lg">
                                </div>
                                @endif
                                @if(!empty($post->code))
                                <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200 ">
                                    <pre><code>{{ $post->code }}</code></pre>
                                </div>
                                @endif
                                @if($post->tags)
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                    <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded-full text-xs">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                @endif

                            </div>
                            <div class="mt-4 flex items-center justify-between border-t pt-4">
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('like.store', $post) }}" method="post">
                                        @csrf
                                        @if(session('likeBlue') === true)
                                        <button type="submit" class="flex items-center space-x-2 text-blue-500 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span>{{ $post->likes()->count() }}</span>
                                        </button>
                                        @else
                                        <button type="submit" class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span>{{ $post->likes()->count() }}</span>
                                        </button>
                                        @endif
                                    </form>
                                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <span>{{ $post->comments()->count() }}</span>
                                    </button>
                                </div>
                                <button class="text-gray-500 hover:text-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Comments Section -->
                            <div class="border-t border-gray-200 p-6">
                                <h3 class="text-xl font-bold mb-6">Comments</h3>
                                <div class="space-y-6">
                                    <!-- Comment Input -->
                                    <form action="{{ route('comment.store', $post->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                            <div class="flex-1">
                                                <textarea name="content" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Add to the discussion..."></textarea>
                                                <div class="flex justify-end">
                                                    <button type="submit" class="mt-2 bg-gradient-to-tr from-blue-800 to-purple-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Existing Comments -->
                                    @foreach($post->comments->sortByDesc('created_at') as $comment)
                                    <div class="flex items-start space-x-4 mt-4">
                                        <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                        <div class="flex-1">
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h4 class="font-semibold">{{ $comment->user->name }}</h4>
                                                    <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-gray-800">{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Right Sidebar -->
                    <div class="space-y-6">
                        <!-- Job Recommendations -->
                        <div class="bg-white rounded-xl shadow-sm p-4">
                            <h3 class="font-semibold mb-4">Job Recommendations</h3>
                            <div class="space-y-4">
                                <div class="p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                    <div class="flex items-start space-x-3">
                                        <img src="/api/placeholder/40/40" alt="Company" class="w-10 h-10 rounded" />
                                        <div>
                                            <h4 class="font-medium">Senior Full Stack Developer</h4>
                                            <p class="text-gray-500 text-sm">TechStart Inc.</p>
                                            <p class="text-gray-500 text-sm">Remote • Full-time</p>
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                <span
                                                    class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">React</span>
                                                <span
                                                    class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">Node.js</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                    <div class="flex items-start space-x-3">
                                        <img src="/apip/placeholder/40/40" alt="Company" class="w-10 h-10 rounded" />
                                        <div>
                                            <h4 class="font-medium">DevOps Engineer</h4>
                                            <p class="text-gray-500 text-sm">CloudScale Solutions</p>
                                            <p class="text-gray-500 text-sm">San Francisco • Hybrid</p>
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                <span
                                                    class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">AWS</span>
                                                <span
                                                    class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">Docker</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full text-blue-500 hover:text-blue-600 text-sm font-medium">
                                View All Jobs
                            </button>
                        </div>

                        <!-- Suggested Connections -->
                        <div class="bg-white rounded-xl shadow-sm p-4">
                            <h3 class="font-semibold mb-4">Suggested Connections</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://avatar.iran.liara.run/public/boy" alt="User"
                                            class="w-10 h-10 rounded-full" />
                                        <div>
                                            <h4 class="font-medium">Emily Zhang</h4>
                                            <p class="text-gray-500 text-sm">Frontend Developer</p>
                                        </div>
                                    </div>
                                    <button class="text-blue-500 hover:text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-pusher1/>
</x-app-layout>