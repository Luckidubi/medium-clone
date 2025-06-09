      <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 justify-center">
          <li class="me-2">
              <a href="/" class="{{ Route::currentRouteName() == 'post.index' || Route::currentRouteName() == 'dashboard' || Route::currentRouteName() == 'profile.posts' ? "inline-block px-4 py-3 text-white bg-blue-600 rounded-lg active" : 'inline-block px-4 py-3 text-gray-400  dark:text-gray-500' }}"
                  aria-current="page">All</a>
          </li>


          @forelse ($categories as $category)
              <li>
                  <a href="{{ route('post.category', $category) }}"
                      class="inline-block px-4 py-3 text-gray-400  dark:text-gray-500 {{ Route::currentRouteName() == 'post.category' && Route::current()->parameter('category') == $category ? 'bg-blue-600 text-white rounded-lg' : ('') }}">{{ $category->name }}
                  </a>
              </li>
          @empty
              <li class="text-gray-500 dark:text-gray-400">
                  No categories available.
              </li>
          @endforelse
      </ul>
