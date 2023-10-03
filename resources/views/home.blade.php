<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data xmlns:x-moonshine="http://www.w3.org/1999/xlink">
<head>
    @moonShineAssets
</head>
<body
    class="antialiased"
    x-cloak
    x-data="{ minimizedMenu: $persist(false).as('minimizedMenu'), asideMenuOpen: false }"
>
<div class="layout-wrapper layout-wrapper--top-menu">
    <aside class="layout-menu-horizontal" :class="asideMenuOpen && '_is-opened'">
        <div class="menu-logo">
            <a href="{{ route('home') }}" class="block" rel="home">
                <img src="{{ config('moonshine.logo') ?: asset('vendor/moonshine/logo.svg') }}" class="hidden h-14 xl:block" :class="minimizedMenu &amp;&amp; '!hidden'" alt="MoonShine">
                <img src="{{ config('moonshine.logo_small') ?: asset('vendor/moonshine/logo-small.svg') }}" class="block h-8 lg:h-10 xl:hidden" :class="minimizedMenu &amp;&amp; '!block'" alt="MoonShine">
            </a>
        </div>

        <nav class="menu-navigation">
            <ul class="menu-inner">
                <li class="menu-inner-item ">
                    <a href="{{ route('moonshine.index') }}"
                       class="menu-inner-link"
                       x-data="navTooltip"
                       @mouseenter="toggleTooltip()"
                    >
                        <span class="menu-inner-text">Документация</span>

                        <span class="menu-inner-counter">В процессе</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="layout-page" style="
        background-image: url('/images/home.png');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    ">
        <x-moonshine::grid>
            <x-moonshine::column colSpan="6">
                <x-moonshine::title>MoonShine 2.0.0.alpha.1</x-moonshine::title>
                <x-moonshine::link filled class="w-full" href="{{ route('moonshine.index') }}">
                    Начать
                </x-moonshine::link>
                <x-moonshine::link class="w-full" href="https://github.com/moonshine-software/moonshine">
                    Исходный код
                </x-moonshine::link>
            </x-moonshine::column>
        </x-moonshine::grid>

    </main>
</div>

@include('moonshine::ui.img-popup')
@include('moonshine::ui.toasts')

@stack('scripts')
</body>
</html>
