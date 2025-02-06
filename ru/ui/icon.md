# Icon

- [Основы](#basics)
- [Размер](#size)
- [Цвет](#color)
- [Настройка](#customization)

---

<a name="basics"></a>
## Основы

Для вставки иконок в свои пользовательские элементы можно использовать компонент `moonshine::icon`.

> [!NOTE]
> Все доступные [иконки](/docs/{{version}}/appearance/icons).

<a name="size"></a>
## Размер

Используя параметр `size`, вы можете установить размер иконки.
```blade
<x-moonshine::icon icon="heroicons.academic-cap" size="16"/>
```

> [!TIP]
> Значение параметра `size` соответствует размерам в TailwindCSS.

<a name="color"></a>
## Цвет

```blade
<x-moonshine::icon icon="heroicons.academic-cap" color="primary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="secondary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-900"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-50"/>
```

> [!TIP]
> По умолчанию доступно несколько цветов, но вы можете расширить их, используя свои собственные [цветовые классы](/docs/{{version}}/appearance/assets) TailwindCSS.

<a name="customization"></a>
## Настройка

Пользовательский стиль для иконок можно установить с помощью параметра `class`.

```blade
<x-moonshine::icon
    size="10"
    icon="heroicons.academic-cap"
    class="bg-green-500 text-white rounded-full p-2"
/>
```

> [!TIP]
> Сборка MoonShine содержит ограниченный список классов TailwindCSS. Используйте [пользовательские стили](/docs/{{version}}/appearance/assets).
