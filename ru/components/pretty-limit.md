# PrettyLimit

- [Основы](#basics)
- [Метка](#label)
- [Ограничение ширины](#limit)
- [Интеграция с полями](#field-integration)

---

<a name="basics"></a>
## Основы

Компонент `PrettyLimit` позволяет отображать текст с ограниченной шириной, при этом полный текст показывается при наведении курсора.

```php
make(
    string $value = '',
    string|null|Color $color = Color::SECONDARY,
    ?string $label = null,
    ?int $limit = 150
)
```

- `$value` - отображаемый текст,
- `$color` - цвет фона (строка или Enum),
- `$label` - дополнительная метка,
- `$limit` - ширина в пикселях (минимум 100).

Доступны следующие цвета:

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
// или строки
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
## Метка

Параметр `label` позволяет добавить дополнительную метку перед текстом.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\PrettyLimit;

PrettyLimit::make('Название тарифа с длинным описанием', Color::PRIMARY, '2 недели');
// или через метод
PrettyLimit::make('Название тарифа с длинным описанием')
    ->color(Color::SUCCESS)
    ->label('Активен');
```
tab: Blade
```blade
<x-moonshine::pretty-limit color="primary" label="2 недели">
    Название тарифа с длинным описанием
</x-moonshine::pretty-limit>
```
~~~

<a name="limit"></a>
## Ограничение ширины

Параметр `limit` позволяет задать максимальную ширину компонента в пикселях. По умолчанию используется значение 150px.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\PrettyLimit;

PrettyLimit::make('Очень длинный текст', Color::INFO, limit: 200);
// или через метод
PrettyLimit::make('Очень длинный текст')
    ->limit(250);
```
tab: Blade
```blade
<x-moonshine::pretty-limit color="info" :limit="200">
    Очень длинный текст
</x-moonshine::pretty-limit>
```
~~~

> [!WARNING]
> Минимальное значение ширины — 100 пикселей.

<a name="field-integration"></a>
## Интеграция с полями

Для использования `PrettyLimit` в полях доступен метод `prettyLimit()` в поле `Text`.

```php
prettyLimit(
    null|Color|string|Closure $color = null,
    null|string|Closure $label = null,
    null|int|Closure $limit = null
)
```

Этот метод изменяет отображение поля в режиме preview, оборачивая значение в компонент `PrettyLimit`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Fields\Text;

Text::make('Название', 'title')
    ->prettyLimit(Color::PRIMARY);

// с динамическими значениями
Text::make('Статус', 'status')
    ->prettyLimit(
        color: fn($value, $field) => $value === 'active' ? Color::SUCCESS : Color::ERROR,
        label: fn($value, $field) => $value === 'active' ? 'Активен' : 'Неактивен',
        limit: 200
    );
```

> [!TIP]
> Параметры `color`, `label` и `limit` поддерживают Closure для динамического вычисления значений на основе данных поля.
