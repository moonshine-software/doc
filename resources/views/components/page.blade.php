@props([
    'title',
    'videos' => [],
    'sectionMenu' => []
])
<x-video :data="$videos"/>
<x-menu :data="$sectionMenu"></x-menu>
<article class="DocSearch-content">
    {{ $slot }}

    <x-page-nav />
</article>
