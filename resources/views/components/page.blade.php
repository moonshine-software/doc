@props([
    'title',
    'videos' => [],
    'sectionMenu' => []
])
<x-moonshine::alert type="success">
    @if(app()->currentLocale() === 'ru')
        Вы просматриваете документацию старой версии MoonShine.
        Рассмотрите возможность обновления вашего проекта до
    @else
        You're browsing the documentation for an old version of MoonShine.
        Consider upgrading your project to
    @endif

    <a href="https://moonshine-laravel.com">MoonShine 2.x.</a>
</x-moonshine::alert>

<x-video :data="$videos"/>
<x-menu :data="$sectionMenu"></x-menu>
<div>
    {{ $slot }}

    <x-page-nav />
</div>
