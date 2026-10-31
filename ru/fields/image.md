# Image

Наследует [File](/docs/{{version}}/fields/file).

\* имеет те же возможности

Поле `Image` является расширением `File`, которое позволяет отображать превью загруженных изображений.

`Image` использует те же [настройки допустимых расширений](/docs/{{version}}/fields/file#allowed-extensions), что и `File`:
наследует глобальный список `allowed_extensions`, если у поля не вызван `allowedExtensions()`.
Поле не ограничивает загрузку форматами изображений автоматически. При необходимости задайте список расширений изображений глобально или у поля.

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

Если вам необходимо кастомизировать модальное окно с изображением в режиме "preview", то вы можете воспользоваться методом `extraAttributes()`.

```php
Image::make('avatar')
    ->extraAttributes(
        fn(string $filename, int $index): ?FileItemExtra => new FileItemExtra(wide: false, auto: true, styles: 'width: 250px;')
    )
```

- `wide` - XL размер модального окна,
- `auto` - Размер окна будет подстраиваться под размер контента,
- `styles` - Дополнительные стили для изображения в модальном окне.
