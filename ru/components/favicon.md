# Favicon

- [Основы](#basics)
- [Кастомные favicons](#assets)
- [Цвет закрепленной вкладки](#color)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `Favicon` предназначен для добавления к html-странице favicon.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Favicon;

Favicon::make();
```
tab: Blade
```blade
<x-moonshine::layout.favicon />
```
~~~

> [!NOTE]
> Родительский компонент: [head](/docs/{{version}}/components/head).

<a name="assets"></a>
## Кастомные favicons

Для изменения favicons, необходимо воспользоваться методом `customAssets()` или указать соответствующий параметр в **Blade** компоненте.

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

Массив ассетов вида:
- `apple-touch` - URL адрес для Apple Touch Icon,
- `32` - URL адрес для 32x32px favicon,
- `16` - URL адрес для 16x16px favicon,
- `safari-pinned-tab` - URL адрес для Safari закрепленной вкладки,
- `web-manifest` - URL адрес для Web Manifest.

<a name="color"></a>
## Цвет закрепленной вкладки

Для браузера Safari можно установить цвет закрепленной вкладки с помощью метода `bodyColor()` или указать соответствующий параметр в blade компоненте.

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
