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

![image](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/image.png)
![image dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/image_dark.png)
