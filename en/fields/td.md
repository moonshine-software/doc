https://moonshine-laravel.com/docs/resource/fields/fields-td?change-moonshine-locale=en

------

# Td

- [Make](#make)
- [Fields](#fields)
- [Labels](#labels)
- [Attributes](#attributes)

<a name="make"></a>
## Make

The *Td* field is intended to modify the display of a table cell in the `preview` mode.

```php
make(Closure|string $label, ?Closure $fields = null)
```

- `$label` - column name
- `$fields` - a closure that returns an array of fields

```php
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ]),
    ];
}

//...
```

> [!WARNING]
> The *Td* field is not displayed in forms, it is intended only for `preview` mode!

A closure can take the current element as a parameter.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', function (Article $v) {
            if($v->active) {
                return [
                    Text::make('Title'),
                ];
            }

            return [
                Flex::make([
                   ActionButton::make('Click me', $this->detailPageUrl($v)),
                    Text::make('Title'),
                   Switcher::make('Active'),
                ])
            ];
        }),
    ];
}

//...
```

<a name="fields"></a>
## Fields

You can also specify which fields will be displayed in a cell using the `fields()` method.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ]),
    ];
}

//...
```

<a name="labels"></a>
## Labels

The `withLabels()` method allows you to display a *Label* for fields in a cell.

```php
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column', fn () => [
            Text::make('Title'),
        ])
            ->withLabels(),
    ];
}

//...
```
<a name="attributes"></a>
## Attributes

The *Td* field can be given additional attributes using the `tdAttributes()` method.

```php
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;
```

```php
use MoonShine\Fields\Td;
use MoonShine\Fields\Text;

//...

public function indexFields(): array
{
    return [
        Td::make('Column')
            ->fields([
                Text::make('Title')
            ])
            ->tdAttributes(fn (Article $data, ComponentAttributeBag $attr) => $data->getKey() === 2 ? $attr->merge([
                'style' => 'background: lightgray'
            ]) : $attr),
    ];
}

//...
```
