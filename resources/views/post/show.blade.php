<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-5xl font-bold mb-4">{{ $post->title }}</h1>
                <div class="flex gap-4">
                    <x-user-avatar :user="$post->user" class="w-12 h-12" />

                    <div>

                        <x-follow-ctr :user="$post->user" class="flex gap-2">
                            <a class="" href="{{ route('profile.show', $post->user->username) }}">
                                <h3 class="text-gray-600 dark:text-gray-400 hover:underline">{{ $post->user->name }}</h3>
                            </a>

                           @if (auth()->check() && auth()->id() !== $post->user_id)

                            &middot;
                                <button href="" x-text="following ? 'Unfollow' : 'Follow'" @click="follow()"
                                    :class="following ? 'text-red-600 hover:text-red-700' :
                                        'text-emerald-600 hover:text-emerald-700'">Follow</button>
                            @endif
                        </x-follow-ctr>
                        <div class="flex gap-2 text-sm text-gray-500">
                            {{ $post->readTime() }} minutes read &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>

                    </div>
                </div>
                @if ($post->user_id === auth()->id())

                <div class="py-4 mt-4 border-t border-gray-200">
                    <x-primary-button href="{{ route('post.edit', ['post' => $post->slug,
                    'username' => $post->user->username]) }}">
                        Edit Post
                    </x-primary-button>
                    <form action="{{ route('post.destroy', $post) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')

                    <x-danger-button>
                        Delete Post
                    </x-danger-button>
                    </form>
                </div>
                @endif

                <x-clap-button :post="$post" />

                <div class="mt-6">
                    @if ($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-auto rounded-lg mb-4">
                    @endif

                    <div class="prose dark:prose-invert">
                        {!! $post->content !!}
                    </div>
                </div>


                <div class="mt-8">

                    <a href="" class="inline-block bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">
                        {{ $post->category->name }}
                    </a>
                </div>

                <div class="mt-10">
                    <x-clap-button :post="$post" />

                </div>
            </div>
        </div>
</x-app-layout>
