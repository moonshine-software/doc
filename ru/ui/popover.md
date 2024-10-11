# Всплывающее окно

- [Основы](#basics)
- [Без использования компонента](#without)

---

<a name="basics"></a>
## Основы

Используя компонент `moonshine::popover`, вы можете создать всплывающее окно.

Доступные расположения:

- `bottom`
- `top`
- `left`
- `right`

```php
<x-moonshine::popover title="Popover title" placement="right">
    <x-slot:trigger>
        <button class="btn">Popover</button>
    </x-slot:trigger>
    <p>This is a very beautiful popover, show some love.</p>
    <div class='flex justify-between mt-3'>
        <button type='button' class='btn btn-sm'>Skip</button>
        <button type='button' class='btn btn-sm btn-primary'>Read More</button>
    </div>
</x-moonshine::popover>
```

<a name="without"></a>
## Без использования компонента

```php
<span x-data="popover" data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 1</a>
</span>
или
<span
    x-data="popover({placement: 'top'})"
    title="Popover title"
    data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 2</a>
</span>
```
