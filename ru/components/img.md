# Img

- [Основы](#basics)
- [Методы](#methods)

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
use MoonShine\UI\Components\Img;

Img::make('path_to_file);
```
tab: Blade
```blade
<x-moonshine::img src="path_to_file" />
```
~~~

<a name="methods"></a>
## Методы

- `alt(?string $alt)` - задаёт описание для изображения (атрибт `alt`)
- `size(int $width, ?int $height)` - задаёт ширину и высоту изображение (атрибуты `width` и `height`)
- `width(int $width)` - задаёт ширину изображения отдельно (атрибт `width`)
- `height(?string $height)` - задаёт высоту изображения отдельно (атрибт `height`)
- `rounded()` - задаёт скругление изображения (применяется `style="border-radius: 50%;"`)
- `eagerLoading()` - загружает изображение немедленно, независимо от того, находится ли оно в данный момент в видимой области просмотра (атрибут `loading="eager"`)
- `lazyLoading()` - отложенная загрузка изображения (атрибут loading="lazy")
- `autoDecoding()` - предпочтительный режим декодирования выберет браузер (атрибут `loading="auto"`)
- `syncDecoding()` - декодировать изображение синхронно вместе с остальными элементами DOM (атрибут `loading="sync"`)
- `asyncDecoding()` - декодировать изображение после отображения остальных элементов DOM (атрибут `loading="async"`)
- `srcset(array $sources)` - задаёт дополнительные источники изображений для разных разрешений экрана (атрибут `srcset`)

Пример использования метода `srcset(array $sources)`
```php
// определение по ширине
Img::make('logo.png')
    ->srcset([
        '200w' => 'logo-200w.png',
        '400w' => 'logo-400w.png',
    ]);

// результат: <img src="logo.png" srcset="logo-200w.png 200w, logo-400w.png 400w">
    
// по плотности пикселей
Img::make('banner.jpg')
    ->srcset([
        '2x' => 'banner-2x.jpg',
        '4x' => 'banner-4x.jpg',
    ]);

// результат: <img src="banner.jpg" srcset="banner-2x.jpg 2x, banner-4x.jpg 4x">
```