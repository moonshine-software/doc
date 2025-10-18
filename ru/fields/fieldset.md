# Fieldset

- [Основы](#basics)
- [Изменение отображения](#edit-view)
- [Отображение по условию](#view-condition)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Fieldset` позволяет группировать поля при отображении в предварительном просмотре, а в форме оборачивает в HTML тег `fieldset`.

```php
make(
    string|Closure|null $label = null,
    iterable|Closure|FieldsContract $fields = []
)
```

- `$label` - заголовок,
- `$fields` - поля для группировки.

Так же, поля для группировки можно указать с помощью метода `fields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Fieldset;
use MoonShine\UI\Fields\Slug;
use MoonShine\UI\Fields\Text;

Fieldset::make('Title', [
    Text::make('Title'),
    Slug::make('Slug'),
]),

Fieldset::make()
    ->fields([
        Text::make('Title'),
        Slug::make('Slug'),
    ]),
```

<a name="edit-view"></a>
## Изменение отображения

Вы можете кастомизировать отображение для `Fieldset` с помощью компонентов.

```php
Fieldset::make('Title', [
    Text::make('Title'),
    LineBreak::make(),
    Slug::make('Slug'),
])
```

<a name="view-condition"></a>
## Отображение по условию

Чтобы при определенных условия изменялся набор компонентов у `Fieldset`, необходимо передать условие и наборы компонентов с помощью callback функции.

```php
Fieldset::make('Stack', fn(Fieldset $ctx) => $ctx->getData()?->getOriginal()->id === 3 ? [
        Date::make('Creation date', 'created_at'),
    ] : [
        Date::make('Creation date', 'created_at'),
        LineBreak::make(),
        Email::make('Email', 'email'),
    ]
)
```
