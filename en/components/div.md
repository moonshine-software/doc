# Div Component

The *Div* component simply renders a div tag with the ability to specify nested components and add attributes.

## Class

```php
make(iterable $components)
```

```php
use MoonShine\Components\Layout\Div;

//...

public function components(): array
{
    return [
        Div::make([])
    ];
}

//...
```

## Blade

```blade
<x-moonshine::layout.div></x-moonshine::layout.div>
```
