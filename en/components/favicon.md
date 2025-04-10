# Favicon

- [Basics](#basics)
- [Custom favicons](#assets)
- [Pinned tab color](#color)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `Favicon` designed is used to add a favicon to an HTML page.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Favicon;

Favicon::make();
```
tab: Blade
```blade
<x-moonshine::layout.favicon />
```
~~~

> [!NOTE]
> Parent component: [head](/docs/{{version}}/components/head).

<a name="assets"></a>
## Custom favicons

To change favicons, you need to use the `customAssets()` method or specify the corresponding parameter in the **Blade** component.

~~~tabs
tab: Class
```php
assets(array $assets);
```

```php
Favicon::make([
    // ...
])
    ->customAssets([
        'apple-touch' => Vite::asset('favicons/apple-touch-icon.png'),
        '32' => Vite::asset('favicons/favicon-32x32.png'),
        '16' => Vite::asset('favicons/favicon-16x16.png'),
        'safari-pinned-tab' => Vite::asset('favicons/safari-pinned-tab.svg'),
        'web-manifest' => Vite::asset('favicons/site.webmanifest'),
    ]);
```
tab: Blade
```blade
<x-moonshine::layout.favicon :assets="[
    'apple-touch' => asset('favicons/apple-touch-icon.png'),
    '32' => asset('favicons/favicon-32x32.png'),
    '16' => asset('favicons/favicon-16x16.png'),
    'safari-pinned-tab' => asset('favicons/safari-pinned-tab.svg'),
    'web-manifest' => asset('favicons/site.webmanifest'),
]" />
```
~~~

The assets array is as follows:
- `apple-touch` - URL for the Apple Touch Icon,
- `32` - URL for the 32x32px favicon,
- `16` - URL for the 16x16px favicon,
- `safari-pinned-tab` - URL for the Safari pinned tab,
- `web-manifest` - URL for the Web Manifest.

<a name="color"></a>
## Pinned tab color

For the Safari browser, you can set the pinned tab color using the `bodyColor()` method or specify the corresponding parameter in the Blade component.

~~~tabs
tab: Class
```php
bodyColor(string $color);
```
```php
Favicon::make([
    // ...
])
    ->bodyColor('#7843e9');
```
tab: Blade
```blade
<x-moonshine::layout.favicon bodyColor='#7843e9' />
```
~~~
