# Title

The `Title` component is used for the main page header.

```php
make(
    Closure|string|null $value,
    int $h = 1,
)
```

`$value` - value,
`$h` - gradation.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Title;

Title::make('Hello world')
```
tab: Blade
```blade
<x-moonshine::title>
    Hello world
</x-moonshine::title>
```
~~~
