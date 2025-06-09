<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col lg:flex-row items-start gap-4 md:gap-8 h-full">
                    <div class="flex-1 w-full max-w-3xl lg:pr-8 mb-7">
                        <h1 class="font-bold text-xl md:text-5xl">{{ $user->name }}</h1>
                        <div class="flex flex-col items-center mt-8">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post" />

                            @empty
                                <div class="text-center text-gray-500">
                                    <p>No posts available.</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <div class="lg:w-[1/3] w-[1/2] lg:border-l  border-gray-200 px-4 lg:px-8 lg:ml-auto mt-8">

                        <x-follow-ctr :user="$user" class="flex flex-col items-start gap-1 md:gap-2">
                            <x-user-avatar :user="$user" size="w-10 h-10 md:w-24 md:h-24 mb-2 md:mb-4" />
                            <h3 class="text-gray-800 text-sm dark:text-gray-400 md:text-xl">{{ $user->name }}</h3>
                            <p class="text-gray-500 text-sm md:text-xl"><span x-text="followersCount"></span> followers
                            </p>
                            <p class="text-sm md:text-md">{{ $user->bio }}</p>
                            <div>
                                @if (Auth::user() && Auth::user()->id !== $user->id)
                                    <button @click="follow()" x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-red-600 hover:bg-red-700' :
                                            'bg-emerald-600 hover:bg-emerald-700'"
                                        class=" text-sm md:text-xl text-white px-2 py-1 md:px-4 md:py-2 rounded-lg  transition-colors">

                                    </button>
                                @endif
                            </div>
                        </x-follow-ctr>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
