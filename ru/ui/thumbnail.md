# Миниатюра 

-[Основы](#basics)
-[Группа изображений](#multiple)

---

<a name="basics"></a>
## Основы
 
Для создания миниатюр можно использовать компонент `moonshine::thumbnails`.

```bladehtml
<x-moonshine::thumbnails value="/images/thumb_1.jpg"/>
```

Вы также можете указать атрибут `alt`.

```bladehtml
<x-moonshine::thumbnails value="/images/thumb_1.jpg" alt="Description"/>
```

<a name="multiple"></a>
## Группа изображений

Вы можете передать компоненту массив изображений.

```bladehtml
<x-moonshine::thumbnails :values="[
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg'
]"/>
```
