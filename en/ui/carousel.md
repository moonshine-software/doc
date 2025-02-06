# Carousel

- [Basics](#basics)
- [Portrait orientation](#portrait)

---

<a name="basics"></a>
## Basics

To create image carousel, use the `moonshine::carousel` component.

```blade
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

```blade
<x-moonshine::carousel
    :items="['/images/image_portrait_1.jpg', '/images/image_portrait_2.jpg']"
    :alt="fake()->sentence(3)"
    :portrait="true
>
</x-moonshine::carousel>
```
