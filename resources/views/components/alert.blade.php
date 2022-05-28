<div class="{{ $color ?? 'bg-darkblue' }} text-white text-sm rounded shadow-sm px-4 py-2 mb-4">
    <div class="container">
        @if(isset($title)) <div class="text-lg">{{ $title }}</div> @endif

        <x-p>{!! $slot !!}</x-p>
    </div>
</div>
