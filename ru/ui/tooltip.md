# Всплывающая подсказка

- [Основы](#basics)
- [Без использования компонента](#without)

---

<a name="basics"></a>
## Основы

Используя компонент `moonshine::tooltip`, вы можете создавать удобные всплывающие подсказки.

Доступные расположения:
- bottom
- top
- left
- right

```php
<x-moonshine::tooltip placement="bottom" content="Tooltip text">
    <button class="btn">Trigger</button>
</x-moonshine::tooltip>
```

<a name="without"></a>
## Без использования компонента

```php
<span x-data="tooltip('Tooltip content 1', {placement: 'top'})">
    <a class="text-purple font-semibold">Trigger 1</a>
</span>
```

или

```php
<span
    x-data="tooltip"
    data-tippy-content="Tooltip content 2"
    data-tippy-placement="right">
    <a class="text-purple font-semibold">Trigger 2</a>
</span>
```