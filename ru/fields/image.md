# Image

Расширяет [File](https://moonshine-laravel.com/docs/resource/fields/fields-file)
* имеет те же функции

Поле *Image* является расширением *File*, которое позволяет отображать превью загруженных изображений.

```php
use MoonShine\Fields\Image;

//...

public function fields(): array
{
    return [
        Image::make('Thumbnail')
    ];
}

//...
```

![image](https://moonshine-laravel.com/screenshots/image.png)
![image dark](https://moonshine-laravel.com/screenshots/image_dark.png)
