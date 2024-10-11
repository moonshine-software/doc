# Dropdown

- [Основы](#basics)
- [Заголовок](#heading)
- [Подвал](#footer)
- [Расположение](#location)

---

<a name="basics"></a>
## Основы

Используя компонент `moonshine::dropdown`, вы можете создавать выпадающие блоки.

```php
<x-moonshine::dropdown>
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

<a name="heading"></a>
## Заголовок

```php
<x-moonshine::dropdown title="Dropdown title">
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

<a name="footer"></a>
## Подвал

```php
<x-moonshine::dropdown>
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
    <x-slot:footer>Dropdown footer</x-slot:footer>
</x-moonshine::dropdown>
```

<a name="location"></a>
## Расположение

Доступные расположения:

- bottom,
- top,
- left,
- right.

```php
<x-moonshine::dropdown placement="left">
    <div class="m-4">
        {{ fake()->text() }}
    </div>
    <x-slot:toggler>Click me</x-slot:toggler>
</x-moonshine::dropdown>
```

> [NOTE]
> Дополнительные варианты расположения можно найти в официальной документации [tippy.js](https://atomiks.github.io/tippyjs/v6/all-props/#placement).
