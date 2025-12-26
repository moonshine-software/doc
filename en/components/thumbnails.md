# Thumbnails

To create thumbnails, you can use the `Thumbnails` component.

```php
make(FileItem|string|array|null $items)
```

- `$items` - thumbnail or a list of thumbnails.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Thumbnails;

Thumbnails::make([
    '/images/image_1.jpg',
    '/images/image_2.jpg',
    '/images/image_3.jpg',
]),
```
tab: Blade
```blade
<x-moonshine::thumbnails
    :items="[
        '/images/image_1.jpg',
        '/images/image_2.jpg',
        '/images/image_3.jpg',
    ]"
/>
```
~~~

@preview('thumbnails')

You can specify one thumbnail.

```blade
<x-moonshine::thumbnails
    :items="/images/thumb_1.jpg"
/>
```

You can also specify the `alt` attribute.

```blade
<x-moonshine::thumbnails
    :items="/images/thumb_1.jpg"
    alt="Description"
/>
```
