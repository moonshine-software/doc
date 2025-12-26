# Image

Inherits from [File](/docs/{{version}}/fields/file).

\* has the same capabilities

The `Image` field is an extension of `File` that allows previewing uploaded images.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Image;

Image::make('Thumbnail')
```
tab: Blade
```blade
<x-moonshine::form.file
    :imageable="true"
    name="thumbnail"
/>
```
~~~

@preview('fields.image')

If you need to customize a modal window with an image in "preview" mode, then you can use the `extraAttributes()` method.

```php
Image::make('avatar')
    ->extraAttributes(
        fn(string $filename, int $index): ?FileItemExtra => new FileItemExtra(wide: false, auto: true, styles: 'width: 250px;')
    )
```

- `wide` - XL size of the modal window,
- `auto` - The window size will adjust to the size of the content,
- `styles` - Additional styles for the image in the modal window.
