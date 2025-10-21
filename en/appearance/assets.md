---
video: https://youtu.be/6eUtdbCLVZQ?si=_a4jgY3tnjA7jlqt&t=749
---

# Assets

- [Basics](#basics)
- [Asset Types](#asset-types)
- [Asset Collections](#asset-collections)
- [Asset Modification](#asset-modification)
- [Versioning](#versioning)
- [How to Add Assets](#how-to-add)
    - [Global](#global)
    - [Layout](#layout)
    - [CrudResource](#resource)
    - [Page](#page)
    - [Component](#component)
    - [Field](#field)
- [Conclusion via Blade](#blade)
- [Custom Build](#custom-build)

---

<a name="basics"></a>
## Basics

***AssetManager*** in **MoonShine** provides a convenient way to manage *CSS* and *JavaScript* assets for your admin panel.
It supports various types of assets, including external files, inline code, and versioning.

<a name="asset-types"></a>
## Asset Types

In **MoonShine**, there are several types of assets:

- `MoonShine\AssetManager\Js` - js through `<script src>` tag,
- `MoonShine\AssetManager\Css` - css through `<link>` tag,
- `MoonShine\AssetManager\InlineCss` - css through `<style>` tag,
- `MoonShine\AssetManager\InlineJs` - js through `<script>` tag,
- `MoonShine\AssetManager\Raw` - arbitrary content in `head`.

### JavaScript Files

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Basic inclusion
Js::make('/js/app.js');

// With deferred loading
Js::make('/js/app.js')->defer();

// With attributes
Js::make('/js/app.js')->customAttributes([
    'data-module' => 'main'
]);
```

### CSS Files

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Css;

// Basic inclusion
Css::make('/css/styles.css');

// With deferred loading
Css::make('/css/styles.css')->defer();

// With attributes
Css::make('/css/styles.css')->customAttributes([
    'media' => 'print'
]);
```

### Inline JavaScript

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\InlineJs;

InlineJs::make(<<<'JS'
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Loaded");
    });
JS);
```

### Inline CSS

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\InlineCss;

InlineCss::make(<<<'CSS'
    .custom-class {
        color: red;
    }
CSS);
```

### Raw Content

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Raw;

Raw::make('<link rel="preconnect" href="https://fonts.googleapis.com">');
```

<a name="asset-collections"></a>
## Asset Collections

***AssetManager*** allows managing the loading order of assets.
We recommend using DI to start interacting with ***AssetManager***, for the service is responsible through the interface `MoonShine\Contracts\AssetManager\AssetManagerContract`.
Also, **MoonShine** provides convenient methods to interact with ***AssetManager*** in different entities such as `CrudResource`, `Page`, `Layout`, `Component` and `Field`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Add assets to the end
$assetManager->append([
    Js::make('/js/last.js')
]);

// Add assets to the beginning
$assetManager->prepend([
    Js::make('/js/first.js')
]);

// Add assets in the order of addition
$assetManager->add([
    Js::make('/js/middle.js')
]);
```

The `append()` method will always add assets before the main list from `CrudResource`, `Page`, `Layout`, `Component`, `Field`, while `prepend()` will add them after.
The `add()` method will depend on the lifecycle of the application. Suppose you are adding assets to `ModelResource`,
but before the page is displayed, `Layout` will be called, which will also add assets, thus the assets from `Layout` will be added last.

> [!TIP]
> You can also use the helper `moonshine()->getAssetManager()`

<a name="asset-modification"></a>
## Asset Modification

You can modify the asset collection using closures:

```php
$assetManager->modifyAssets(function($assets) {
    // Modify the asset collection
    return array_filter($assets, function($asset) {
        return !str_contains($asset->getLink(), 'remove-this');
    });
});
```

<a name="versioning"></a>
## Versioning

***AssetManager*** supports versioning of assets to manage caching,
by default it will use the version of **MoonShine**, but you can override it for a specific asset:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\AssetManager\Js;

// Adding a version to an individual asset
Js::make('/js/app.js')->version('1.0.0');

// Result: /js/app.js?v=1.0.0
```

Versioning automatically adds a `v` parameter to the asset URL. If the URL already contains query parameters, the version will be added with `&`.

<a name="how-to-add"></a>
## How to Add Assets

<a name="global"></a>
### Global

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// MoonShineServiceProvider
// [tl! collapse:4]
use MoonShine\AssetManager\Js;
use MoonShine\Contracts\AssetManager\AssetManagerContract;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;

public function boot(
    CoreContract $core,
    ConfiguratorContract $config,
    AssetManagerContract $assets,
): void
{
    $assets->add(Js::make('/js/app.js'));
}
```

<a name="layout"></a>
### Layout

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Js;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            Js::make(Vite::asset('resources/js/app.js'))
        ];
    }
}
```

<a name="resource"></a>
### CrudResource

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\InlineJs;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    $this->getAssetManager()
        ->prepend(InlineJs::make('alert(1)'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="page"></a>
### Page

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    parent::onLoad();

    $this->getAssetManager()
        ->add(Css::make('/css/app.css'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="component"></a>
### Component

#### On the Fly

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Layout\Box;

Box::make()->addAssets([
    Js::make('/js/custom.js'),
    Css::make('/css/styles.css')
]);
```

#### When Creating a Component

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\MoonShineComponent;

final class MyComponent extends MoonShineComponent
{
    /**
     * @return list<AssetElementContract>
     */
    protected function assets(): array
    {
        return [
            Js::make('/js/custom.js'),
            Css::make('/css/styles.css')
        ];
    }
}
```

#### When Creating a Component via AssetManager

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\MoonShineComponent;

final class MyComponent extends MoonShineComponent
{
    protected function booted(): void
    {
        parent::booted();

        $this->getAssetManager()
          ->add(Css::make('/css/app.css'))
          ->append(Js::make('/js/app.js'));
    }
}
```

<a name="field"></a>
### Field

The same as with `Component`, since `Field` is a component.

<a name="blade"></a>
## Conclusion via Blade

```blade
<x-moonshine::layout.assets>
    @vite([
        'resources/css/main.css',
        'resources/js/app.js',
    ], 'vendor/moonshine')
</x-moonshine::layout.assets>
```

<a name="custom-build"></a>
## Custom Build

When working with **MoonShine**, especially when using the *Blade* approach,
you may need additional *TailwindCSS* CSS classes that are not included in the original **MoonShine** build.
For this purpose, a custom build is suitable, which will include **MoonShine**, and you will be able to build with your own set of classes and styles + **MoonShine**.

### Automatic Publishing

To automatically publish the custom build, run the command:

```shell
php artisan moonshine:publish
```

Select `Assets Template`.

After that, the following files will be published and replaced:

- `vite.config.js`,
- `postcss.config.js`,
- `resources/css/app.css`.

> [!WARNING]
> For automatic asset publishing, *TailwindCSS* 4+ and *Laravel* 12+ are required.

You will only need to add the assets to your project.

### Implementation via MoonShineLayout

You need to add **MoonShine** JavaScript `$this->getMainThemeJs()`, as well as your application assets,
where `Css::make(Vite::asset('resources/css/app.css'))` also contains **MoonShine** CSS.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            $this->getMainThemeJs(),
            Css::make(Vite::asset('resources/css/app.css')),
            Js::make(Vite::asset('resources/js/app.js')),
        ];
    }
}
```

### Implementation via Blade

You need to add **MoonShine** JavaScript `@vite(['resources/js/app.js'], 'vendor/moonshine')`,
as well as your application assets, where `resources/css/app.css` also contains **MoonShine** CSS.

```blade
<x-moonshine::layout.head>
    <x-moonshine::layout.assets>
        @vite(['resources/js/app.js'], 'vendor/moonshine')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-moonshine::layout.assets>
</x-moonshine::layout.head>
```

### Manual Implementation of Custom Build

#### vite.config.js

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@moonshine-resources': '/vendor/moonshine/moonshine/src/UI/resources',
        }
    },
});
```

The `tailwindcss()` plugin has been removed:

```js
plugins: [
    laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
    }),
    tailwindcss() // [tl! remove]
]
```

An alias has been added for the paths where **MoonShine** resources are located:

```js
resolve: {
    alias: {
        '@moonshine-resources': '/vendor/moonshine/moonshine/src/UI/resources',
    }
}
```

#### postcss.config.js

You need to install `@tailwindcss/postcss` and publish `postcss.config.js` with the following content:

```js
export default {
  plugins: {
    '@tailwindcss/postcss': {},
  },
};
```

#### resources/css/app.css

Add the **MoonShine** CSS import:

```css
@import '../../vendor/moonshine/moonshine/src/UI/resources/css/main.css';

@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';
```
