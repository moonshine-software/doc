@props([
    'hashtag' => '#'
])
<h2 {{ $attributes }} class="mb-4 mt-8 text-xl font-bold">
    <a href="{{ $attributes['id'] ? '#' . $attributes['id'] : '' }}">
        @include('moonshine::ui.badge', [
            'value' => $hashtag,
            'color' => 'purple'
        ])
        {{ $slot }}
    </a>
</h2>
