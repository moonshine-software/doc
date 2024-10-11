# Миниатюра 

-[Основы](#basics)
-[Группа изображений](#multiple)

---

<a name="basics"></a>
## Основы
 
Для создания миниатюр можно использовать компонент `moonshine::thumbnails`.

```php
<x-moonshine::thumbnails value="/images/thumb_1.jpg"/>
```

![thumb](https://moonshine-laravel.com/images/thumb_1.jpg)

Вы также можете указать атрибут `alt`.

```php
<x-moonshine::thumbnails value="/images/thumb_1.jpg" alt="Description"/>
```

<a name="multiple"></a>
## Группа изображений

Вы можете передать компоненту массив изображений.

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
