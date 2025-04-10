# Popover

- [Basics](#basics)
- [Without using the component](#without)

---

<a name="basics"></a>
## Basics

Using the component `Popover`, you can create a popover.

```php
make(
    string $title,
    string $trigger,
    string $placement = 'right',
)
```

- `title` - title in the popover,
- `trigger` - text or html that pops up when you hover over it,
- `placement` - location of the popover is relative to the `trigger`.

For an up-to-date list of available locations, see [tippy.js](https://atomiks.github.io/tippyjs/v6/all-props/#placement) documentation.

~~~tabs
tab: Class
```php
Popover::make('Title', 'Trigger')
    ->content('HTML content')
```
tab: Blade
```blade
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
~~~

<a name="without"></a>
## Without using the component

```html
<span x-data="popover" data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 1</a>
</span>
```

or

```html
<span
    x-data="popover({placement: 'top'})"
    title="Popover title"
    data-content="HTML HERE">
    <a class="text-purple font-semibold">Popover 2</a>
</span>
```
