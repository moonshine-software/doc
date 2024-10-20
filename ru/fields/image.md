# Image

Наследует [File](/docs/{{version}}/fields/file).

* имеет те же возможности

Поле *Image* является расширением *File*, которое позволяет отображать превью загруженных изображений.

~~~tabs
tab: Class
```php
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

![image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/image.png)

![image dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/image_dark.png)
