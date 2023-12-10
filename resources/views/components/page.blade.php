@props([
    'title',
    'videos' => [],
    'sectionMenu' => []
])
<x-video :data="$videos"/>
<x-menu :data="$sectionMenu"></x-menu>
<article>
    {{ $slot }}

    <x-page-nav />
</article>
