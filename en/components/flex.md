# Flex

- [Basics](#basics)
- [Alignment](#alignment)
- [Wrap](#wrap)

---

<a name="basics"></a>
## Basics

To position elements on the page, you can use the `Flex` component.
Components inside `Flex` will be displayed in `display: flex` mode.

```php
make(
    iterable $components = [],
    int $colSpan = 12,
    int $adaptiveColSpan = 12,
    string $itemsAlign = 'center',
    string $justifyAlign = 'center',
    bool $withoutSpace = false
)
```

- `$components` - a list of components,
- `$colSpan` - the number of columns the block occupies for screen sizes of 1280px and above,
- `$adaptiveColSpan` - the number of columns the block occupies for screen sizes up to 1280px,
- `$itemsAlign` - an equivalent of the CSS class `items-$itemsAlign` in **Tailwind**,
- `$justifyAlign` - an equivalent of the CSS class `justify-$justifyAlign` in **Tailwind**,
- `$withoutSpace` - a flag for margins.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Flex;

Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
]),
```
tab: Blade
```blade
<x-moonshine::layout.flex :justifyAlign="'end'">
    <div>Text 1</div>
    <div>Text 2</div>
</x-moonshine::layout.flex>
```
~~~

<a name="alignment"></a>
## Alignment

To align elements, you can use the `itemsAlign()` and `justifyAlign()` methods.

```php
Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
])
    ->justifyAlign('between')
    ->itemsAlign('start')
```

<a name="wrap"></a>
## Wrap

To transfer the elements (`flex-wrap`) you can use the `wrap()` method.

```php
Flex::make([
    Text::make('Test'),
    Text::make('Test 2'),
])
    ->wrap()
```
