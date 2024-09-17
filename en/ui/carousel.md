https://moonshine-laravel.com/docs/resource/ui-components/ui-carousel?change-moonshine-locale=en

------
# Carousel

- [Basics](#basics)
- [Portrait orientation](#portrait)

<a name="basics"></a>
## Basics

To create image carousel, use the `moonshine::carousel` component.

```php
<x-moonshine::carousel
    :items="['/images/image_portrait_1.jpg', '/images/image_portrait_2.jpg']"
    :alt="fake()->sentence(3)"
    :portrait="true"
>
</x-moonshine::carousel>
```

<a name="portrait"></a>
## Portrait orientation

To use a carousel with vertical images, pass the parameter `:portrait="true"`.

```php
<x-moonshine::carousel
    :items="[&quot;/images/image_portrait_1.jpg&quot;, &quot;/images/image_portrait_2.jpg&quot;]"
    :alt=&quot;fake()-&gt;sentence(3)&quot;
    :portrait=&quot;true&quot;
>
</x-moonshine::carousel>
```
