# HiddenIds

- [Основы](#basics)
- [Пример использования](#use)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `HiddenIds` используется для передачи первичного ключа выбранных элементов.
Например, в таблице при массовых действиях необходимо собрать значения ID всех выбранных элементов и отправить в форму.

<a name="make"></a>
## Создание

```php
make(string $forComponent)
```

- `$forComponent` - название компонента со списком элементов.

```php
use MoonShine\UI\Fields\HiddenIds;

HiddenIds::make('index-table')
```

> [!WARNING]
> Таблица должна содержать поле ID.

<a name="use"></a>
## Пример использования

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Components\FlexibleRender;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\HiddenIds;
use MoonShine\UI\Components\FormBuilder;

ActionButton::make('Active', route('moonshine.posts.mass-active', $this->uriKey()))
    ->inModal(
        'Active',
        fn (): string => (string) FormBuilder::make(
            route('moonshine.posts.mass-active', $this->uriKey()),
            fields: [
                HiddenIds::make($this->listComponentName()), // название компонента, из которого необходимо получить ID
                FlexibleRender::make(__('moonshine::ui.confirm_message')),
            ]
        )
        ->async()
        ->submit('Active', ['class' => 'btn-secondary'])
    )
    ->bulk()
```
