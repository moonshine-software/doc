# Badge

Если вам необходимо разместить значок на странице, то воспользуйтесь компонентом `Badge`.

```php
make(
    string $value = '',
    string|Color $color = Color::PURPLE
)
```

- `$value` - текст, отображаемый в значке,
- `$color` - код цвета (строка или Enum).

Доступны следующие значки:

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

@preview('badge')

<p class="colors">
<span class="color color-primary">primary</span>
<span class="color color-secondary">secondary</span>
<span class="color color-success">success</span>
<span class="color color-warning">warning</span>
<span class="color color-error">error</span>
<span class="color color-info">info</span>
<span class="color color-purple">purple</span>
<span class="color color-pink">pink</span>
<span class="color color-blue">blue</span>
<span class="color color-green">green</span>
<span class="color color-yellow">yellow</span>
<span class="color color-red">red</span>
<span class="color color-gray">gray</span>
</p>
