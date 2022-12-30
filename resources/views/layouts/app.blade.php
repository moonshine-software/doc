<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased [font-feature-settings:'ss01'] dark js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', env('APP_NAME'))</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>


    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#7843E9">
    <meta name="msapplication-TileColor" content="#7843E9">
    <meta name="theme-color" content="#7843E9">

    <script>
      document.addEventListener('alpine:init', () => {Alpine.data('global', () => ({ mobileMenuDisplayed: false, donateModal: false }))

        Alpine.bind('donateModalBack', () => ({ ['x-show']() {
            return this.donateModal
          },
          ['x-on:keydown.escape.prevent.stop']() { this.donateModal = false },
          ['role']: 'dialog', ['aria-modal']: 'true', ['x-id']() {
            return ['modal-title'] }, [':aria-labelledby']() { return this.$id('modal-title') },
        }))
      })
    </script>
</head>
<body x-data="global" class="bg-white dark:bg-darkblue">

<header x-show="!mobileMenuDisplayed" class="dark:backdrop-blur sticky top-0 z-50 flex flex-wrap items-center justify-between bg-white px-4 py-5 shadow-md shadow-darkblue-900/5 transition duration-500 dark:shadow-none sm:px-6 lg:px-8 dark:bg-transparent">
    @include('shared.logo')

    <div class="flex items-center space-x-3">
        <a href="https://jb.gg/OpenSourceSupport" target="_blank">
            <svg class="w-14 h-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 105"><path d="m22.5 22.5h60v60h-60z"/><g fill="#fff"><path d="m29.03 71.25h22.5v3.75h-22.5z"/><path d="m28.09 38 1.67-1.58a1.88 1.88 0 0 0 1.47.87c.64 0 1.06-.44 1.06-1.31v-5.98h2.58v6a3.48 3.48 0 0 1 -.87 2.6 3.56 3.56 0 0 1 -2.57.95 3.84 3.84 0 0 1 -3.34-1.55z"/><path d="m36 30h7.53v2.19h-5v1.44h4.49v2h-4.42v1.49h5v2.21h-7.6z"/><path d="m47.23 32.29h-2.8v-2.29h8.21v2.27h-2.81v7.1h-2.6z"/><path d="m29.13 43.08h4.42a3.53 3.53 0 0 1 2.55.83 2.09 2.09 0 0 1 .6 1.53 2.16 2.16 0 0 1 -1.44 2.09 2.27 2.27 0 0 1 1.86 2.29c0 1.61-1.31 2.59-3.55 2.59h-4.44zm5 2.89c0-.52-.42-.8-1.18-.8h-1.29v1.64h1.24c.79 0 1.25-.26 1.25-.81zm-.9 2.66h-1.57v1.73h1.62c.8 0 1.24-.31 1.24-.86 0-.5-.4-.87-1.27-.87z"/><path d="m38 43.08h4.1a4.19 4.19 0 0 1 3 1 2.93 2.93 0 0 1 .9 2.19 3 3 0 0 1 -1.93 2.89l2.24 3.27h-3l-1.88-2.84h-.87v2.84h-2.56zm4 4.5c.87 0 1.39-.43 1.39-1.11 0-.75-.54-1.12-1.4-1.12h-1.44v2.26z"/><path d="m49.59 43h2.5l4 9.44h-2.79l-.67-1.69h-3.63l-.67 1.69h-2.71zm2.27 5.73-1-2.65-1.06 2.65z"/><path d="m56.46 43.05h2.6v9.37h-2.6z"/><path d="m60.06 43.05h2.42l3.37 5v-5h2.57v9.37h-2.26l-3.53-5.14v5.14h-2.57z"/><path d="m68.86 51 1.45-1.73a4.84 4.84 0 0 0 3 1.13c.71 0 1.08-.24 1.08-.65 0-.4-.31-.6-1.59-.91-2-.46-3.53-1-3.53-2.93 0-1.74 1.37-3 3.62-3a5.89 5.89 0 0 1 3.86 1.25l-1.26 1.84a4.63 4.63 0 0 0 -2.62-.92c-.63 0-.94.25-.94.6 0 .42.32.61 1.63.91 2.14.46 3.44 1.16 3.44 2.91 0 1.91-1.51 3-3.79 3a6.58 6.58 0 0 1 -4.35-1.5z"/></g><path d="m0 0h105v105h-105z" fill="none"/></svg>
        </a>

        <a href="https://github.com/lee-to/moonshine" target="_blank">
            <svg class="fill-current w-6 h-6 text-white" viewBox="0 0 20 20"><path d="M10 0a10 10 0 0 0-3.16 19.49c.5.1.68-.22.68-.48l-.01-1.7c-2.78.6-3.37-1.34-3.37-1.34-.46-1.16-1.11-1.47-1.11-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.52 2.34 1.08 2.91.83.1-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.1.39-1.99 1.03-2.69a3.6 3.6 0 0 1 .1-2.64s.84-.27 2.75 1.02a9.58 9.58 0 0 1 5 0c1.91-1.3 2.75-1.02 2.75-1.02.55 1.37.2 2.4.1 2.64.64.7 1.03 1.6 1.03 2.69 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85l-.01 2.75c0 .26.18.58.69.48A10 10 0 0 0 10 0"></path></svg>
        </a>
    </div>

    <div class="md:hidden relative z-10">
        <button @click="mobileMenuDisplayed = true" class="block focus:outline-none" type="button">
            <svg class="block fill-current text-white w-6 h-6" viewBox="0 0 20 20">
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </button>
    </div>
</header>

@if(request()->routeIs('home'))
<div class="hidden md:block overflow-hidden bg-darkblue dark:-mb-32 dark:mt-[-4.5rem] dark:pb-32 dark:pt-[4.5rem] dark:lg:mt-[-4.75rem] dark:lg:pt-[4.75rem]">
    <div class="py-16 sm:px-2 lg:relative lg:py-20 lg:px-0">
        <div class="relative mx-auto max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12">
            <p class="inline bg-gradient-to-r from-purple via-pink to-purple bg-clip-text font-display text-5xl tracking-tight text-transparent">
                Привет пользователь Laravel!
            </p>
            <p class="mt-3 text-2xl tracking-tight text-slate-400">
                Вы находитесь на open source проекте, посвященном админ.панели “MoonShine”.
            </p>

            <div class="mt-8 flex gap-4 md:justify-center lg:justify-start">
                <x-button href="{{ route('section', 'concept') }}" :transparent="false">Начать</x-button>
                <x-button target="_blank" href="https://github.com/lee-to/moonshine" :transparent="true">GitHub</x-button>
                <x-button target="_blank" href="https://github.com/CutCodeRu/moonshine-demo-project" :transparent="true">Demo project</x-button>
                <x-button @click="donateModal = true" :transparent="true">Donate</x-button>
            </div>
        </div>

    </div>
</div>
@endif


<div class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12">
    <div x-show="mobileMenuDisplayed" class="fixed inset-0 flex z-40 lg:hidden">
        <div :class="!mobileMenuDisplayed ? 'opacity-0' : 'opacity-100'"
                @click="mobileMenuDisplayed = false"
                class="fixed inset-0 bg-darkblue bg-opacity-25 transition-opacity ease-linear duration-300 opacity-100" aria-hidden="true"></div>

        <div :class="!mobileMenuDisplayed ? 'translate-x-full' : 'translate-x-0'" class="transition ease-in-out duration-300 transform ml-auto relative max-w-xs w-full h-full bg-darkblue shadow-xl py-4 px-4 pb-12 flex flex-col overflow-y-auto translate-x-0">
            @include('shared.menu')
        </div>
    </div>


    <aside class="hidden lg:relative lg:block lg:flex-none">
        <div class="absolute inset-y-0 right-0 w-[50vw] bg-slate-50 dark:hidden"></div>
        <div class="sticky top-[4.5rem] -ml-0.5 h-[calc(100vh-4.5rem)] overflow-y-auto py-16 pl-0.5">
            <div class="absolute top-16 bottom-0 right-0 hidden h-12 w-px bg-gradient-to-t from-slate-800 dark:block"></div>
            <div class="absolute top-28 bottom-0 right-0 hidden w-px bg-slate-800 dark:block"></div>

            @include('shared.menu')
        </div>

    </aside>

    <div class="min-w-0 text-white max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16">
        @include('shared.flash')

        @yield('content')
    </div>


    <aside class="hidden xl:sticky xl:top-[4.5rem] xl:-mr-6 xl:block xl:h-[calc(100vh-4.5rem)] xl:flex-none xl:overflow-y-auto xl:py-16 xl:pr-6">
        @yield('right-sidebar')
    </aside>
</div>


<div x-cloak x-bind="donateModalBack" class="fixed inset-0 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="modal-title-1">
    <div x-show="donateModal" x-transition.opacity="" class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true" style=""></div>

    <div x-show="donateModal" x-transition="" x-on:click="donateModal = false" class="relative min-h-screen flex items-center justify-center p-4" style="">
        <div x-on:click.stop="" x-trap.noscroll.inert="donateModal" class="relative max-w-2xl w-full bg-white rounded-xl shadow-lg p-12 overflow-y-auto">
            <h2 class="text-3xl font-bold" :id="$id('modal-title')" id="modal-title-1">Помочь проекту</h2>

            <p class="mt-2 text-gray-600">
                Вы можете помочь проекту не только делом, но и финансово. Все полученные средства будут потрачены на разработку. Есть возможность перевода через ЮМани, qiwi и криптовалюту (USDT по сети BEP20)
            </p>

            <div x-data="{showCrypto: false}" class="mt-2 text-gray-600">
                <a href="https://yoomoney.ru/to/410012996693720" class="inline-block my-4 bg-white border border-gray-200 rounded-md px-5 py-2.5">
                    YooMoney
                </a>

                <a href="https://my.qiwi.com/Danyl-Shchoq6rCBGMi" class="inline-block my-4 bg-white border border-gray-200 rounded-md px-5 py-2.5">
                    QIWI
                </a>

                <a @click="showCrypto=!showCrypto" href="#" class="inline-block my-4 bg-white border border-gray-200 rounded-md px-5 py-2.5">
                    Криптовалюта
                </a>

                <div x-show="showCrypto">
                    <p class="mt-2 text-pink">
                        0x10667e83c744483e2c9c77e4b3064ca7e5b8bdf3
                    </p>

                    <img class="block w-48" src="/images/donate_usdt.png" alt="" />
                </div>
            </div>

            <div class="mt-8 flex space-x-2">
                <button type="button" x-on:click="donateModal = false" class="bg-white border border-gray-200 rounded-md px-5 py-2.5">
                    Передумал
                </button>
            </div>
        </div>
    </div>
</div>

@production
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(90631105, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/90631105" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
@endproduction

</body>
</html>
