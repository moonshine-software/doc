https://moonshine-laravel.com/docs/resource/ui-components/ui-thumbnail?change-moonshine-locale=en

------

# Thumbnail 

-[Basics](#basics)
-[Group of images](#multiple)

<a name="basics"></a>
## Basics
 
To create thumbnails, you can use the `moonshine::thumbnails` component.

```php
<x-moonshine::thumbnails value="/images/thumb_1.jpg"/>
```

![thumb](https://moonshine-laravel.com/images/thumb_1.jpg)

You can also specify the `alt` attribute.

```php
<x-moonshine::thumbnails value="/images/thumb_1.jpg" alt="Description"/>
```

<a name="multiple"></a>
## Group of images

You can pass an array of images to the component.

```php
<x-moonshine::thumbnails :values="[
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg'
]"/>
```
![thumb](https://moonshine-laravel.com/images/thumb_1.jpg)
![thumb](https://moonshine-laravel.com/images/thumb_2.jpg)
![thumb](https://moonshine-laravel.com/images/thumb_3.jpg)

