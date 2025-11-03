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

При установке **MoonShine**, публикуется шаблон по умолчанию `app/MoonShine/Layouts/AppLayout.php` и регистрируется в конфигурационном файле.

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
use MoonShine\Laravel\Layouts\AppLayout;
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

final class MoonShineLayout extends AppLayout
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
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
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

### Упрощенное отображение контента

Вы можете убрать обводку и фон у контентной части страницы, установив свойство `$contentSimpled = true` в вашем `Layout`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $contentSimpled = true; // default false
}
```


### Отображение контента по центру

По умолчанию контент страницы занимает всю ширину экрана. Чтобы разместить его в центрированном контейнере фиксированной ширины, установите свойство `$contentCentered = true` в вашем `Layout`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $contentCentered = true; // default false
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

По умолчанию страницы используют шаблон отображения `AppLayout`.
Но вы можете изменить его на собственный шаблон, просто заменив значение свойства `$layout`.

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

<a name="assets-inline"></a>
### Добавление инлайн-стилей

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
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
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

В **Moonshine** "из коробки" доступна поддержка двух тем оформления — светлой и тёмной.
По умолчанию используется тема, заданная в системе, либо светлая, если определить не удалось.

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

Каждый шаблон может иметь собственную цветовую схему, определяемую в методе `colors()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Contracts\ColorManager\ColorManagerContract;

final class MyLayout extends AppLayout
{
    // ...

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        $colorManager
            ->primary('#1E96FC')
            ->secondary('#1D8A99')
            ->body('249, 250, 251')
            ->dark('30, 31, 67', 'DEFAULT')
            ->dark('249, 250, 251', 50)
            ->dark('243, 244, 246', 100)
            ->dark('229, 231, 235', 200)
            ->dark('209, 213, 219', 300)
            ->dark('156, 163, 175', 400)
            ->dark('107, 114, 128', 500)
            ->dark('75, 85, 99', 600)
            ->dark('55, 65, 81', 700)
            ->dark('31, 41, 55', 800)
            ->dark('17, 24, 39', 900)
            ->successBg('209, 255, 209')
            ->successText('15, 99, 15')
            ->warningBg('255, 246, 207')
            ->warningText('92, 77, 6')
            ->errorBg('255, 224, 224')
            ->errorText('81, 20, 20')
            ->infoBg('196, 224, 255')
            ->infoText('34, 65, 124');

        $colorManager
            ->body('27, 37, 59', dark: true)
            ->dark('83, 103, 132', 50, dark: true)
            ->dark('74, 90, 121', 100, dark: true)
            ->dark('65, 81, 114', 200, dark: true)
            ->dark('53, 69, 103', 300, dark: true)
            ->dark('48, 61, 93', 400, dark: true)
            ->dark('41, 53, 82', 500, dark: true)
            ->dark('40, 51, 78', 600, dark: true)
            ->dark('39, 45, 69', 700, dark: true)
            ->dark('27, 37, 59', 800, dark: true)
            ->dark('15, 23, 42', 900, dark: true)
            ->successBg('17, 157, 17', dark: true)
            ->successText('178, 255, 178', dark: true)
            ->warningBg('225, 169, 0', dark: true)
            ->warningText('255, 255, 199', dark: true)
            ->errorBg('190, 10, 10', dark: true)
            ->errorText('255, 197, 197', dark: true)
            ->infoBg('38, 93, 205', dark: true)
            ->infoText('179, 220, 255', dark: true);
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
