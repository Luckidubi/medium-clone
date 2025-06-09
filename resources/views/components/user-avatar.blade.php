@props(['user', 'size' => 'w-10 h-10'])
 @if ($user->image)
     <img src="{{ Storage::url($user->image) }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full">
 @else
     <img src="{{ asset('avatar.png') }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full">
 @endif
