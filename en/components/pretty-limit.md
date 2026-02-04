# PrettyLimit

- [Basics](#basics)
- [Label](#label)
- [Width limit](#limit)
- [Field integration](#field-integration)

---

<a name="basics"></a>
## Basics

The `PrettyLimit` component allows displaying text with a limited width, showing the full text on hover.

```php
make(
    string $value = '',
    string|null|Color $color = Color::SECONDARY,
    ?string $label = null,
    ?int $limit = 150
)
```

- `$value` - displayed text,
- `$color` - background color (string or Enum),
- `$label` - additional label,
- `$limit` - width in pixels (minimum 100).

The following colors are available:

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\PrettyLimit;

PrettyLimit::make('Long text that will be truncated', Color::PRIMARY);
PrettyLimit::make('Long text that will be truncated', Color::SECONDARY);
PrettyLimit::make('Long text that will be truncated', Color::SUCCESS);
PrettyLimit::make('Long text that will be truncated', Color::INFO);
PrettyLimit::make('Long text that will be truncated', Color::WARNING);
PrettyLimit::make('Long text that will be truncated', Color::ERROR);
// or strings
PrettyLimit::make('Long text that will be truncated', 'purple');
PrettyLimit::make('Long text that will be truncated', 'pink');
PrettyLimit::make('Long text that will be truncated', 'blue');
PrettyLimit::make('Long text that will be truncated', 'green');
PrettyLimit::make('Long text that will be truncated', 'yellow');
PrettyLimit::make('Long text that will be truncated', 'red');
PrettyLimit::make('Long text that will be truncated', 'gray');
```
tab: Blade
```blade
<x-moonshine::pretty-limit color="primary">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="secondary">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="success">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="info">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="warning">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="error">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="purple">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="pink">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="blue">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="green">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="yellow">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="red">Long text that will be truncated</x-moonshine::pretty-limit>
<x-moonshine::pretty-limit color="gray">Long text that will be truncated</x-moonshine::pretty-limit>
```
~~~

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

<a name="label"></a>
## Label

The `label` parameter allows adding an additional label before the text.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\PrettyLimit;

PrettyLimit::make('Tariff name with long description', Color::PRIMARY, '2 weeks');
// or via method
PrettyLimit::make('Tariff name with long description')
    ->color(Color::SUCCESS)
    ->label('Active');
```
tab: Blade
```blade
<x-moonshine::pretty-limit color="primary" label="2 weeks">
    Tariff name with long description
</x-moonshine::pretty-limit>
```
~~~

<a name="limit"></a>
## Width limit

The `limit` parameter allows setting the maximum width of the component in pixels. The default value is 150px.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\PrettyLimit;

PrettyLimit::make('Very long text', Color::INFO, limit: 200);
// or via method
PrettyLimit::make('Very long text')
    ->limit(250);
```
tab: Blade
```blade
<x-moonshine::pretty-limit color="info" :limit="200">
    Very long text
</x-moonshine::pretty-limit>
```
~~~

> [!WARNING]
> The minimum width value is 100 pixels.

<a name="field-integration"></a>
## Field integration

To use `PrettyLimit` in fields, the `prettyLimit()` method is available in the `Text` field.

```php
prettyLimit(
    null|Color|string|Closure $color = null,
    null|string|Closure $label = null,
    null|int|Closure $limit = null
)
```

This method modifies the field display in preview mode, wrapping the value in a `PrettyLimit` component.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Fields\Text;

Text::make('Title', 'title')
    ->prettyLimit(Color::PRIMARY);

// with dynamic values
Text::make('Status', 'status')
    ->prettyLimit(
        color: fn($value, $field) => $value === 'active' ? Color::SUCCESS : Color::ERROR,
        label: fn($value, $field) => $value === 'active' ? 'Active' : 'Inactive',
        limit: 200
    );
```

> [!TIP]
> The `color`, `label`, and `limit` parameters support Closure for dynamic value calculation based on field data.
