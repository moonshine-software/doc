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

![image](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/image.png)
![image dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/image_dark.png)


