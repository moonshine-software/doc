https://moonshine-laravel.com/docs/resource/fields/fields-image?change-moonshine-locale=en

------
# Image

Extends [File](https://moonshine-laravel.com/docs/resource/fields/fields-file)
* has the same features  

The *Image* field is an extension of *File*, which allows you to display previews of loaded images.

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


