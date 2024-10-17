# Layout

- [Основы](#basics)
- [Создание шаблона](#сreate)
- [Изменение шаблона страницы](#page)
- [Assets](#assets)
- [Меню](#menu)
    - [Верхнее меню](#top-menu)
- [Цвета](#colors)
- [Blade](#blade)

---

<a name="basics"></a>
## Основы

`Layout` это набор компонентов из которых состоит страницы в `MoonShine`. Каждый элемент страницы, каждый `HTML` тег является компонентом `MoonShine`. Вы можете изменять набор компонентов под себя, удалять или добавлять новые! Каждая страница может иметь свой собственный `Layout`.

По умолчанию в `MoonShine` есть два готовых шаблона с набором компонентов, базовый - `AppLayout` и компактный `CompactLayout`. При установке `MoonShine` у вас был выбор какой шаблон выбрать по умолчанию, после чего он был опубликован в директорию `app/MoonShine/Layouts` и объявлен в конфиге `moonshine.layout`. Вы всегда можете заменить `Layout` по умолчанию на свой или просто его модифицировать или создать еще шаблонов и применять их для различных страниц отдельно.

Пример возможного шаблона вашего приложения:

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\PackageCategoryResource;
use App\MoonShine\Resources\PackageResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Assets,
    Layout\Block,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Favicon,
    Layout\Flash,
    Layout\Footer,
    Layout\Head,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Meta,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\Wrapper,
    When};

final class MoonShineLayout extends CompactLayout
{
    // ...

    public function build(): Layout
    {
        return Layout::make([
            Html::make([
                Head::make([
                    Meta::make()->customAttributes([
                        'name' => 'csrf-token',
                        'content' => csrf_token(),
                    ]),
                    Favicon::make()->bodyColor($this->getColorManager()->get('body')),
                    Assets::make(),
                ])
                    ->bodyColor($this->getColorManager()->get('body'))
                    ->title($this->getPage()->getTitle()),
                Body::make([
                    Wrapper::make([
                        Sidebar::make([
                            Block::make([
                                Block::make([
                                    Logo::make(
                                        $this->getHomeUrl(),
                                        $this->getLogo(),
                                        $this->getLogo(small: true),
                                    )->minimized(),
                                ])->class('menu-heading-logo'),

                                Block::make([
                                    Block::make([
                                        ThemeSwitcher::make(),
                                    ])->class('menu-heading-mode'),

                                    Block::make([
                                        Burger::make(),
                                    ])->class('menu-heading-burger'),
                                ])->class('menu-heading-actions'),
                            ])->class('menu-heading'),

                            Block::make([
                                Menu::make(),
                                When::make(
                                    fn(): bool => $this->isAuthEnabled(),
                                    static fn(): array => [Profile::make(withBorder: true)],
                                ),
                            ])->customAttributes([
                                'class' => 'menu',
                                ':class' => "asideMenuOpen && '_is-opened'",
                            ]),
                        ])->collapsed(),

                        Block::make([
                            Flash::make(),
                            Header::make([
                                Breadcrumbs::make($this->getPage()->getBreadcrumbs())->prepend(
                                    $this->getHomeUrl(),
                                    icon: 'home',
                                ),
                                Search::make(),
                                When::make(
                                    fn(): bool => $this->isUseNotifications(),
                                    static fn(): array => [Notifications::make()],
                                ),
                                Locales::make(),
                            ]),

                            Content::make([
                                Components::make(
                                    $this->getPage()->getComponents(),
                                ),
                            ]),

                            Footer::make()
                                ->copyright(static fn(): string
                                    => sprintf(
                                    <<<'HTML'
                                        &copy; 2021-%d Made with ❤️ by
                                        <a href="https://cutcode.dev"
                                            class="font-semibold text-primary hover:text-secondary"
                                            target="_blank"
                                        >
                                            CutCode
                                        </a>
                                        HTML,
                                    now()->year,
                                ))
                                ->menu([
                                    'https://moonshine-laravel.com/docs' => 'Documentation',
                                ]),
                        ])->class('layout-page'),
                    ]),
                ])->class('theme-minimalistic'),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->withThemes(),
        ]);
    }
}
```

Как видите начиная от тега `HTML` все в `MoonShine` является компонентами, что дает огромную свободу кастомизации вашей админ. панели.

> [!TIP]
> Как можно заметить компонентов огромное количество и для удобства, мы объединили их в группы, чтобы вы могли удобно переопределять только те группы, которые требуется

```php
<?php
// ..
final class MoonShineLayout extends CompactLayout
{
    // ...

    protected function getFooterMenu(): array
    {
        return [
            'https://example.com' => 'Custom link',
        ];
    }

    protected function getFooterCopyright(): string
    {
        return 'MoonShine';
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
```

В примере в помощью методов `getFooterMenu`, `getFooterMenu` мы переопределили вывод меню в футере и copyright

Доступные быстрые методы:

#### Переопределить компонент Head

```php
protected function getHeadComponent(): Head
```

#### Переопределить компонент Logo

```php
protected function getLogoComponent(): Logo
```

#### Переопределить компонент Sidebar

```php
protected function getSidebarComponent(): Sidebar
```

#### Переопределить компонент Sidebar

```php
protected function getHeaderComponent(): Header
```

#### Переопределить или интегрировать компонент Topbar

```php
protected function getTopBarComponent(): Topbar
```

#### Переопределить компонент Footer

```php
protected function getFooterComponent(): Footer
```

#### Путь до логотипа

```php
protected function getLogo(bool $small = false): string
```

#### URL главной страницы

```php
protected function getHomeUrl(): string
```

> [!TIP]
> Вы также можете создать собственный шаблон со своим набором удобных методов для дальнейшего удобного взаимодействия

<a name="publish"></a>
## Создание шаблона

Чтобы создать еще один шаблон воспользуйтесь командой

```
php artisan moonshine:layout
```

После создания `Layout` появится в директории `app/MoonShine/Layouts`.

<a name="page"></a>
## Изменение шаблона страницы

По умолчанию страницы используют шаблон отображения `AppLayout` или `CompactLayout`. 
Но вы можете изменить на собственный шаблон, просто заменив значение свойства `$layout`

Подробнее про страницы читайте в разделе [Страница](docs/{{version}}/page/index)

```php
use App\MoonShine\Layouts\MyLayout;

class CustomPage extends Page
{
    protected ?string $layout = MyLayout::class;

    //...
}
```

<a name="assets"></a>
## Assets

Для каждого шаблона можно объявить свой набор стилей и скриптов через метод `assets()`

```php
final class MyLayout extends AppLayout
{
    // ..

    protected function assets(): array
    {
        return [
            ...parent::assets(),
    
            Css::make('/vendor/moonshine/assets/minimalistic.css')->defer(),
        ];
    }

    // ..
}
```

> [!NOTE]
> За более подробной информацией обратитесь в раздел [Assets](/docs/{{version}}/appearance/assets)

<a name="menu"></a>
## Меню

<a name="top-menu"></a>
### Верхнее меню

По умолчанию MoonShine имеет компонент верхнего меню. Давайте посмотрим, как заменить `Sidebar` на `TopBar` в `Layout`.

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

<a name="colors"></a>
## Цвета

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
