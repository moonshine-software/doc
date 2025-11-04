---
video: https://www.youtube.com/watch?v=6eUtdbCLVZQ
---

# Layout

- [Basics](#basics)
- [Creating a Template](#create)
- [Changing the Page Template](#page)
- [Assets](#assets)
- [Favicons](#favicons)
- [Menu](#menu)
    - [Top Menu](#top-menu)
- [Themes](#themes)
    - [Dark mode](#dark-mode)
    - [Toggle themes on/off](#toggle-on-off-themes)
- [Colors](#colors)
- [Fragments](#fragments)
- [Blade](#blade)

---

<a name="basics"></a>
## Basics

`Layout` in **MoonShine** is a set of components that form the structure of the admin panel page.
Each element of the page, including HTML tags, is a **MoonShine** component.
This provides a high degree of flexibility and customization options.

When installing **MoonShine**, the default template `app/MoonShine/Layouts/AppLayout.php` is published and registered in the configuration file.

You can:

- Modify an existing template,
- Create a new template,
- Apply different templates for various pages.

An example of a possible template for your application:

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

As you can see, everything in **MoonShine**, starting from the <html> tag, consists of components, which provides tremendous freedom to customize your admin panel.

Find the complete list of components in the [Components](/docs/{{version}}/components/index) section.

> [!NOTE]
> As you may notice, there are a huge number of components, and for convenience, we have grouped them together so that you can conveniently override only the groups required.

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

In the example above, we have overridden the output of the footer menu and copyright using the methods `getFooterMenu()` and `getFooterCopyright()`.

Available quick methods:

### Override the Head component

```php
protected function getHeadComponent(bool $withAssetsFragment = true): Head
{
    return Head::make([
        // ...
    ]);
}
```

### Override the Logo component

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

### Override the Sidebar component

```php
protected function getSidebarComponent(): Sidebar
{
    return Sidebar::make([
        // ...
    ]);
}
```

### Override the Header component

```php
protected function getHeaderComponent(): Header
{
    Header::make([
        // ...
    ]);
}
```

### Override or integrate the TopBar component

```php
protected function getTopBarComponent(): Topbar
{
    Topbar::make([
        // ...
    ]);
}
```

### Override the Footer component

```php
protected function getFooterComponent(): Footer
{
    Footer::make([
        // ...
    ]);
}
```

### Override the Profile component

```php
protected function getProfileComponent(bool $sidebar = false): Profile
{
    return Profile::make(withBorder: $sidebar);
}
```

### Override the сontent of the Content component

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

### Path to the logo

```php
protected function getLogo(bool $small = false): string
{
    // ...
}
```

### URL of the main page

```php
protected function getHomeUrl(): string
{
    // ...
}
```

### Simplified Content Layout

You can remove the border and background from the content block of the page by setting the `$contentSimpled = true` property in your `Layout`:

```php
protected bool $contentSimpled = true; // default false
```


### Centered Content Layout

By default, page content takes up the entire width of the screen. To place it in a centered fixed-width container, set the `$contentCentered = true` property in your `Layout`.

```php
protected bool $contentCentered = true; // default false
```

<a name="slots"></a>
### Slots

With the help of "slots" you can quickly add components to the `Sidebar` or `Topbar`.

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
> You can also create your custom template with your own set of convenient methods for easier interaction in the future.

> [!NOTE]
> In the standard Layout, the `Sidebar`, `Topbar`, and `Mobilebar` components are designed in the dark colors.
> But if you add other components to them, they will change depending on the chosen theme, which will lead to incorrect display.
> To avoid this behavior, you can force them into dark mode by adding the 'dark' class.

```php
$this->getSidebarComponent()->class('dark'),

$this->getTopBarComponent()->class('dark'),

MobileBar::make([
    // ...
])->class('dark'),
```

<a name="create"></a>
## Creating a Template

To create another template, use the command:

```shell
php artisan moonshine:layout
```

> [!NOTE]
> You can learn about all supported options in the section [Commands](/docs/{{version}}/advanced/commands#layout).

<a name="page"></a>
## Changing the Page Template

By default, pages use the display template `AppLayout`.
But you can change it to your custom template by simply replacing the value of the `$layout` property.

Read more about pages in the [Page](/docs/{{version}}/page/index) section.

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

Each template can have its own set of styles and scripts defined through the `assets()` method.

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
> For more detailed information, refer to the [Assets](/docs/{{version}}/appearance/assets) section.

<a name="assets-inline"></a>
### Adding inline styles

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

You can replace the set of favicons in a template by overriding the `getFaviconComponent()` method.

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
## Menu

For each template, you can declare a list of menu items via the `menu()` method, which will be automatically passed to the `Menu` component.

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
> For more detailed information, refer to the [Menu](/docs/{{version}}/appearance/menu) section.

> [!TIP]
> You can also choose not to use the `menu()` method and pass the list manually to the `Menu` component.

<a name="top-menu"></a>
### Top Menu

By default, **MoonShine** has a top menu component that can be used instead of `Sidebar` or together with it.
Let’s see how to replace `Sidebar` with `TopBar` in `Layout`.

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
> If you want to keep both Sidebar and TopBar at the same time, be sure to maintain the order; TopBar must be first.

<a name="themes"></a>
## Themes

**Moonshine** supports two themes out of the box: light and dark.
By default, the theme specified in the system is used, or light if it could not be determined.

<a name="dark-mode"></a>
### Dark mode

If you want the dark theme to always be enabled, override the `isAlwaysDark()` method and return `true`. The theme switcher will not be displayed.

```php
protected function isAlwaysDark(): bool
{
    return true;
}
```

<a name="toggle-on-off-themes"></a>
### Toggle themes on/off

To remove the theme switcher and leave only the light theme, override the `hasThemes()` method and return `false`.

```php
protected function hasThemes(): bool
{
    return false;
}
```

<a name="colors"></a>
## Colors

Each template can have its own color scheme defined in the `colors()` method.

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
> For more detailed information, refer to the [Color Scheme](/docs/{{version}}/appearance/colors) section.

<a name="fragments"></a>
### Fragments

By default, in the base layout, its individual parts are located inside `Fragment` components. Due to this, you can update them without reloading the page using [JSEvents](/docs/{{version}}/frontend/js#events) events.

Available fragments:

- `sidebar-top` - The top part of the side menu (logo and theme switch),
- `sidebar-content` - Content part of the side menu,
- `topbar-logo` - Logo in the top menu,
- `topbar-menu` - Top menu items,
- `topbar-actions` - Action block in the top menu,
- `assets` - A set of styles and scripts.

An example of updating all layout fragments from a controller method:

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

**MoonShine** allows you to create templates directly using **Blade**.

An example of a basic template:

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
