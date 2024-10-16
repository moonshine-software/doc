# Td

- [Создание](#make)
- [Поля](#fields)
- [Метки](#labels)
- [Атрибуты](#attributes)

---

<a name="make"></a>
## Создание

Поле *Td* предназначено для изменения отображения ячейки таблицы в режиме `preview`.

```php
make(Closure|string $label, ?Closure $fields = null)
```

- `$label` - название столбца
- `$fields` - замыкание, возвращающее массив полей

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
> Поле *Td* не отображается в формах, оно предназначено только для режима `preview`!

Замыкание может принимать текущий элемент в качестве параметра.

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
## Поля

Вы также можете указать, какие поля будут отображаться в ячейке, используя метод `fields()`.

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
## Метки

Метод `withLabels()` позволяет отображать *Label* для полей в ячейке.

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
## Атрибуты

Полю *Td* можно задать дополнительные атрибуты с помощью метода `tdAttributes()`.

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
