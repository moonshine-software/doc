# Carousel

- [Basics](#basics)
- [Portrait orientation](#portrait)

---

<a name="basics"></a>
## Основы

Для создания карусели изображений используйте компонент `moonshine::carousel`.

```php
<x-moonshine::carousel
    :items="['/images/image_portrait_1.jpg', '/images/image_portrait_2.jpg']"
    :alt="fake()->sentence(3)"
    :portrait="true"
>
</x-moonshine::carousel>
```

<a name="portrait"></a>
## Портретная ориентация

Чтобы использовать карусель с вертикальными изображениями, передайте параметр `:portrait="true"`.

```php
<x-moonshine::carousel
    :items="[&quot;/images/image_portrait_1.jpg&quot;, &quot;/images/image_portrait_2.jpg&quot;]"
    :alt=&quot;fake()-&gt;sentence(3)&quot;
    :portrait=&quot;true&quot;
>
</x-moonshine::carousel>
```
