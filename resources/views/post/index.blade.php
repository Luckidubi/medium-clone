<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <x-category-tabs />


                </div>
            </div>


            <div class=" text-gray-900 mt-8">
                @forelse ($posts as $post)
                    <x-post-item :post="$post" />

                @empty
                    <div class="text-center text-gray-500">
                        <p>No posts available.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
