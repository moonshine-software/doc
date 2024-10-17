# Layout

- [Основы](#basics)
- [Создание шаблона](#publish)
- [Верхнее меню](#top-menu)
- [Blade](#blade)

---

<a name="publish"></a>
## Публикация шаблона

Чтобы изменить структуру шаблона, вы должны использовать `LayoutBuilder`.
    
Первым шагом является публикация класса модификации шаблона с помощью консольной команды.

```
php artisan moonshine:publish layout
```

> [!WARNING]
> Для выбора соответствующего элемента необходимо использовать клавишу пробела.

После публикации *Layout*, класс `MoonShineLayout.php` появится в директории `app/MoonShine`.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
    Flash,
    Footer,
    Header,
    LayoutBlock,
    LayoutBuilder,
    Menu,
    Profile,
    Search,
    Sidebar};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                When::make(
                    static fn() => config('moonshine.auth.enable', true),
                    static fn() => [Profile::make(withBorder: true)]
                ),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    Search::make(),
                ]),
                Content::make(),
                Footer::make()->copyright(fn (): string => <<<HTML
                        &copy; 2021-2023 Made with ?? by
                        <a href="https://cutcode.dev"
                            class="font-semibold text-primary hover:text-secondary"
                            target="_blank"
                        >
                            CutCode
                        </a>
                    HTML)->menu([
                    'https://moonshine.cutcode.dev' => 'Documentation',
                ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
```

<a name="top-menu"></a>
## Верхнее меню

По умолчанию MoonShine имеет компонент верхнего меню. Давайте посмотрим, как заменить `Sidebar` на `TopBar` в `LayoutBuilder`.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
    Flash,
    Footer,
    Header,
    LayoutBlock,
    LayoutBuilder,
    Menu,
    Profile,
    Search,
    TopBar};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->actions([
                    When::make(
                        static fn() => config('moonshine.auth.enable', true),
                        static fn() => [Profile::make()]
                    )
                ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    Search::make(),
                ]),
                Content::make(),
                Footer::make()->copyright(fn (): string => <<<HTML
                        &copy; 2021-2023 Made with ?? by
                        <a href="https://cutcode.dev"
                            class="font-semibold text-primary hover:text-secondary"
                            target="_blank"
                        >
                            CutCode
                        </a>
                    HTML)->menu([
                    'https://moonshine.cutcode.dev' => 'Documentation',
                ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
```


<a name="blade"></a>
## Blade

```blade
<x-moonshine::layout>
    <x-moonshine::layout.html :with-alpine-js="true" :with-themes="true">
        <x-moonshine::layout.head>
            <x-moonshine::layout.meta name="csrf-token" :content="csrf_token()"/>
            <x-moonshine::layout.favicon />
            <x-moonshine::layout.assets>
                @vite([
                    'resources/css/main.css',
                    'resources/js/app.js',
                ], 'vendor/moonshine')
            </x-moonshine::layout.assets>
        </x-moonshine::layout.head>

        <x-moonshine::layout.body>
            <x-moonshine::layout.wrapper>
                <x-moonshine::layout.sidebar :collapsed="true">
                    <x-moonshine::layout.block class="menu-heading">
                        <x-moonshine::layout.block class="menu-heading-logo">
                            <x-moonshine::layout.logo href="/" logo="/logo.png" :minimized="true"/>
                        </x-moonshine::layout.block>

                        <x-moonshine::layout.block class="menu-heading-actions">
                            <x-moonshine::layout.block class="menu-heading-mode">
                                <x-moonshine::layout.theme-switcher/>
                            </x-moonshine::layout.block>
                            <x-moonshine::layout.block class="menu-heading-burger">
                                <x-moonshine::layout.burger/>
                            </x-moonshine::layout.block>
                        </x-moonshine::layout.block>

                    </x-moonshine::layout.block>

                    <x-moonshine::layout.block class="menu" ::class="asideMenuOpen && '_is-opened'">
                        <x-moonshine::layout.menu :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]"/>
                    </x-moonshine::layout.block>
                </x-moonshine::layout.sidebar>

                <x-moonshine::layout.block class="layout-page">
                    <x-moonshine::layout.header>
                        <x-moonshine::breadcrumbs :items="['#' => 'Home']"/>
                        <x-moonshine::layout.search placeholder="Search" />
                        <x-moonshine::layout.locales :locales="collect()"/>
                    </x-moonshine::layout.header>

                    <x-moonshine::layout.content>
                        <article class="article">
                            Content here
                        </article>
                    </x-moonshine::layout.content>
                </x-moonshine::layout.block>
            </x-moonshine::layout.wrapper>
        </x-moonshine::layout.body>
    </x-moonshine::layout.html>
</x-moonshine::layout>
```
