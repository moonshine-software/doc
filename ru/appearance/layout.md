---
video: https://www.youtube.com/watch?v=95qxienFmtI
---

# Layout

- [Основы](#basics)
- [Управление компонентами](#sugar)
    - [Sidebar](#sidebar)
    - [TopBar](#topbar)
    - [BottomBar](#bottombar)
    - [Мобильный режим](#mobile-mode)
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
- [Fragments](#fragments)
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

Полный список компонентов ищите в разделе [Компоненты](/docs/{{version}}/components/index).

> [!NOTE]
> Как можно заметить, компонентов огромное количество, и для удобства мы объединили их в группы,
> чтобы вы могли удобно переопределять только те группы, которые требуются.

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
protected function getHeadComponent(bool $withAssetsFragment = true): Head
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
protected function getProfileComponent(): Profile
{
    return Profile::make();
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
protected bool $contentSimpled = true; // default false
```


### Отображение контента по центру

По умолчанию контент страницы занимает всю ширину экрана.
Чтобы разместить его в центрированном контейнере фиксированной ширины, установите свойство `$contentCentered = true` в вашем `Layout`.

```php
protected bool $contentCentered = true; // default false
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

<a name="sugar"></a>
## Управление компонентами

**MoonShine** предоставляет удобный способ управления отображением основных компонентов шаблона через защищённые свойства класса.
Это позволяет быстро включать или отключать элементы интерфейса без переопределения метода `build()`.

<a name="sidebar"></a>
### Sidebar

По умолчанию боковое меню включено. Чтобы отключить его, установите свойство `$sidebar = false` в вашем шаблоне:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $sidebar = false;

    // ...
}
```

<a name="topbar"></a>
### TopBar

Верхняя панель по умолчанию отключена. Чтобы включить её, установите свойство `$topBar = true`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $topBar = true;

    // ...
}
```

> [!WARNING]
> Если вы используете и `Sidebar` и `TopBar` одновременно, обязательно соблюдайте очередность в методе `build()` — первым должен идти `TopBar`.

<a name="bottombar"></a>
### BottomBar

Нижняя панель по умолчанию отключена. Чтобы включить её, установите свойство `$bottomBar = true`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $bottomBar = true;

    // ...
}
```

Компонент `BottomBar` автоматически отображает верхнее меню внутри себя.

<a name="mobile-mode"></a>
### Мобильный режим

Вы можете включить специальный мобильный режим, который оптимизирует интерфейс для мобильных устройств.
При включении этого режима автоматически применяются компактные стили и активируется компонент `BottomBar`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected bool $mobileMode = true;

    // ...
}
```

При включении мобильного режима:

- применяются компактные отступы и размеры элементов,
- скрывается компонент `Burger`,
- автоматически включается `BottomBar` с верхним меню.

> [!TIP]
> Вы можете комбинировать эти свойства для создания различных вариантов шаблонов — например,
> отключить `Sidebar` и включить только `TopBar` для более горизонтального интерфейса.

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
              --spacing: 0.15rem;
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

Чтобы заменить `Sidebar` на `TopBar`, переопределите метод `build()` и заменит в нём вызов метода `getSidebarComponent()` на `getTopBarComponent()`.

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

Каждый шаблон может иметь собственную цветовую схему.
Самый простой способ задать её — указать реализацию `PaletteContract` в свойстве `$palette`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Palettes\CorporatePalette;
use MoonShine\Laravel\Layouts\AppLayout;

final class MyLayout extends AppLayout
{
    protected ?string $palette = CorporatePalette::class;
}
```

> [!NOTE]
> За более подробной информацией обратитесь в раздел [Палитры](/docs/{{version}}/appearance/colors#palettes).

Если оставить `$palette` равным `null`, будет использоваться значение из `config('moonshine.palette')`.

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

<a name="fragments"></a>
### Fragments

По умолчанию в базовом шаблоне отдельные его части находятся внутри компонентов `Fragment`.
За счёт этого вы можете обновлять их без перезагрузки страницы с помощью событий [JSEvents](/docs/{{version}}/frontend/js#events).

Доступные фрагменты:

- `sidebar-top` - Верхняя часть бокового меню (логотип и переключатель темы оформления),
- `sidebar-content` - Контентная часть бокового меню,
- `topbar-logo` - Логотип в верхнем меню,
- `topbar-menu` - Пункты верхнего меню,
- `topbar-actions` - Блок действий в верхнем меню,
- `assets` - Набор стилей и скриптов.

Пример обновления всех фрагментов шаблона из метода контроллера:

```php
public function saveElement(CrudRequestContract $request): JsonResponse
{
    //...
    return JsonResponse::make()->events([
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'sidebar-top'),
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'sidebar-content'),
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'topbar-logo'),
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'topbar-menu'),
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'topbar-actions'),
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'assets'),
    ]);
}
```

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
                    <x-moonshine::layout.div class="menu-header">
                        <x-moonshine::layout.div class="menu-logo">
                            <x-moonshine::layout.logo href="/" logo="/tableau.png" logo-small="/tableau.png" :minimized="true"/>
                        </x-moonshine::layout.div>

                        <x-moonshine::layout.div class="menu-actions">
                            <x-moonshine::layout.theme-switcher/>
                        </x-moonshine::layout.div>

                        <x-moonshine::layout.div class="menu-burger">
                            <x-moonshine::layout.burger/>
                        </x-moonshine::layout.div>
                    </x-moonshine::layout.div>

                    <x-moonshine::layout.div class="menu menu--vertical">
                        <x-moonshine::layout.menu :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]"/>
                    </x-moonshine::layout.div>
                </x-moonshine::layout.sidebar>

                <x-moonshine::layout.div class="layout-main">
                    <x-moonshine::layout.div class="layout-page">
                        <x-moonshine::layout.header>
                            <x-moonshine::layout.div class="menu-burger">
                                <x-moonshine::layout.burger/>
                            </x-moonshine::layout.div>
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
                </x-moonshine::layout.div>

            </x-moonshine::layout.wrapper>
        </x-moonshine::layout.body>
    </x-moonshine::layout.html>
</x-moonshine::layout>
```
