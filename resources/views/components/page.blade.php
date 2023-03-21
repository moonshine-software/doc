@props([
    'title',
    'sectionMenu' => []
])

<x-menu :data="$sectionMenu"></x-menu>
<div>
    {{ $slot }}

    <x-next />
</div>
