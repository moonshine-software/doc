---
video: https://www.youtube.com/watch?v=95qxienFmtI
---

# Layout

- [Основы](#basics)
- [Создание шаблона](#create)
- [Изменение шаблона страницы](#page)
- [Assets](#assets)
- [Favicons](#favicons)
- [Меню](#menu)
    - [Верхнее меню](#top-menu)
- [Темы оформления](#themes)
    - [Тёмная тема](#dark-mode)
    - [Вкл/выкл тем оформления](#toggle-on-off-themes)
- [Цвета](#colors)
- [Blade](#blade)

---

<a name="basics"></a>
## Основы

`Layout` в **MoonShine** представляет собой набор компонентов, формирующих структуру страницы административной панели.
Каждый элемент страницы, включая HTML теги, является компонентом **MoonShine**.
Это обеспечивает высокую степень гибкости и возможность кастомизации.

**MoonShine** предлагает два готовых шаблона:

- `AppLayout` - базовый шаблон,
- `CompactLayout` - компактный шаблон.

При установке **MoonShine** вы выбираете один из этих шаблонов по умолчанию.
Выбранный шаблон публикуется в директорию `app/MoonShine/Layouts` и указывается в конфигурационном файле `moonshine.layout`.

Вы можете:

- Модифицировать существующий шаблон,
- Создать новый шаблон,
- Применять разные шаблоны для различных страниц.

Пример возможного шаблона вашего приложения:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
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
    Layout\Div,
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
    When}; // [tl! collapse:end]

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
                            Div::make([
                                Div::make([
                                    Logo::make(
                                        $this->getHomeUrl(),
                                        $this->getLogo(),
                                        $this->getLogo(small: true),
                                    )->minimized(),
                                ])->class('menu-heading-logo'),

                                Div::make([
                                    Div::make([
                                        ThemeSwitcher::make(),
                                    ])->class('menu-heading-mode'),

                                    Div::make([
                                        Burger::make(),
                                    ])->class('menu-heading-burger'),
                                ])->class('menu-heading-actions'),
                            ])->class('menu-heading'),

                            Div::make([
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

                        Div::make([
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

Как видите, всё в **MoonShine**, начиная от тега <html> является компонентами, что дает огромную свободу кастомизации вашей админ-панели.

Полный список компонентов ищите в разделе [Компоненты](/docs/{{version}}/components/index).

> [!NOTE]
> Как можно заметить, компонентов огромное количество, и для удобства мы объединили их в группы, чтобы вы могли удобно переопределять только те группы, которые требуются.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\CompactLayout;

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

В примере выше, с помощью методов `getFooterMenu()` и `getFooterCopyright()`, мы переопределили вывод меню в футере и copyright.

Доступные быстрые методы:

### Переопределить компонент Head

```php
protected function getHeadComponent(): Head
{
    return Head::make([
        // ...
    ]);
}
```

### Переопределить компонент Logo

```php
protected function getLogoComponent(): Logo
{
    return Logo::make(
        $this->getHomeUrl(),
        $this->getLogo(),
        $this->getLogo(small: true),
    );
}
```

### Переопределить компонент Sidebar

```php
protected function getSidebarComponent(): Sidebar
{
    return Sidebar::make([
        // ...
    ]);
}
```

### Переопределить компонент Header

```php
protected function getHeaderComponent(): Header
{
    Header::make([
        // ...
    ]);
}
```

### Переопределить или интегрировать компонент TopBar

```php
protected function getTopBarComponent(): Topbar
{
    Topbar::make([
        // ...
    ]);
}
```

### Переопределить компонент Footer

```php
protected function getFooterComponent(): Footer
{
    Footer::make([
        // ...
    ]);
}
```

### Переопределить компонент Profile

```php
protected function getProfileComponent(bool $sidebar = false): Profile
{
    return Profile::make(withBorder: $sidebar);
}
```

### Переопределить содержимое компонента Content

```php
protected function getContentComponents(): array
{
    // ...
}
```

```php
Content::make(
    $this->getContentComponents()
)
```

### Путь до логотипа

```php
protected function getLogo(bool $small = false): string
{
    // ...
}
```

### URL главной страницы

```php
protected function getHomeUrl(): string
{
    // ...
}
```

<a name="slots"></a>
### Slots

С помощью "слотов" вы можете быстро добавить компоненты в `Sidebar` или `Topbar`.

```php
protected function sidebarSlot(): array
{
    return [
        Search::make()->enabled(),
        // ...
    ];
}

protected function sidebarTopSlot(): array
{
    return [
        Notifications::make(),
        // ...
    ];
}

protected function topBarSlot(): array
{
    return [
        // ...
    ];
}
```

> [!TIP]
> Вы также можете создать собственный шаблон со своим набором удобных методов для дальнейшего удобного взаимодействия.

> [!NOTE]
> В стандартном Layout компоненты `Sidebar`, `Topbar` и `Mobilebar` оформлены в темных цветах.
> Но если добавить в них другие компоненты, они будут меняться в зависимости от выбранной темы, что приведёт к некорректному их отображению.
> Чтобы избежать такого поведения, можно принудительно перевести их в тёмный режим добавив класс 'dark'.

```php
$this->getSidebarComponent()->class('dark'),

$this->getTopBarComponent()->class('dark'),

MobileBar::make([
    // ...
])->class('dark'),
```

<a name="create"></a>
## Создание шаблона

Чтобы создать еще один шаблон, воспользуйтесь командой:

```shell
php artisan moonshine:layout
```

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#layout).

<a name="page"></a>
## Изменение шаблона страницы

По умолчанию страницы используют шаблон отображения `AppLayout` или `CompactLayout`.
Но вы можете изменить на собственный шаблон, просто заменив значение свойства `$layout`.

Подробнее про страницы читайте в разделе [Страница](/docs/{{version}}/page/index).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Layouts\MyLayout;
use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    protected ?string $layout = MyLayout::class;

    // ...
}
```

<a name="assets"></a>
## Assets

Каждый шаблон может иметь свой набор стилей и скриптов, определяемых через метод `assets()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\AssetManager\Css;

final class MyLayout extends AppLayout
{
    // ...

    protected function assets(): array
    {
        return [
            ...parent::assets(),

            Css::make('/vendor/moonshine/assets/minimalistic.css')->defer(),
        ];
    }

    // ...
}
```

> [!NOTE]
> За более подробной информацией обратитесь в раздел [Assets](/docs/{{version}}/appearance/assets).

<a name="compact-with-rounded"></a>
### Компактная тема с rounded radius

```php
protected function assets(): array
{
    return [
        ...parent::assets(),
        InlineCss::make(<<<'Style'
            :root {
              --radius: 0.15rem;
              --radius-sm: 0.075rem;
              --radius-md: 0.275rem;
              --radius-lg: 0.3rem;
              --radius-xl: 0.4rem;
              --radius-2xl: 0.5rem;
              --radius-3xl: 1rem;
              --radius-full: 9999px;
            }
        Style),
    ];
}
```

<a name="favicons"></a>
## Favicons

Вы можете заменить набор favicons в шаблоне через переопределение метода `getFaviconComponent()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MyLayout extends AppLayout
{
    // ...

    protected function getFaviconComponent(): Favicon
    {
        return parent::getFaviconComponent()->customAssets([
            'apple-touch' => 'favicon_path',
            '32' => 'favicon_path',
            '16' => 'favicon_path',
            'safari-pinned-tab' => 'favicon_path',
            'web-manifest' => 'favicon_path',
        ]);
    }
}
```

<a name="menu"></a>
## Меню

Для каждого шаблона можно объявить список пунктов меню через метод `menu()`, которые автоматически будут переданы в компонент `Menu`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuItem;

final class MyLayout extends AppLayout
{
    // ...

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make(ArticleResource::class),
        ];
    }
}
```

> [!NOTE]
> За более подробной информацией обратитесь в раздел [Меню](/docs/{{version}}/appearance/menu).

> [!TIP]
> Вы также можете не пользоваться методом `menu()`, а передать список вручную в компонент `Menu`.

<a name="top-menu"></a>
### Верхнее меню

По умолчанию **MoonShine** имеет компонент верхнего меню, который можно использовать вместо `Sidebar` или совместно с ним.
Давайте посмотрим, как заменить `Sidebar` на `TopBar` в `Layout`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\CompactLayout;

final class MoonShineLayout extends CompactLayout
{
    // ...

    public function build(): Layout
    {
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),
                Body::make([
                    Wrapper::make([
                        $this->getTopBarComponent(),
                        //$this->getSidebarComponent(),
                        Div::make([
                            Flash::make(),
                            $this->getHeaderComponent(),

                            Content::make([
                                Components::make(
                                    $this->getPage()->getComponents()
                                ),
                            ]),

                            $this->getFooterComponent(),
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

> [!WARNING]
> Если вы хотите оставить и Sidebar и TopBar одновременно, то обязательно соблюдайте очередность, первым должен идти TopBar.

<a name="themes"></a>
## Темы оформления

В **Moonshine** "из коробки" доступна поддержка двух тем оформления — светлой и тёмной. По умолчанию используется тема, заданная в системе, либо светлая, если определить не удалось.

<a name="dark-mode"></a>
### Тёмная тема

Если вы хотите, чтобы тёмная тема всегда была включена, переопределите метод `isAlwaysDark()` и верните `true`. Переключатель тем при этом отображаться не будет.

```php
protected function isAlwaysDark(): bool
{
    return true;
}
```

<a name="toggle-on-off-themes"></a>
### Вкл/выкл тем оформления

Чтобы убрать переключатель тем и оставить только светлую тему, переопределите метод `hasThemes()` и верните `false`.

```php
protected function hasThemes(): bool
{
    return false;
}
```

<a name="colors"></a>
## Цвета

Каждый шаблон может иметь собственную цветовую схему.  
Самый простой способ — указать реализацию `PaletteContract` в свойстве `$palette`:

```php
use App\MoonShine\Palettes\CorporatePalette;
use MoonShine\Laravel\Layouts\AppLayout;

final class MyLayout extends AppLayout
{
    protected ?string $palette = CorporatePalette::class;
}
```

Если требуется полное управление, переопределите метод `colors()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Contracts\ColorManager\ColorManagerContract;

final class MyLayout extends AppLayout
{
    protected function colors(ColorManagerContract $colorManager): void
    {
        $colorManager
            ->primary('oklch(65% 0.18 264)')
            ->secondary('oklch(70% 0.14 230)')
            ->bulkAssign([
                'theme' => [
                    'body' => '0 0 0',
                    50 => '0.99 0 0',
                    100 => '0.98 0 0',
                    900 => '0.90 0 0',
                ],
            ])
            ->successBg('oklch(63.9% 0.218 142.495)')
            ->warningBg('oklch(80.88% 0.170358 75.3501)')
            ->errorBg('oklch(58.9% 0.214 26.855)')
            ->infoBg('oklch(60.1% 0.219 257.63)');

        $colorManager
            ->set('body', '0.2 0.0168 274.32', dark: true)
            ->theme([
                'body' => '1 0 0',
                'stroke' => '1 0 0 / 10%',
                'default' => '0.24 0.0168 274.32',
                900 => '0.39 0.025 274.32',
            ], dark: true)
            ->successBg('0.639 0.218 142.495', dark: true)
            ->warningBg('0.898 0.177 96.726', dark: true)
            ->errorBg('0.589 0.214 26.855', dark: true)
            ->infoBg('0.601 0.219 257.63', dark: true);
    }
}
```

> [!NOTE]
> За более подробной информацией обратитесь в раздел [Цветовая схема](/docs/{{version}}/appearance/colors).

<a name="blade"></a>
## Blade

**MoonShine** позволяет создавать шаблоны напрямую через **Blade**.

Пример базового шаблона:

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
                    <x-moonshine::layout.div class="menu-heading">
                        <x-moonshine::layout.div class="menu-heading-logo">
                            <x-moonshine::layout.logo href="/" logo="/logo.png" :minimized="true"/>
                        </x-moonshine::layout.div>

                        <x-moonshine::layout.div class="menu-heading-actions">
                            <x-moonshine::layout.div class="menu-heading-mode">
                                <x-moonshine::layout.theme-switcher/>
                            </x-moonshine::layout.div>
                            <x-moonshine::layout.div class="menu-heading-burger">
                                <x-moonshine::layout.burger/>
                            </x-moonshine::layout.div>
                        </x-moonshine::layout.div>

                    </x-moonshine::layout.div>

                    <x-moonshine::layout.div class="menu" ::class="asideMenuOpen && '_is-opened'">
                        <x-moonshine::layout.menu :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]"/>
                    </x-moonshine::layout.div>
                </x-moonshine::layout.sidebar>

                <x-moonshine::layout.div class="layout-page">
                    <x-moonshine::layout.header>
                        <x-moonshine::breadcrumbs :items="['#' => 'Home']"/>
                        <x-moonshine::layout.search placeholder="Search" />
                        <x-moonshine::layout.locales :locales="collect()"/>
                    </x-moonshine::layout.header>

                    <x-moonshine::layout.content>
                        <article class="article">
                            Your content
                        </article>
                    </x-moonshine::layout.content>
                </x-moonshine::layout.div>
            </x-moonshine::layout.wrapper>
        </x-moonshine::layout.body>
    </x-moonshine::layout.html>
</x-moonshine::layout>
```
