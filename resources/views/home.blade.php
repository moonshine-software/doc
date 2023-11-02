<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Админ-панель для ваших Laravel проектов" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

    <!-- Theme settings -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#1A1B41" />
    <meta name="msapplication-TileColor" content="#1A1B41" />
    <meta name="theme-color" content="#1A1B41" />

    <style>
        [x-cloak] { display: none !important; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ openMobileMenu: false }" x-cloak>
    <!-- Site header -->
    <header class="header pt-6 2xl:pt-10">
        <div class="container">
            <div class="header-inner flex items-center justify-between gap-x-6 lg:gap-x-12 lg:justify-start">
                <div class="header-logo shrink-0">
                    <a href="{{ route('home') }}" class="relative w-[114px]" rel="home">
                        <img src="{{ Vite::asset('resources/images/logo-moon.svg') }}" class="animate-wiggle w-[67px] h-[70px]" alt="MoonShine" />
                        <img src="{{ Vite::asset('resources/images/logo-text.svg') }}" class="absolute top-1/2 left-[42px] z-2 -translate-y-1/2 w-[71px] h-[21px]" alt="MoonShine" />
                    </a>
                </div>
                <!-- /.header-logo -->
                <div class="header-menu hidden grow lg:block">
                    <nav class="hidden flex-wrap gap-10 2xl:flex">
                        @foreach(config('promo_menu', []) as $menu)
                            <a
                                href="{{ $menu['link'] }}"
                                class="font-semibold text-white hover:text-pink"
                            >
                                {{ $menu['title'] }}
                            </a>
                        @endforeach
                    </nav>
                </div>
                <!-- /.header-menu -->
                <div class="header-actions flex items-center">
                    <div class="flex items-center gap-x-2 sm:gap-x-3 md:gap-x-5">
                        {{--
                        <button type="button" class="text-white hover:text-pink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="m23.58 21.572-4.612-4.613a10.481 10.481 0 0 0 2.165-6.391c0-2.823-1.1-5.476-3.096-7.473A10.497 10.497 0 0 0 10.565 0a10.5 10.5 0 0 0-7.472 3.095c-4.12 4.12-4.12 10.825 0 14.945a10.497 10.497 0 0 0 7.472 3.096 10.48 10.48 0 0 0 6.392-2.166l4.612 4.613a1.419 1.419 0 0 0 2.011 0 1.423 1.423 0 0 0 0-2.011ZM5.104 16.029c-3.011-3.011-3.01-7.911 0-10.923a7.674 7.674 0 0 1 5.462-2.26 7.673 7.673 0 0 1 5.46 2.26 7.674 7.674 0 0 1 2.262 5.462 7.675 7.675 0 0 1-2.262 5.461 7.669 7.669 0 0 1-5.461 2.262 7.678 7.678 0 0 1-5.461-2.262Z"
                                />
                            </svg>
                        </button>
                        <div class="h-4 w-[1px] bg-white/25"></div>
                        --}}
                        <a href="{{ config('links.github') }}" class="text-white hover:text-pink" target="_blank" rel="noopener nofollow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 .5C5.37.5 0 5.78 0 12.292c0 5.211 3.438 9.63 8.205 11.188.6.111.82-.254.82-.567 0-.28-.01-1.022-.015-2.005-3.338.711-4.042-1.582-4.042-1.582-.546-1.361-1.335-1.725-1.335-1.725-1.087-.731.084-.716.084-.716 1.205.082 1.838 1.215 1.838 1.215 1.07 1.803 2.809 1.282 3.495.981.108-.763.417-1.282.76-1.577-2.665-.295-5.466-1.309-5.466-5.827 0-1.287.465-2.339 1.235-3.164-.135-.298-.54-1.497.105-3.121 0 0 1.005-.316 3.3 1.209.96-.262 1.98-.392 3-.398 1.02.006 2.04.136 3 .398 2.28-1.525 3.285-1.209 3.285-1.209.645 1.624.24 2.823.12 3.121.765.825 1.23 1.877 1.23 3.164 0 4.53-2.805 5.527-5.475 5.817.42.354.81 1.077.81 2.182 0 1.578-.015 2.846-.015 3.229 0 .309.21.678.825.56C20.565 21.917 24 17.495 24 12.292 24 5.78 18.627.5 12 .5Z"
                                />
                            </svg>
                        </a>
                        <div class="h-4 w-[1px] bg-white/25"></div>
                        {{--
                        <a href="#" class="flex items-center gap-x-2 text-white hover:text-pink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 fill-pink" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.502 6.422h-.301l-.562 2.812h1.425l-.562-2.812Zm11.375 5.625a7.35 7.35 0 0 0 1.154 2.037c.447-.561.898-1.222 1.201-2.037h-2.355Z" />
                                <path
                                    d="M21.89 4.266h-8.73l1.82 14.61c.033.597-.13 1.16-.52 1.6L11.374 24H21.89c1.163 0 2.11-.946 2.11-2.11V6.423c0-1.163-.947-2.156-2.11-2.156Zm0 7.78h-.187a8.922 8.922 0 0 1-1.694 3.08c.517.473 1.069.86 1.618 1.294a.703.703 0 1 1-.879 1.097c-.597-.47-1.157-.865-1.717-1.379-.56.514-1.073.908-1.67 1.38a.703.703 0 1 1-.878-1.098c.549-.434 1.054-.821 1.57-1.293-.659-.792-1.246-1.796-1.646-3.08h-.188a.703.703 0 1 1 0-1.406h2.11v-.704a.703.703 0 1 1 1.405 0v.704h2.157a.703.703 0 1 1 0 1.406Z"
                                />
                                <path
                                    d="M11.445 1.848A2.112 2.112 0 0 0 9.352 0H2.11C.946 0 0 .946 0 2.11v15.562c0 1.163.946 2.11 2.11 2.11h11.088c.205-.235.377-.382.384-.688.002-.077-2.127-17.17-2.137-17.246ZM8.622 13.439a.703.703 0 0 1-.827-.551l-.45-2.247H5.359l-.45 2.247a.703.703 0 0 1-1.379-.276l1.407-7.031a.704.704 0 0 1 .689-.565h1.453c.335 0 .624.237.69.565l1.406 7.031a.703.703 0 0 1-.552.827Zm-.407 7.748.121.965c.08.646.51 1.305 1.216 1.634l2.36-2.599H8.215Z"
                                />
                            </svg>
                            <span class="text-xs sm:text-sm font-medium">EN</span>
                        </a>
                         --}}
                    </div>
                    {{--
                        <a href="#" class="btn btn-purple ml-8 !hidden md:!flex 2xl:ml-12">MoonShine PRO</a>
                    --}}
                    <button class="ml-4 flex text-white transition hover:text-pink 2xl:hidden" @click="openMobileMenu = ! openMobileMenu">
                        <span class="sr-only">Меню</span>
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                <!-- /.header-actions -->
            </div>
            <!-- /.header-inner -->
        </div>
        <!-- /.container -->
    </header>

    <main class="py-12 md:py-16 lg:py-20">
        <!-- Section: Heroes -->
        <section class="heroes">
            <div class="container">
                <div class="flex flex-col">
                    <a href="{{ config('links.chat') }}" class="heroes-telegram" target="_blank" rel="noopener nofollow">Telegram-канал</a>
                    <h1 class="heroes-title">
                        Админ-панель для<br />
                        Ваших <span class="px-2 text-transparent bg-[url('/images/laravel-title.svg')] bg-no-repeat bg-contain bg-center">Laravel</span>
                        проектов
                    </h1>
                    <h2 class="heroes-subtitle">
                        <span class="text-pink">Простая для новичков,</span><br />
                        безграничная для профессионалов
                    </h2>
                    <div class="heroes-buttons">
                        <a href="{{ config('promo_menu.demo.link') }}" class="btn btn-purple" target="_blank" rel="noopener nofollow">
                            Попробовать демо
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor" viewBox="0 0 12 12">
                                <path d="M12.308 11.808a.649.649 0 0 1-.462.192.659.659 0 0 1-.654-.654V1.307H1.154A.658.658 0 0 1 .5.654C.5.296.796 0 1.154 0h10.692c.357 0 .654.296.654.654v10.692a.646.646 0 0 1-.192.462Z" />
                                <path d="M12.307 1.145 1.645 11.805a.677.677 0 0 1-.95 0 .676.676 0 0 1 0-.95L11.355.196c.26-.26.69-.26.95 0a.676.676 0 0 1 0 .95h.002Z" />
                            </svg>
                        </a>
                        <a href="{{ route('moonshine.index') }}" class="btn btn-outline btn-pink" rel="noopener nofollow">
                            Документация
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink" fill="currentColor" viewBox="0 0 21 20">
                                <path
                                    d="M14.515 3.226H3.03a.757.757 0 0 0-.756.756v15.262c0 .417.34.756.756.756h11.485c.417 0 .756-.34.756-.756V3.982a.757.757 0 0 0-.756-.756ZM11.952 13.87h-6.13a.645.645 0 1 1 0-1.29h6.13a.645.645 0 1 1 0 1.29Zm0-2.58h-6.13a.645.645 0 1 1 0-1.291h6.13a.645.645 0 1 1 0 1.29Zm0-2.581h-6.13a.645.645 0 1 1 0-1.29h6.13a.645.645 0 1 1 0 1.29Z"
                                />
                                <path d="M18.726 1.935V16.13c0 .974-.784 1.935-2.165 1.935V3.982a2.048 2.048 0 0 0-2.046-2.047H4.44C4.44.868 5.36 0 6.49 0h10.187c1.13 0 2.05.868 2.05 1.935Z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Ballons -->
                <svg class="ballons ballons-1" xmlns="http://www.w3.org/2000/svg" width="145" height="203" fill="none" viewBox="0 0 145 203">
                    <path fill="url(#b1-a)" d="M51.056 202.183c14.1 0 25.529-11.658 25.529-26.039 0-14.38-11.43-26.038-25.528-26.038-14.1 0-25.529 11.658-25.529 26.038 0 14.381 11.43 26.039 25.529 26.039Z" />
                    <path fill="url(#b1-b)" d="M65.352 101.092c18.61 0 33.697-15.087 33.697-33.698 0-18.61-15.087-33.697-33.697-33.697-18.61 0-33.697 15.087-33.697 33.697 0 18.61 15.087 33.698 33.697 33.698Z" />
                    <path fill="url(#b1-c)" d="M128.151 33.697c9.306 0 16.849-7.543 16.849-16.848C145 7.543 137.457 0 128.151 0c-9.305 0-16.848 7.543-16.848 16.849 0 9.305 7.543 16.848 16.848 16.848Z" />
                    <path fill="url(#b1-d)" d="M12.764 42.887c7.05 0 12.764-5.714 12.764-12.764 0-7.05-5.714-12.764-12.764-12.764C5.714 17.36 0 23.074 0 30.123c0 7.05 5.715 12.764 12.764 12.764Z" />
                    <defs>
                        <linearGradient id="b1-a" x1="9.659" x2="106.256" y1="171.939" y2="171.939" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-b" x1="10.709" x2="138.215" y1="61.951" y2="61.951" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-c" x1="100.829" x2="164.583" y1="14.127" y2="14.127" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-d" x1="-7.934" x2="40.364" y1="28.062" y2="28.062" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                    </defs>
                </svg>
                <svg class="ballons ballons-2" xmlns="http://www.w3.org/2000/svg" width="204" height="315" fill="none" viewBox="0 0 204 315">
                    <path fill="url(#b2-a)" d="M139 175c-23.748 0-43-19.252-43-43s19.252-43 43-43 43 19.252 43 43-19.252 43-43 43Z" />
                    <path fill="url(#b2-b)" d="M55 315c-30.376 0-55-25.072-55-56s24.624-56 55-56 55 25.072 55 56-24.624 56-55 56Z" />
                    <path fill="url(#b2-c)" d="M176 55c-15.464 0-28-12.312-28-27.5S160.536 0 176 0s28 12.312 28 27.5S191.464 55 176 55Z" />
                    <path fill="url(#b2-d)" d="M61 93c-11.598 0-21-9.85-21-22s9.402-22 21-22 21 9.85 21 22-9.402 22-21 22Z" />
                    <defs>
                        <linearGradient id="b2-a" x1="208.73" x2="46.021" y1="125.055" y2="125.055" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b2-b" x1="144.188" x2="-63.926" y1="249.954" y2="249.954" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b2-c" x1="221.405" x2="115.456" y1="23.058" y2="23.058" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b2-d" x1="95.053" x2="15.592" y1="67.447" y2="67.447" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </section>

        <!-- Section: How it works -->
        <section class="how-it-works pt-120" x-data="{lvlTab: 1, lvlTab_1_ActiveTab: 1, lvlTab_2_ActiveTab: 1 }">
            <div class="container">
                <div class="flex flex-nowrap flex-col lg:flex-row justify-between lg:items-center gap-6">
                    <div class="section-heading">
                        <h2 class="section-heading-title text-center sm:text-left">Как это работает?</h2>
                    </div>
                    <div class="how-it-works-tabs">
                        <div class="hidden sm:block sm:absolute right-0 lg:right-full -top-12 md:-top-14 lg:-top-2 pr-0 sm:pr-12 pb-4 sm:pb-0 text-gray scale-75 2xl:scale-100 origin-right">
                            <span class="whitespace-nowrap text-sm ld:text-md">Выберите свой уровень</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="72" class="absolute right-0 tra sm:right-full lg:right-6 -top-4 lg:top-2 mr-4 lg:mr-0 rotate-[145deg] lg:rotate-0" fill="currentColor" viewBox="0 0 74 72">
                                <path
                                    d="M69.534 43.712a1 1 0 0 0-.71-1.223l-8.698-2.31a1 1 0 0 0-.514 1.934l7.733 2.052-2.052 7.733a1 1 0 0 0 1.933.512l2.308-8.698ZM1.087 21.218c5.689 7.084 15.88 16.735 28.015 22.695 12.15 5.966 26.39 8.29 39.968.407l-1.004-1.73c-12.796 7.429-26.285 5.321-38.082-.472-11.81-5.8-21.783-15.235-27.338-22.152l-1.56 1.252Z"
                                />
                            </svg>
                        </div>
                        <button type="button" class="how-it-works-tab" @click="lvlTab = 1" :class="{ '_is-active': lvlTab === 1 }">Новичок</button>
                        <button type="button" class="how-it-works-tab" @click="lvlTab = 2" :class="{ '_is-active': lvlTab === 2 }">Опытный</button>
                    </div>
                </div>

                <!-- Level Tab #1 -->
                <div class="how-it-works-wrapper" x-show="lvlTab === 1" @click="lvlTab = 1" :class="{ '_is-active': lvlTab === 1 }" style="display: none">
                    <div class="how-it-works-items">
                        <div class="how-it-works-item" @click="lvlTab_1_ActiveTab = 1" :class="{ '_is-active': lvlTab_1_ActiveTab === 1 }">
                            <div class="number"></div>
                            <div class="heading">
                                <h5 class="heading-title">Даже джун сможет легко создать полноценную админ-панель!</h5>
                                <p class="heading-descr">Всего пару строчек кода и твоя админ-панель MoonShine готова к использованию.</p>
                            </div>
                        </div>

                        <div class="how-it-works-item" @click="lvlTab_1_ActiveTab = 2" :class="{ '_is-active': lvlTab_1_ActiveTab === 2 }">
                            <div class="number"></div>
                            <div class="heading">
                                <h5 class="heading-title">Не нужно знать фронтэнд, все элементы легко кастомизируются</h5>
                                <p class="heading-descr">Всего пару строчек кода и твоя админ-панель MoonShine готова к использованию.</p>
                            </div>
                        </div>

                        <div class="how-it-works-item" @click="lvlTab_1_ActiveTab = 3" :class="{ '_is-active': lvlTab_1_ActiveTab === 3 }">
                            <div class="number"></div>
                            <div class="heading">
                                <h5 class="heading-title">Меняем цветовую схему</h5>
                                <p class="heading-descr">
                                    Тюнингуйте админ-панель под свой вкус
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.how-it-works-items -->
                    <div class="how-it-works-preview">
                        <video load="lazy" class="how-it-works-preview-video" :class="{ '_is-active': lvlTab_1_ActiveTab === 1 }" autoplay muted preload="auto" playsinline loop>
                            <source src="/video/j1.mp4" type="video/mp4" />
                        </video>
                        <video load="lazy" class="how-it-works-preview-video" :class="{ '_is-active': lvlTab_1_ActiveTab === 2 }" autoplay muted preload="auto" playsinline loop>
                            <source src="/video/j2.mp4" type="video/mp4" />
                        </video>
                        <video load="lazy" class="how-it-works-preview-video" :class="{ '_is-active': lvlTab_1_ActiveTab === 3 }" autoplay muted preload="auto" playsinline loop>
                            <source src="/video/j3.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <!-- /.how-it-works-preview -->
                </div>

                <!-- Level Tab #2 -->
                <div class="how-it-works-wrapper" x-show="lvlTab === 2" @click="lvlTab = 2" :class="{ '_is-active': lvlTab === 2 }" style="display: none">
                    <div class="how-it-works-items">
                        <div class="how-it-works-item" @click="lvlTab_2_ActiveTab = 1" :class="{ '_is-active': lvlTab_2_ActiveTab === 1 }">
                            <div class="number"></div>
                            <div class="heading">
                                <h5 class="heading-title">Множество подходов</h5>
                                <p class="heading-descr">Разрабатывай так как тебе нравится</p>
                            </div>
                        </div>
                        <div class="how-it-works-item" @click="lvlTab_2_ActiveTab = 2" :class="{ '_is-active': lvlTab_2_ActiveTab === 2 }">
                            <div class="number"></div>
                            <div class="heading">
                                <h5 class="heading-title">Кастомизируй под себя.</h5>
                                <p class="heading-descr">
                                    Меняй расположение блоков. Или добавляй свои!
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.how-it-works-items -->
                    <div class="how-it-works-preview">
                        <video load="lazy" class="how-it-works-preview-video" :class="{ '_is-active': lvlTab_2_ActiveTab === 1 }" autoplay muted preload="auto" playsinline loop>
                            <source src="/video/p1.mp4" type="video/mp4" />
                        </video>
                        <video load="lazy" class="how-it-works-preview-video" :class="{ '_is-active': lvlTab_2_ActiveTab === 2 }" autoplay muted preload="auto" playsinline loop>
                            <source src="/video/p2.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <!-- /.how-it-works-preview -->
                </div>
            </div>
        </section>

        {{--
        <!-- Section: Features -->
        <section class="features pt-120" x-data="{ activeTab: 1 }">
            <div class="container">
                <div class="section-heading text-center lg:text-left">
                    <h2 class="section-heading-title">Почему <span class="text-transparent bg-[url('/images/you-like-it-title.svg')] bg-no-repeat bg-contain bg-center whitespace-nowrap">тебе понравится</span> MoonShine?</h2>
                    <div class="section-heading-descr">
                        <p>MoonShine наполнен функционалом! Вы найдёте инструменты на все случаи <s>жизни</s> разработки.</p>
                    </div>
                </div>
                <div class="features-wrapper">
                    <div class="features-list scrollbar">
                        <ul>
                            <li>
                                <button type="button" @click="activeTab = 1" :class="{ '_is-active': activeTab === 1 }">Действия карточки</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 2" :class="{ '_is-active': activeTab === 2 }">Массовые действия</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 3" :class="{ '_is-active': activeTab === 3 }">Кастомные атрибуты</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 4" :class="{ '_is-active': activeTab === 4 }">Ресайз изображений</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 5" :class="{ '_is-active': activeTab === 5 }">Варианты</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 6" :class="{ '_is-active': activeTab === 6 }">URLs</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 7" :class="{ '_is-active': activeTab === 7 }">Коллекции</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 8" :class="{ '_is-active': activeTab === 8 }">Фильтры</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 9" :class="{ '_is-active': activeTab === 9 }">Активные разделы</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 10" :class="{ '_is-active': activeTab === 10 }">Валидация</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 11" :class="{ '_is-active': activeTab === 11 }">Поиск</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 12" :class="{ '_is-active': activeTab === 12 }">Query</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 13" :class="{ '_is-active': activeTab === 13 }">Быстрые фильтры/теги</button>
                            </li>
                            <li>
                                <button type="button" @click="activeTab = 14" :class="{ '_is-active': activeTab === 14 }">Компоненты</button>
                            </li>
                        </ul>
                    </div>
                    <!-- /.features-list -->
                    <div class="features-preview scrollbar">
                        <div class="features-preview-wrapper" x-data="featureSlider" x-ref="featureSliderWrapper" style="--slider-pos: 10%">
                            <div class="features-preview-code box box-dark">
                                <pre x-ref="torchlight">
                                    <code data-theme="moonlight-ii" data-lang="php" class="torchlight has-focus-lines"
                                          style="background-color: #28334e; --theme-selection-background: #28334e;">
                                        <!-- Syntax highlighted by torchlight.dev --><div
                                            class="line"><span style="color: #7A88CF;">//...</span></div><div class="line">&nbsp;</div><div
                                            class="line"><span style="color: #C099FF;">public</span><span
                                                style="color: #C8D3F5;"> </span><span
                                                style="color: #C099FF;">function</span><span style="color: #C8D3F5;"> </span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">fields</span><span
                                                style="color: #B4C2F0;">()</span><span style="color: #86E1FC;">:</span><span
                                                style="color: #C8D3F5;"> </span><span style="color: #FF98A4;">array</span></div><div
                                            class="line"><span style="color: #86E1FC;">{</span></div><div class="line"><span
                                                style="color: #C8D3F5;">    </span><span style="color: #86E1FC;">return</span><span
                                                style="color: #C8D3F5;"> </span><span style="color: #86E1FC;">[</span></div><div
                                            class="line"><span
                                                style="color: #C8D3F5;">        </span><span style="color: #FFC777;">Block</span><span
                                                style="color: #86E1FC;">::</span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">make</span><span
                                                style="color: #86E1FC;">(</span><span style="color: #86E1FC;">'</span><span
                                                style="color: #C3E88D;">Block title</span><span
                                                style="color: #86E1FC;">'</span><span style="color: #86E1FC;">,</span><span
                                                style="color: #C8D3F5;"> </span><span style="color: #86E1FC;">[</span></div><div
                                            class="line"><span
                                                style="color: #C8D3F5;">            </span><span style="color: #FFC777;">ID</span><span
                                                style="color: #86E1FC;">::</span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">make</span><span
                                                style="color: #86E1FC;">(),</span></div><div class="line"><span
                                                style="color: #C8D3F5;">            </span><span style="color: #FFC777;">Text</span><span
                                                style="color: #86E1FC;">::</span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">make</span><span
                                                style="color: #86E1FC;">(</span><span style="color: #86E1FC;">'</span><span
                                                style="color: #C3E88D;">Заголовок</span><span
                                                style="color: #86E1FC;">'</span><span style="color: #86E1FC;">,</span><span
                                                style="color: #C8D3F5;"> </span><span style="color: #86E1FC;">'</span><span
                                                style="color: #C3E88D;">title</span><span
                                                style="color: #86E1FC;">'</span><span style="color: #86E1FC;">)</span></div><div
                                            class="line line-focus">&nbsp;</div><div class="line line-focus"><span
                                                style="color: #C8D3F5;">                </span><span style="color: #86E1FC;">-&gt;</span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">hideOnIndex</span><span
                                                style="color: #86E1FC;">()</span></div><div class="line line-focus"><span
                                                style="color: #C8D3F5;">                </span><span style="color: #86E1FC;">-&gt;</span><span
                                                style="color: #91bbff; text-shadow: 0 0 10px #2f36ff, 0 0 22px #9d91ff, 0 0 2px black;">hideOnForm</span><span
                                                style="color: #86E1FC;">()</span></div><div class="line line-focus">&nbsp;</div><div
                                            class="line"><span style="color: #C8D3F5;">            </span><span
                                                style="color: #86E1FC;">,</span></div><div
                                            class="line"><span style="color: #C8D3F5;">        </span><span
                                                style="color: #86E1FC;">])</span></div><div class="line"><span
                                                style="color: #C8D3F5;">    </span><span style="color: #86E1FC;">];</span></div><div
                                            class="line"><span style="color: #86E1FC;">}</span></div><div class="line">&nbsp;</div><div
                                            class="line"><span style="color: #7A88CF;">//...</span></div><div aria-hidden="true" hidden=""
                                                                                                              tabindex="-1"
                                                                                                              style="display: none;"
                                                                                                              class="torchlight-copy-target">
                                            //...

                                            public function fields(): array
                                            {
                                                    return [
                                                            Block::make('Block title', [
                                                                    ID::make(),
                                                                    Text::make('Заголовок', 'title')

                                                                            -&gt;hideOnIndex()
                                                                            -&gt;hideOnForm()

                                                                    ,
                                                            ])
                                                    ];
                                            }

                                            //...</div>
                                    </code>
                                </pre>
                            </div>
                            <!-- /.features-preview-code -->
                            <div class="features-preview-image" @click="switchCode = !switchCode">
                                <img src="{{ Vite::asset('resources/images/admin-panel.png') }}" alt="Действия карточки" />
                            </div>
                            <!-- /.features-preview-image -->

                            <input type="range" min="10" max="90" value="10" class="features-preview-slider" @input="toggleSlider()" x-init="$nextTick(() => { $el.value = 10 })" />
                            <button type="button" class="features-preview-slider-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7.469 3.689a1.106 1.106 0 0 0-1.57 0L.372 9.215a1.105 1.105 0 0 0 0 1.57L5.9 16.312a1.105 1.105 0 0 0 1.57 0 1.106 1.106 0 0 0 0-1.57L2.716 10l4.753-4.742a1.105 1.105 0 0 0 0-1.57Zm12.159 5.526L14.1 3.69a1.11 1.11 0 0 0-1.57 1.57L17.284 10l-4.753 4.742a1.105 1.105 0 0 0 0 1.57 1.104 1.104 0 0 0 1.57 0l5.527-5.527a1.106 1.106 0 0 0 0-1.57Z"
                                    />
                                </svg>
                            </button>
                        </div>
                        <!-- /.features-preview-wrapper -->
                    </div>
                    <!-- /.features-preview -->
                </div>
                <!-- /.features-wrapper -->

                <!-- Ballons -->
                <svg class="ballons" xmlns="http://www.w3.org/2000/svg" width="145" height="203" fill="none" viewBox="0 0 145 203">
                    <path fill="url(#b1-a)" d="M51.056 202.183c14.1 0 25.529-11.658 25.529-26.039 0-14.38-11.43-26.038-25.528-26.038-14.1 0-25.529 11.658-25.529 26.038 0 14.381 11.43 26.039 25.529 26.039Z" />
                    <path fill="url(#b1-b)" d="M65.352 101.092c18.61 0 33.697-15.087 33.697-33.698 0-18.61-15.087-33.697-33.697-33.697-18.61 0-33.697 15.087-33.697 33.697 0 18.61 15.087 33.698 33.697 33.698Z" />
                    <path fill="url(#b1-c)" d="M128.151 33.697c9.306 0 16.849-7.543 16.849-16.848C145 7.543 137.457 0 128.151 0c-9.305 0-16.848 7.543-16.848 16.849 0 9.305 7.543 16.848 16.848 16.848Z" />
                    <path fill="url(#b1-d)" d="M12.764 42.887c7.05 0 12.764-5.714 12.764-12.764 0-7.05-5.714-12.764-12.764-12.764C5.714 17.36 0 23.074 0 30.123c0 7.05 5.715 12.764 12.764 12.764Z" />
                    <defs>
                        <linearGradient id="b1-a" x1="9.659" x2="106.256" y1="171.939" y2="171.939" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-b" x1="10.709" x2="138.215" y1="61.951" y2="61.951" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-c" x1="100.829" x2="164.583" y1="14.127" y2="14.127" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="b1-d" x1="-7.934" x2="40.364" y1="28.062" y2="28.062" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </section>
        --}}

        <!-- Section: Questions -->
        <section class="questions">
            <div class="container">
                <div class="questions-wrapper">
                    <div class="questions-heading">
                        <h2 class="title">Возникли трудности?</h2>
                        <p class="description">Спросите в комьюнити или воспользуйтесь консультацией.</p>
                    </div>
                    <div class="questions-actions">
                        <a href="{{ config('links.chat') }}" class="btn btn-purple" target="_blank" rel="noopener nofollow">Перейти в Telegram-канал</a>
                        <a href="{{ config('promo_menu.consult.link') }}" class="btn btn-pink" target="_blank" rel="noopener nofollow">Консультация</a>
                    </div>
                    <img src="{{ Vite::asset('resources/images/question.svg') }}" class="questions-image" alt="Возникли трудности?" />
                </div>
            </div>
        </section>

        <!-- Section: Technologies -->
        <section class="technologies pt-120">
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="section-heading-title">Что под капотом MoonShine?</h2>
                    <div class="section-heading-descr">
                        <p>
                            Современные, простые, надежные и перспективные инструменты.<br />
                            С ними можно в разработку с головой.
                        </p>
                    </div>
                </div>
                <div class="technologies-items">
                    <a href="https://tailwindcss.com/" class="technologies-item" target="_blank" rel="noopener nofoloow">
                        <img src="{{ Vite::asset('resources/images/logo/tailwindcss.svg') }}" alt="TailwindCSS" />
                    </a>
                    <a href="https://laravel.com/" class="technologies-item" target="_blank" rel="noopener nofoloow">
                        <img src="{{ Vite::asset('resources/images/logo/laravel.svg') }}" alt="Laravel" />
                    </a>
                    <a href="https://alpinejs.dev/" class="technologies-item" target="_blank" rel="noopener nofoloow">
                        <img src="{{ Vite::asset('resources/images/logo/alpinejs.svg') }}" alt="Alpine.js" />
                    </a>
                </div>
            </div>

            <!-- Ballons -->
            <svg class="ballons" xmlns="http://www.w3.org/2000/svg" width="145" height="203" fill="none" viewBox="0 0 145 203">
                <path fill="url(#b1-a)" d="M51.056 202.183c14.1 0 25.529-11.658 25.529-26.039 0-14.38-11.43-26.038-25.528-26.038-14.1 0-25.529 11.658-25.529 26.038 0 14.381 11.43 26.039 25.529 26.039Z" />
                <path fill="url(#b1-b)" d="M65.352 101.092c18.61 0 33.697-15.087 33.697-33.698 0-18.61-15.087-33.697-33.697-33.697-18.61 0-33.697 15.087-33.697 33.697 0 18.61 15.087 33.698 33.697 33.698Z" />
                <path fill="url(#b1-c)" d="M128.151 33.697c9.306 0 16.849-7.543 16.849-16.848C145 7.543 137.457 0 128.151 0c-9.305 0-16.848 7.543-16.848 16.849 0 9.305 7.543 16.848 16.848 16.848Z" />
                <path fill="url(#b1-d)" d="M12.764 42.887c7.05 0 12.764-5.714 12.764-12.764 0-7.05-5.714-12.764-12.764-12.764C5.714 17.36 0 23.074 0 30.123c0 7.05 5.715 12.764 12.764 12.764Z" />
                <defs>
                    <linearGradient id="b1-a" x1="9.659" x2="106.256" y1="171.939" y2="171.939" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-b" x1="10.709" x2="138.215" y1="61.951" y2="61.951" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-c" x1="100.829" x2="164.583" y1="14.127" y2="14.127" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-d" x1="-7.934" x2="40.364" y1="28.062" y2="28.062" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                </defs>
            </svg>
        </section>

        <!-- Section: Advantages -->
        <section class="advantages mt-120">
            <div class="container">
                <div class="advantages-wrapper">
                    <div class="advantages-heading">
                        <div class="section-heading">
                            <h2 class="section-heading-title">Еще сомневаетесь, подойдет ли вам MoonShine?</h2>
                        </div>
                        <div class="advantages-heading-links">
                            <a href="{{ config('promo_menu.demo.link') }}" class="btn btn-purple" target="_blank" rel="noopener nofollow">
                                Попробовать демо
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor" viewBox="0 0 12 12">
                                    <path d="M12.308 11.808a.649.649 0 0 1-.462.192.659.659 0 0 1-.654-.654V1.307H1.154A.658.658 0 0 1 .5.654C.5.296.796 0 1.154 0h10.692c.357 0 .654.296.654.654v10.692a.646.646 0 0 1-.192.462Z" />
                                    <path d="M12.307 1.145 1.645 11.805a.677.677 0 0 1-.95 0 .676.676 0 0 1 0-.95L11.355.196c.26-.26.69-.26.95 0a.676.676 0 0 1 0 .95h.002Z" />
                                </svg>
                            </a>
                            <a href="{{ config('links.chat') }}" class="btn btn-dark" target="_blank" rel="noopener nofollow">Спросить в чате</a>
                        </div>
                    </div>
                    <!-- /.advantages-heading -->
                    <div class="advantages-list">
                        <div class="advantages-item">
                            <div class="number"></div>
                            <div class="heading">
                                <h4 class="heading-title">В 2 раза ускоряет разработку админ-панели</h4>
                                <p class="heading-descr">По отзывам пользователей которые использовали MoonShine и другие панели администратора.</p>
                            </div>
                        </div>
                        <div class="advantages-item">
                            <div class="number"></div>
                            <div class="heading">
                                <h4 class="heading-title">Внедряется от 5 минут</h4>
                                <p class="heading-descr">Именно столько потребуется чтобы сделать админ-панель с авторизацией и CRUD.</p>
                            </div>
                        </div>
                        <div class="advantages-item">
                            <div class="number"></div>
                            <div class="heading">
                                <h4 class="heading-title">Это удобно!</h4>
                                <p class="heading-descr">Никаких танцев с бубном – быстрая настройка с использованием Laravel Prompts при установке.</p>
                            </div>
                        </div>
                        <div class="advantages-item">
                            <div class="number"></div>
                            <div class="heading">
                                <h4 class="heading-title">Не волнуйтесь за качество!</h4>
                                <p class="heading-descr">Всё работает уже на 1к разных проектах на Laravel.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.advantages-list -->
                </div>
            </div>
        </section>

        <!-- Section: Cases -->
        <section class="cases pt-120">
            <div class="container">
                <div class="section-heading text-center md:text-left">
                    <h2 class="section-heading-title">MoonShine подойдет вам</h2>
                    <div class="section-heading-descr">
                        <p>
                            MoonShine это универсальная админ-панель, которую можно использовать на любом проекте.<br />
                            Главное, чтобы он был на Laravel.
                        </p>
                    </div>
                    <h3 class="mt-6 text-md xl:text-lg font-semibold"><span class="text-pink">Уже реализованные</span> на MoonShine проекты:</h3>
                </div>
            </div>
            <div class="cases-list">
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/shop.jpg') }})">
                    <h5 class="title">Интернет-<br />магазин</h5>
                </div>
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/cms.jpg') }})">
                    <h5 class="title">CMS</h5>
                </div>
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/crm.jpg') }})">
                    <h5 class="title">CRM</h5>
                </div>
                <div class="cases-item-middle">
                    <img src="{{ Vite::asset('resources/images/cases/your-project.svg') }}" class="picture" alt="Ваш будущий проект" />
                </div>
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/blog.jpg') }})">
                    <h5 class="title">Блог</h5>
                </div>
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/blog.jpg') }})">
                    <h5 class="title">
                        Новостной<br />
                        портал
                    </h5>
                </div>
                <div class="cases-item" style="--bg-url: url({{ Vite::asset('resources/images/cases/chatbot.jpg') }})">
                    <h5 class="title">
                        Админ-панель<br />
                        чат-бота
                    </h5>
                </div>
            </div>
            <!-- /.cases-list -->

            <!-- Ballons -->
            <svg class="ballons" xmlns="http://www.w3.org/2000/svg" width="145" height="203" fill="none" viewBox="0 0 145 203">
                <path fill="url(#b1-a)" d="M51.056 202.183c14.1 0 25.529-11.658 25.529-26.039 0-14.38-11.43-26.038-25.528-26.038-14.1 0-25.529 11.658-25.529 26.038 0 14.381 11.43 26.039 25.529 26.039Z" />
                <path fill="url(#b1-b)" d="M65.352 101.092c18.61 0 33.697-15.087 33.697-33.698 0-18.61-15.087-33.697-33.697-33.697-18.61 0-33.697 15.087-33.697 33.697 0 18.61 15.087 33.698 33.697 33.698Z" />
                <path fill="url(#b1-c)" d="M128.151 33.697c9.306 0 16.849-7.543 16.849-16.848C145 7.543 137.457 0 128.151 0c-9.305 0-16.848 7.543-16.848 16.849 0 9.305 7.543 16.848 16.848 16.848Z" />
                <path fill="url(#b1-d)" d="M12.764 42.887c7.05 0 12.764-5.714 12.764-12.764 0-7.05-5.714-12.764-12.764-12.764C5.714 17.36 0 23.074 0 30.123c0 7.05 5.715 12.764 12.764 12.764Z" />
                <defs>
                    <linearGradient id="b1-a" x1="9.659" x2="106.256" y1="171.939" y2="171.939" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-b" x1="10.709" x2="138.215" y1="61.951" y2="61.951" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-c" x1="100.829" x2="164.583" y1="14.127" y2="14.127" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                    <linearGradient id="b1-d" x1="-7.934" x2="40.364" y1="28.062" y2="28.062" gradientUnits="userSpaceOnUse">
                        <stop offset=".01" stop-color="#0797FF" />
                        <stop offset=".745" stop-color="#894EF6" />
                    </linearGradient>
                </defs>
            </svg>
        </section>

        {{--<!-- Section: Testimonials -->
        <section class="testimonials pt-120">
            <div class="container">
                <div class="testimonials-heading">
                    <div class="section-heading">
                        <h2 class="section-heading-title">
                            Вот почему другие<br />
                            <span class="text-pink">разработчики выбрали MoonShine</span>
                        </h2>
                    </div>
                    <div class="testimonials-navigation">
                        <button type="button" class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M14.545 20a.906.906 0 0 0 .91-.91.907.907 0 0 0-.267-.642L6.74 10l8.448-8.448A.908.908 0 1 0 13.903.266L4.812 9.357a.908.908 0 0 0 0 1.286l9.09 9.09a.905.905 0 0 0 .643.267Z" />
                            </svg>
                        </button>
                        <button type="button" class="swiper-button-next">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.455 20a.907.907 0 0 1-.84-1.257.907.907 0 0 1 .197-.295L13.26 10 4.812 1.552A.908.908 0 1 1 6.097.266l9.091 9.091a.908.908 0 0 1 0 1.286l-9.09 9.09a.905.905 0 0 1-.643.267Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- /.testimonials-heading -->
                <div class="testimonials-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonials-item">
                                <div class="testimonials-item-heading">
                                    <div class="photo">
                                        <img src="{{ Vite::asset('resources/images/avatar.jpg') }}" alt="Данил Шуцкий" />
                                    </div>
                                    <div class="author">
                                        <h5 class="author-name">Данил Шуцкий</h5>
                                        <a href="#" class="author-link" target="_blank" rel="noopener nofollow">@leeto_telegram</a>
                                    </div>
                                </div>
                                <div class="testimonials-item-text">
                                    <p>
                                        MoonShine мне показался более интересным в плане функционала так и возможность конструктором собрать компоненты так и использование кастомного функционала. Что позволяет расширять возможности, работая не только с
                                        crud но и вне базы.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.swiper-slide -->
                        <div class="swiper-slide">
                            <div class="testimonials-item">
                                <div class="testimonials-item-heading">
                                    <div class="photo">
                                        <img src="{{ Vite::asset('resources/images/avatar.jpg') }}" alt="Данил Шуцкий" />
                                    </div>
                                    <div class="author">
                                        <h5 class="author-name">Данил Шуцкий</h5>
                                        <a href="#" class="author-link" target="_blank" rel="noopener nofollow">@leeto_telegram</a>
                                    </div>
                                </div>
                                <div class="testimonials-item-text">
                                    <p>Возможность держать контакт с создателем, гибкость. Еще смотрел в сторону Laravel Nova но в текущих реалиях сложно ее оплачивать.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.swiper-slide -->
                        <div class="swiper-slide">
                            <div class="testimonials-item">
                                <div class="testimonials-item-heading">
                                    <div class="photo">
                                        <img src="{{ Vite::asset('resources/images/avatar.jpg') }}" alt="Данил Шуцкий" />
                                    </div>
                                    <div class="author">
                                        <h5 class="author-name">Данил Шуцкий</h5>
                                        <a href="#" class="author-link" target="_blank" rel="noopener nofollow">@leeto_telegram</a>
                                    </div>
                                </div>
                                <div class="testimonials-item-text">
                                    <p>Посмотрел видеокурс и через час уже сдал проект!</p>
                                </div>
                                <div class="testimonials-item-video">
                                    <a href="#" target="_blank" rel="noopener nofollow">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 48 48">
                                            <path d="M10.21 1.058C5.884-1.424 2.376.61 2.376 5.597V42.4c0 4.992 3.508 7.023 7.836 4.543L42.38 28.495c4.329-2.483 4.329-6.506 0-8.989L10.21 1.058Z" />
                                        </svg>
                                        <img src="{{ Vite::asset('resources/images/testimonial-thumb.jpg') }}" alt="Данил Шуцкий" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.swiper-slide -->
                        <div class="swiper-slide">
                            <div class="testimonials-item">
                                <div class="testimonials-item-heading">
                                    <div class="photo">
                                        <img src="{{ Vite::asset('resources/images/avatar.jpg') }}" alt="Данил Шуцкий" />
                                    </div>
                                    <div class="author">
                                        <h5 class="author-name">Данил Шуцкий</h5>
                                        <a href="#" class="author-link" target="_blank" rel="noopener nofollow">@leeto_telegram</a>
                                    </div>
                                </div>
                                <div class="testimonials-item-text">
                                    <p>MoonShine показался лучшим выбором из-за меньшего внедрения в фреймворк, что дает большую гибкость, ну и так же субъективно мне понравился дизайн и работа с полями в создании ресурсов админки</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.swiper-slide -->
                    </div>
                    <!-- /.swiper-wrapper -->
                </div>
                <!-- /.testimonials-slider -->
            </div>
        </section>

        <section class="compare pt-120">
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="section-heading-title">
                        <span class="text-pink">Давайте сравним</span><br />
                        популярные админ-панели
                    </h2>
                </div>
                <div class="compare-table">
                    <table>
                        <thead>
                        <tr>
                            <!-- 							<th></th> -->
                            <th>Название админ-панели</th>
                            <th>Сложность (больше-сложнее)</th>
                            <th>Качество документации</th>
                            <th>Стек и версии</th>
                            <th>Русскоязычное комьюнити</th>
                            <th>Последнее обновление</th>
                            <th>Стоимость</th>
                            <th>Возможность консультации</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Laravel Nova</th>
                            <td>9/10</td>
                            <td>8/10</td>
                            <td>
                                Node.js<br />
                                Laravel
                            </td>
                            <td>Нет</td>
                            <td>3 апреля 2022 г.</td>
                            <td>$99 за проект</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <th>MoonShine</th>
                            <td>5/10</td>
                            <td>9/10</td>
                            <td>
                                TailwindCSS<br />
                                AlpineJS<br />
                                Laravel
                            </td>
                            <td>Да</td>
                            <td>1 ноября 2023 г.</td>
                            <td>open-source, есть платные услуги</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <th>Laravel Nova</th>
                            <td>9/10</td>
                            <td>8/10</td>
                            <td>
                                Node.js<br />
                                Laravel
                            </td>
                            <td>Нет</td>
                            <td>3 апреля 2022 г.</td>
                            <td>$99 за проект</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <th>MoonShine</th>
                            <td>5/10</td>
                            <td>9/10</td>
                            <td>
                                TailwindCSS<br />
                                AlpineJS<br />
                                Laravel
                            </td>
                            <td>Да</td>
                            <td>1 ноября 2023 г.</td>
                            <td>open-source, есть платные услуги</td>
                            <td>Да</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Ballons -->
                <svg class="ballons ballons-1" xmlns="http://www.w3.org/2000/svg" width="219" height="269" fill="none" viewBox="0 0 219 269">
                    <path fill="url(#c1-a)" d="M81.736 269c17.037 0 30.849-14.088 30.849-31.466s-13.811-31.465-30.849-31.465c-17.037 0-30.848 14.087-30.848 31.465S64.699 269 81.736 269Z" />
                    <path fill="url(#c1-b)" d="M122.457 146.839c22.489 0 40.72-18.231 40.72-40.72 0-22.489-18.231-40.72-40.72-40.72-22.49 0-40.72 18.231-40.72 40.72 0 22.489 18.23 40.72 40.72 40.72Z" />
                    <path fill="url(#c1-c)" d="M198.344 40.72c11.245 0 20.361-9.115 20.361-20.36 0-11.244-9.116-20.36-20.361-20.36-11.244 0-20.36 9.116-20.36 20.36 0 11.245 9.116 20.36 20.36 20.36Z" />
                    <path fill="url(#c1-d)" d="M15.72 76.504c8.519 0 15.425-6.905 15.425-15.424 0-8.518-6.906-15.424-15.425-15.424C7.202 45.656.296 52.562.296 61.08c0 8.519 6.906 15.424 15.424 15.424Z" />
                    <defs>
                        <linearGradient id="c1-a" x1="31.711" x2="148.44" y1="232.452" y2="232.452" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c1-b" x1="56.425" x2="210.506" y1="99.541" y2="99.541" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c1-c" x1="165.328" x2="242.369" y1="17.071" y2="17.071" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c1-d" x1="-9.292" x2="49.072" y1="58.589" y2="58.589" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                    </defs>
                </svg>

                <svg class="ballons ballons-2" xmlns="http://www.w3.org/2000/svg" width="393" height="486" fill="none" viewBox="0 0 393 486">
                    <path fill="url(#c2-a)" d="M246.457 485.017c-30.656 0-55.508-25.349-55.508-56.619s24.852-56.619 55.508-56.619c30.657 0 55.509 25.349 55.509 56.619s-24.852 56.619-55.509 56.619Z" />
                    <path fill="url(#c2-b)" d="M173.187 265.204c-40.467 0-73.271-32.805-73.271-73.272 0-40.466 32.804-73.271 73.271-73.271 40.466 0 73.271 32.805 73.271 73.271 0 40.467-32.805 73.272-73.271 73.272Z" />
                    <path fill="url(#c2-c)" d="M36.636 74.254C16.403 74.254 0 57.852 0 37.618 0 17.385 16.403.983 36.636.983c20.233 0 36.636 16.402 36.636 36.636 0 20.233-16.403 36.635-36.636 36.635Z" />
                    <path fill="url(#c2-d)" d="M365.246 138.644c-15.329 0-27.754-12.426-27.754-27.754 0-15.329 12.425-27.755 27.754-27.755 15.328 0 27.754 12.426 27.754 27.755 0 15.328-12.426 27.754-27.754 27.754Z" />
                    <defs>
                        <linearGradient id="c2-a" x1="336.471" x2="126.432" y1="419.253" y2="419.253" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c2-b" x1="292.004" x2="14.753" y1="180.096" y2="180.096" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c2-c" x1="96.044" x2="-42.581" y1="31.7" y2="31.7" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                        <linearGradient id="c2-d" x1="410.252" x2="305.233" y1="106.407" y2="106.407" gradientUnits="userSpaceOnUse">
                            <stop offset=".01" stop-color="#0797FF" />
                            <stop offset=".745" stop-color="#894EF6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </section>--}}
    </main>

    <!-- Site footer -->
    <footer class="footer py-8 sm:py-12 xl:py-16">
        <div class="container">
            <div class="flex flex-col 2xl:flex-row items-center gap-x-6 gap-y-10">
                <div class="footer-logo shrink-0 text-center sm:text-left">
                    <a href="{{ route('home') }}" class="relative w-[114px]" rel="home">
                        <img src="{{ Vite::asset('resources/images/logo-moon.svg') }}" class="animate-wiggle w-[67px] h-[70px]" alt="MoonShine" />
                        <img src="{{ Vite::asset('resources/images/logo-text.svg') }}" class="absolute top-1/2 left-[42px] z-2 -translate-y-1/2 w-[71px] h-[21px]" alt="MoonShine" />
                    </a>
                </div><!-- /.footer-logo -->

                <div class="footer-menu grow">
                    <nav class="flex flex-wrap justify-center 2xl:justify-start gap-x-6 gap-y-3">
                        @foreach(config('promo_menu', []) as $menu)
                            <a
                                href="{{ $menu['link'] }}"
                                class="font-semibold text-white hover:text-pink"
                            >
                                {{ $menu['title'] }}
                            </a>
                        @endforeach
                    </nav>
                </div>
                <div class="footer-social">
                    <div class="flex flex-wrap items-center justify-center sm:justify-end gap-x-4 md:gap-x-6 gap-y-3">
                        <a href="{{ config('links.github') }}"
                           class="inline-flex items-center text-white hover:text-pink" target="_blank" rel="noopener nofollow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 lg:h-6" fill="white" viewBox="0 0 24 24">
                                <path
                                    d="M12 .5C5.37.5 0 5.78 0 12.292c0 5.211 3.438 9.63 8.205 11.188.6.111.82-.254.82-.567 0-.28-.01-1.022-.015-2.005-3.338.711-4.042-1.582-4.042-1.582-.546-1.361-1.335-1.725-1.335-1.725-1.087-.731.084-.716.084-.716 1.205.082 1.838 1.215 1.838 1.215 1.07 1.803 2.809 1.282 3.495.981.108-.763.417-1.282.76-1.577-2.665-.295-5.466-1.309-5.466-5.827 0-1.287.465-2.339 1.235-3.164-.135-.298-.54-1.497.105-3.121 0 0 1.005-.316 3.3 1.209.96-.262 1.98-.392 3-.398 1.02.006 2.04.136 3 .398 2.28-1.525 3.285-1.209 3.285-1.209.645 1.624.24 2.823.12 3.121.765.825 1.23 1.877 1.23 3.164 0 4.53-2.805 5.527-5.475 5.817.42.354.81 1.077.81 2.182 0 1.578-.015 2.846-.015 3.229 0 .309.21.678.825.56C20.565 21.917 24 17.495 24 12.292 24 5.78 18.627.5 12 .5Z"
                                />
                            </svg>
                            <span class="ml-2 lg:ml-3 text-xxs font-semibold">GitHub</span>
                        </a>
                        <div class="h-4 w-[2px] bg-white/25"></div>
                        <a href="{{ config('links.youtube') }}" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                           rel="nofollow noopener">
                            <img class="h-5 lg:h-6" src="{{ Vite::asset('resources/images/icons/youtube.svg') }}" alt="YouTube">
                            <span class="ml-2 lg:ml-3 text-xxs font-semibold">YouTube</span>
                        </a>
                        <div class="h-4 w-[2px] bg-white/25"></div>
                        <a href="{{ config('links.chat') }}" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                           rel="nofollow noopener">
                            <img class="h-5 lg:h-6" src="{{ Vite::asset('resources/images/icons/telegram.svg') }}" alt="Telegram">
                            <span class="ml-2 lg:ml-3 text-xxs font-semibold">Telegram</span>
                        </a>
                    </div>
                </div><!-- /.footer-social -->
            </div>
            <div class="footer-copyright mt-10">
                <div class="text-[#999] text-xxs md:text-xs text-center">CutCode, MoonShine, {{ now()->year }} © Все права
                    защищены.
                </div>
            </div><!-- /.footer-copyright -->
        </div><!-- /.container -->
    </footer>

    <div
        class="bg-body fixed inset-0 z-[9999] overflow-auto"
        x-show="openMobileMenu"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="h-full pt-6 2xl:pt-10 pb-12 overflow-y-auto">
            <div class="container">
                <div class="mmenu-heading flex items-center">
                    <div class="shrink-0 grow">
                        <a href="{{ route('home') }}" class="relative w-[114px]" rel="home">
                            <img src="{{ Vite::asset('resources/images/logo-moon.svg') }}" class="animate-wiggle w-[67px] h-[70px]" alt="MoonShine" />
                            <img src="{{ Vite::asset('resources/images/logo-text.svg') }}" class="absolute top-1/2 left-[42px] z-2 -translate-y-1/2 w-[71px] h-[21px]" alt="MoonShine" />
                        </a>
                    </div>
                    <div class="shrink-0 flex items-center">
                        <button id="closeMobileMenu" class="text-white hover:text-pink transition"
                                @click="openMobileMenu = ! openMobileMenu">
                            <span class="sr-only">Закрыть меню</span>
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div><!-- /.mmenu-heading -->
                <div class="mmenu-inner pt-6">
                    {{--<a href="#" class="btn btn-purple">MoonShine Pro</a>--}}
                    <nav class="flex flex-col gap-y-3 mt-8">
                        @foreach(config('promo_menu', []) as $menu)
                            <a
                                href="{{ $menu['link'] }}"
                                class="text-md font-semibold text-white hover:text-pink"
                            >
                                {{ $menu['title'] }}
                            </a>
                        @endforeach
                    </nav>
                    <div class="flex flex-wrap items-center gap-x-4 md:gap-x-6 gap-y-3 mt-10">
                        <a href="{{ config('links.github') }}"
                           class="inline-flex items-center text-white hover:text-pink" target="_blank" rel="noopener nofollow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 lg:h-6" fill="white" viewBox="0 0 24 24">
                                <path
                                    d="M12 .5C5.37.5 0 5.78 0 12.292c0 5.211 3.438 9.63 8.205 11.188.6.111.82-.254.82-.567 0-.28-.01-1.022-.015-2.005-3.338.711-4.042-1.582-4.042-1.582-.546-1.361-1.335-1.725-1.335-1.725-1.087-.731.084-.716.084-.716 1.205.082 1.838 1.215 1.838 1.215 1.07 1.803 2.809 1.282 3.495.981.108-.763.417-1.282.76-1.577-2.665-.295-5.466-1.309-5.466-5.827 0-1.287.465-2.339 1.235-3.164-.135-.298-.54-1.497.105-3.121 0 0 1.005-.316 3.3 1.209.96-.262 1.98-.392 3-.398 1.02.006 2.04.136 3 .398 2.28-1.525 3.285-1.209 3.285-1.209.645 1.624.24 2.823.12 3.121.765.825 1.23 1.877 1.23 3.164 0 4.53-2.805 5.527-5.475 5.817.42.354.81 1.077.81 2.182 0 1.578-.015 2.846-.015 3.229 0 .309.21.678.825.56C20.565 21.917 24 17.495 24 12.292 24 5.78 18.627.5 12 .5Z"
                                />
                            </svg>
                            <span class="ml-2 lg:ml-3 text-xxs font-medium">GitHub</span>
                        </a>
                        <div class="h-4 w-[2px] bg-white/25"></div>
                        <a href="{{ config('links.youtube') }}" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                           rel="nofollow noopener">
                            <img class="h-5 lg:h-6" src="{{ Vite::asset('resources/images/icons/youtube.svg') }}" alt="YouTube">
                            <span class="ml-2 lg:ml-3 text-xxs font-medium">YouTube</span>
                        </a>
                        <div class="h-4 w-[2px] bg-white/25"></div>
                        <a href="{{ config('links.chat') }}" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                           rel="nofollow noopener">
                            <img class="h-5 lg:h-6" src="{{ Vite::asset('resources/images/icons/telegram.svg') }}" alt="Telegram">
                            <span class="ml-2 lg:ml-3 text-xxs font-medium">Telegram</span>
                        </a>
                    </div>
                </div><!-- /.mmenu-inner -->
            </div><!-- /.container -->
        </div>
    </div>
</body>
</html>
</body>
</html>
