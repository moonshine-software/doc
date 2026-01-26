# Snippet

- [Basics](#basics)
- [Usage with fields](#usage-with-fields)

---

<a name="basics"></a>
## Basics

The `Snippet` component allows you to display text as code with the ability to copy to clipboard.

```php
make(
    string $value = '',
    string|Color $color = Color::INFO
)
```

- `$value` - text displayed in the snippet,
- `$color` - color (string or Enum).

The following options are available:

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Snippet;

Snippet::make('composer require moonshine/moonshine', Color::PRIMARY);
Snippet::make('composer require moonshine/moonshine', Color::SECONDARY);
Snippet::make('composer require moonshine/moonshine', Color::SUCCESS);
Snippet::make('composer require moonshine/moonshine', Color::INFO);
Snippet::make('composer require moonshine/moonshine', Color::WARNING);
Snippet::make('composer require moonshine/moonshine', Color::ERROR);
// or strings
Snippet::make('composer require moonshine/moonshine', 'purple');
Snippet::make('composer require moonshine/moonshine', 'pink');
Snippet::make('composer require moonshine/moonshine', 'blue');
Snippet::make('composer require moonshine/moonshine', 'green');
Snippet::make('composer require moonshine/moonshine', 'yellow');
Snippet::make('composer require moonshine/moonshine', 'red');
Snippet::make('composer require moonshine/moonshine', 'gray');
```
tab: Blade
```blade
<x-moonshine::snippet color="primary">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="secondary">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="success">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="info">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="warning">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="error">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="purple">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="pink">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="blue">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="green">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="yellow">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="red">composer require moonshine/moonshine</x-moonshine::snippet>
<x-moonshine::snippet color="gray">composer require moonshine/moonshine</x-moonshine::snippet>
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

<a name="usage-with-fields"></a>
## Usage with fields

When using the `copy()` method on input fields, the `Snippet` component is automatically applied for displaying the value in preview mode.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('Code', 'code')
    ->copy()
```

> [!TIP]
> More details about the `copy()` method can be found in the [Text](/docs/{{version}}/fields/text#copy) section.
