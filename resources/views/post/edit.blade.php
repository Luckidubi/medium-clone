<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h2 class="text-3xl font-semibold mb-4">Update Post: {{ $post->title }}</h2>

                <form action="{{ route('post.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf


                    @if ($post->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}'s image"
                                class="w-full h-auto rounded-lg my-6">
                        </div>
                    @endif

                    <div class="mb-6">

                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                            :value="old('image')"  autofocus autocomplete="image" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mb-6">

                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $post->title)" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-6">

                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category_id"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow h-10 p-2"
                            required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-textarea name="content" id="content" rows="4" required autocomplete="content"
                            class="block mt-1 w-full">{{ old('content', $post->content) }}</x-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                     <div class="mb-6">

                        <x-input-label for="published_at" :value="__('Published At')" />
                        <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local" name="published_at"
                            :value="old('published_at', $post->published_at)" required autofocus autocomplete="published_at" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Update Post') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
