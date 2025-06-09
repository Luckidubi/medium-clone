@props(['href' => null])
@if ($href)
    <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center md:px-4 px-2 md:py-2 py-1 bg-gray-800 border border-transparent rounded md:rounded-md font-semibold text-xs text-white uppercase md:tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>

@else


<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center md:px-4 px-2 md:py-2 py-1 bg-gray-800 border border-transparent rounded md:rounded-md font-semibold text-xs text-white uppercase md:tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

@endif
