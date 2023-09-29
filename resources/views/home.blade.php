<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data>
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
            <a href="http://127.0.0.1:8000/admin" class="block" rel="home">
                <img src="http://127.0.0.1:8000/vendor/moonshine/logo.svg" class="hidden h-14 xl:block" :class="minimizedMenu &amp;&amp; '!hidden'" alt="MoonShine">
                <img src="http://127.0.0.1:8000/vendor/moonshine/logo-small.svg" class="block h-8 lg:h-10 xl:hidden" :class="minimizedMenu &amp;&amp; '!block'" alt="MoonShine">
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
                        <span class="menu-inner-text">Documentation</span>

                        <span class="menu-inner-counter">2.0</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="layout-page">
        <h1 style="font-size: 32px;">Основной сайт скоро будет...</h1>
    </main>
</div>

@include('moonshine::ui.img-popup')
@include('moonshine::ui.toasts')

@stack('scripts')
</body>
</html>
