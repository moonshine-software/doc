@props([
    'hashtag' => '#'
])
<h2 {{ $attributes }} class="mb-4 mt-8 text-xl font-bold">
    @include('moonshine::ui.badge', [
        'value' => $hashtag,
        'color' => 'purple'
    ])
    {{ $slot }}
</h2>
