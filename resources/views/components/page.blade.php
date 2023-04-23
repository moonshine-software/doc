@props([
    'title',
    'videos' => [],
    'sectionMenu' => []
])
<x-video :data="$videos"/>
<x-menu :data="$sectionMenu"></x-menu>
<div>
    {{ $slot }}

    <x-next />
</div>
