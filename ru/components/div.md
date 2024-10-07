# Компонент Div

Компонент *Div* просто отображает тег div с возможностью указания вложенных компонентов и добавления атрибутов.

<a name="class"></a>
## Класс

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
