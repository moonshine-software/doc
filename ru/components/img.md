# Img

- [Основы](#basics)
- [Дополнительные атрибуты](#additional-attributes)
- [Примеры](#examples)

---

<a name="basics"></a>
## Основы

Компонент `Img` просто отображает тег `<img>` с возможностью добавления атрибутов.

```php
make(?string $src)
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Img;

Img::make('path_to_file);
```
tab: Blade
```blade
<x-moonshine::img src="path_to_file" />
```
~~~

@preview('img')

<a name="additional-attributes"></a>
## Дополнительные атрибуты

- `alt(?string $alt)` - задаёт описание для изображения (атрибут `alt`),
- `size(int $width, ?int $height)` - задаёт ширину и высоту изображение (атрибуты `width` и `height`),
- `width(int $width)` - задаёт ширину изображения отдельно (атрибут `width`),
- `height(?string $height)` - задаёт высоту изображения отдельно (атрибут `height`),
- `rounded()` - задаёт скругление изображения (применяется `style="border-radius: 50%;"`),
- `eagerLoading()` - загружает изображение немедленно, независимо от того, находится ли оно в данный момент в видимой области просмотра
  (атрибут `loading="eager"`),
- `lazyLoading()` - отложенная загрузка изображения (атрибут `loading="lazy"`),
- `autoDecoding()` - предпочтительный режим декодирования выберет браузер (атрибут `loading="auto"`),
- `syncDecoding()` - декодировать изображение синхронно вместе с остальными элементами DOM (атрибут `loading="sync"`),
- `asyncDecoding()` - декодировать изображение после отображения остальных элементов DOM (атрибут `loading="async"`),
- `srcset(array $sources)` - задаёт дополнительные источники изображений для разных разрешений экрана (атрибут `srcset`).

<a name="examples"></a>
### Примеры

Примеры использования метода `srcset()`:

```php
Img::make('logo.png')
    ->srcset([
        '200w' => 'logo-200w.png',
        '400w' => 'logo-400w.png',
    ]);

// <img src="logo.png" srcset="logo-200w.png 200w, logo-400w.png 400w">
```

```php
Img::make('banner.jpg')
    ->srcset([
        '2x' => 'banner-2x.jpg',
        '4x' => 'banner-4x.jpg',
    ]);

// <img src="banner.jpg" srcset="banner-2x.jpg 2x, banner-4x.jpg 4x">
```
