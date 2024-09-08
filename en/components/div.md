https://moonshine-laravel.com/docs/resource/components/components-div?change-moonshine-locale=en

------
# Div Component

The *Div* component simply renders a div tag with the ability to specify nested components and add attributes.

<a name="class"></a>
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
