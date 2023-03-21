@props([
    'hashtag' => '#'
])
<h2 {{ $attributes }} class="my-4 text-xl font-bold">
    @include('moonshine::ui.badge', [
        'value' => $hashtag,
        'color' => 'purple'
    ])
    {{ $slot }}
</h2>
