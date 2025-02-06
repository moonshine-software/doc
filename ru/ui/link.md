# Ссылка

- [Основы](#basics)
- [Заливка](#fill)
- [Иконка](#icon)

---

<a name="basics"></a>
## Основы

Для создания стилизованной ссылки можно использовать компоненты `moonshine::link-button` или `moonshine::link-native`.

```bladehtml
<x-moonshine::link-button href="#">Link</x-moonshine::link-button>

<x-moonshine::link-native href="#">Link</x-moonshine::link-native>
```

<a name="fill"></a>
## Заливка

За заливку отвечает параметр `filled`.

```bladehtml
<x-moonshine::link-button
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-button>

<x-moonshine::link-native
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-native>
```

<a name="icon"></a>
## Иконка

Вы можете передать параметр `icon`.

```bladehtml
<x-moonshine::link-button
    href="#"
    icon="heroicons.arrow-top-right-on-square"
>
    Link
</x-moonshine::link-button>

<x-moonshine::link-native
    href="#"
    icon="heroicons.arrow-top-right-on-square"
>
    Link
</x-moonshine::link-native>
```

> [!NOTE]
> Все доступные [иконки](/docs/{{version}}/appearance/icons).
