# Img

- [Basics](#basics)
- [Methods](#methods)
  - [srcset() method](#srcset)

---

<a name="basics"></a>
## Basics

The `Img` component simply displays a `<img>` tag with the ability to add attributes.

```php
make(?string $src)
```

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Img;

Img::make('path_to_file);
```
tab: Blade
```blade
<x-moonshine::img src="path_to_file" />
```
~~~

<a name="methods"></a>
## Methods

- `alt(?string $alt)` - sets the description for the image (attribute `alt`),
- `size(int $width, ?int $height)` - sets the width and height of the image (attributes `width` и `height`),
- `width(int $width)` - sets the width of the image separately (attribute `width`),
- `height(?string $height)` - sets the image height separately (attribute `height`),
- `rounded()` - sets the rounding of the image (applies `style="border-radius: 50%;"`),
- `eagerLoading()` - loads the image immediately, regardless of whether it is currently in the visible viewing area
  (attribute `loading="eager"`),
- `lazyLoading()` - delayed image loading (attribute loading="lazy"),
- `autoDecoding()` - The browser will choose the preferred decoding mode (attribute `loading="auto"`),
- `syncDecoding()` - decode the image synchronously with the rest of the DOM elements (attribute `loading="sync"`),
- `asyncDecoding()` - decode the image after displaying the rest of the DOM elements (attribute `loading="async"`),
- `srcset(array $sources)` - sets additional image sources for different screen resolutions (attribute `srcset`).

<a name="srcset"></a>
### srcset() method

Example of definition by width:

```php
Img::make('logo.png')
    ->srcset([
        '200w' => 'logo-200w.png',
        '400w' => 'logo-400w.png',
    ]);

// <img src="logo.png" srcset="logo-200w.png 200w, logo-400w.png 400w">
```

Example of determination by pixel density:

```php
Img::make('banner.jpg')
    ->srcset([
        '2x' => 'banner-2x.jpg',
        '4x' => 'banner-4x.jpg',
    ]);

// <img src="banner.jpg" srcset="banner-2x.jpg 2x, banner-4x.jpg 4x">
```
