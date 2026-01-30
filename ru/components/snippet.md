# Snippet

- [Основы](#basics)
- [Использование с полями](#usage-with-fields)

---

<a name="basics"></a>
## Основы

Компонент `Snippet` позволяет отображать текст в виде кода с возможностью копирования в буфер обмена.

```php
make(
    string $value = '',
    string|Color $color = Color::INFO
)
```

- `$value` - текст, отображаемый в сниппете,
- `$color` - цвет (строка или Enum).

Доступны следующие варианты:

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
// или строки
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
## Использование с полями

При использовании метода `copy()` на полях ввода, компонент `Snippet` автоматически применяется для отображения значения в режиме preview.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make('Код', 'code')
    ->copy()
```

> [!TIP]
> Подробнее о методе `copy()` можно узнать в разделе [Text](/docs/{{version}}/fields/text#copy).
