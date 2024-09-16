https://moonshine-laravel.com/docs/resource/ui-components/ui-popover?change-moonshine-locale=en

------
# Popover

- [Basics](#basics)
- [Without using a component](#without)

<a name="basics"></a>
## Basics

Using the `moonshine::popover` component you can create a pop-up window.

Available locations:

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
## Without using a component

```php
<span x-data="popover" data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 1</a>
</span>
or
<span
    x-data="popover({placement: 'top'})"
    title="Popover title"
    data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 2</a>
</span>
```
