# Files

- [Основы](#basics)
- [Без скачивания](#no-download)

---

<a name="basics"></a>
## Основы

Для отображения списка файлов можно использовать компонент `moonshine::files`.

```bladehtml
<x-moonshine::files :files="[
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg'
]"/>
```

<a name="no-download"></a>
## Без скачивания

Чтобы отключить возможность скачивания файлов, нужно компоненту передать параметр `download` со значением `FALSE`.

```bladehtml
<x-moonshine::files
    :files="[
        '/images/thumb_1.jpg',
        '/images/thumb_2.jpg',
        '/images/thumb_3.jpg'
    ]"
    :download="false"
/>
```
