@props(['href' => '#', 'transparent' => false])

<a {{ $attributes }}class="@if(!$transparent)
    bg-purple text-white hover:bg-pink focus-visible:outline-pink-300/50 active:bg-purple
@else border border-purple bg-transparent text-purple hover:bg-purple hover:text-white focus-visible:outline-white/50 active:text-purple @endif
    rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2"
   href="{{ $href }}"
>
    {{ $slot }}
</a>