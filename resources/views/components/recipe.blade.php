@props([
    'title' => 'Рецепт',
    'id' => '',
])
<x-moonshine::alert id="{{ $id }}" type="primary" icon="heroicons.outline.book-open">
    {{ $title }}
</x-moonshine::alert>

{{ $slot }}
