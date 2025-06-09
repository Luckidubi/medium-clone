
    <div class="flex flex-col-reverse lg:flex-row  bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mb-6 mx-2 md:mx-0">

        <div class="p-5 flex-1">
            <a href="{{route('post.show', [
            'username' => $post->user->username,
            'post' => $post->slug
            ])}}">
                <h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $post->title }}</h5>
            </a>
            <p class="mb-3 text-xs md:text-xl font-normal text-gray-700 dark:text-gray-400">
                {{ Str::words($post->content, 20) }}</p>

            <div class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">

            <x-user-avatar :user="$post->user" class="w-5 h-5 md:w-6 md:h-6" />
                <a class="hover:underline" href="{{ route('profile.show', ['username' => $post->user->username]) }}">
                    <span class="font-semibold">{{ $post->user->name }}</span>
                    &middot;
                </a>

                {{ $post->created_at->format('M d, Y') }}
                &middot;
                <span class="inline-flex items-center gap-1">
                    <img  src="{{ asset('clap-filled.svg') }}" alt="" class="w-4 h-4 opacity-60"/>
                    <span class="text-gray-500 dark:text-gray-400">{{ $post->claps()->count() }}</span>
                </span>
            </div>
        </div>
        <a href="" class="">
            <img class="w-full lg:w-48  min-h-full object-cover rounded-r-lg" src="{{ Storage::url($post->image) }}"
                alt="" />
        </a>
    </div>
