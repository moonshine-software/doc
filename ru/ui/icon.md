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
> Все доступные [иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="size"></a>
## Размер

Используя параметр `size`, вы можете установить размер иконки.
```php
<x-moonshine::icon icon="heroicons.academic-cap" size="16"/>
```

> [!TIP]
> Значение параметра `size` соответствует размерам в TailwindCSS.

<a name="color"></a>
## Цвет

```php
<x-moonshine::icon icon="heroicons.academic-cap" color="primary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="secondary"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-900"/>
<x-moonshine::icon icon="heroicons.academic-cap" color="dark-50"/>
```

> [!TIP]
> По умолчанию доступно несколько цветов, но вы можете расширить их, используя свои собственные [цветовые классы](https://moonshine-laravel.com/docs/resource/appearance/appearance-assets) TailwindCSS.

<a name="customization"></a>
## Настройка

Пользовательский стиль для иконок можно установить с помощью параметра `class`.

```php
<x-moonshine::icon
    size="10"
    icon="heroicons.academic-cap"
    class="bg-green-500 text-white rounded-full p-2"
/>
```

> [!TIP]
> Сборка MoonShine содержит ограниченный список классов TailwindCSS. Используйте [пользовательские стили](https://moonshine-laravel.com/docs/resource/appearance/appearance-assets).
