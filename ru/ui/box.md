# Box

- [Основы](#basics)
- [Заголовок](#heading)
- [Темный стиль](#dark)

---

<a name="basics"></a>
## Основы

Для выделения контента можно использовать компонент `moonshine::box`.

```bladehtml
<x-moonshine::box>
    {{ fake()->text() }}
</x-moonshine::box>
```

<a name="heading"></a>
## Заголовок

Параметр `title` задает заголовок блока.

```bladehtml
<x-moonshine::box title="Title box">
    {{ fake()->text() }}
</x-moonshine::box>
```

<a name="dark"></a>
## Темный стиль

Вы можете установить темный стиль для блока, указав параметр `dark` со значением `TRUE`.

```bladehtml
<x-moonshine::box :dark="true">
    {{ fake()->text() }}
</x-moonshine::box>
```
