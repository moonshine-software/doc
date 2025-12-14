# Title

Компонент `Title` используется для основного заголовка страницы.

```php
make(
    Closure|string|null $value,
    int $h = 1,
)
```

`$value` - значение,
`$h` - градация.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
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
