# Badge

If you need to place a badge on the page, use `Badge` component.

```php
make(
    string $value = '',
    string|Color $color = Color::PURPLE
)
```

- `$value` - text displayed in the badge,
- `$color` - color code (string or Enum).

The following badges are available:

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Badge;

Badge::make('Primary', Color::PRIMARY);
Badge::make('Secondary', Color::SECONDARY);
Badge::make('Success', Color::SUCCESS);
Badge::make('Info', Color::INFO);
Badge::make('Warning', Color::WARNING);
Badge::make('Error', Color::ERROR);
// or strings
Badge::make('Purple','purple');
Badge::make('Pink','pink');
Badge::make('Blue','blue');
Badge::make('Green','green');
Badge::make('Yellow','yellow');
Badge::make('Red', 'red');
Badge::make('Gray', 'gray');
```
tab: Blade
```blade
<x-moonshine::badge color="primary">Primary</x-moonshine::badge>
<x-moonshine::badge color="secondary">Secondary</x-moonshine::badge>
<x-moonshine::badge color="success">Success</x-moonshine::badge>
<x-moonshine::badge color="info">Info</x-moonshine::badge>
<x-moonshine::badge color="warning">Warning</x-moonshine::badge>
<x-moonshine::badge color="error">Error</x-moonshine::badge>
<x-moonshine::badge color="purple">Purple</x-moonshine::badge>
<x-moonshine::badge color="pink">Pink</x-moonshine::badge>
<x-moonshine::badge color="blue">Blue</x-moonshine::badge>
<x-moonshine::badge color="green">Green</x-moonshine::badge>
<x-moonshine::badge color="yellow">Yellow</x-moonshine::badge>
<x-moonshine::badge color="red">Red</x-moonshine::badge>
<x-moonshine::badge color="gray">Gray</x-moonshine::badge>
```
~~~
