---
video: https://youtu.be/bcFOkXuPSRk?si=QcBaoPHzMemK0Pt7&t=1955
---

# Кнопки

- [Основы](#basics)
- [Кнопки индексной страницы](#index-page-buttons)
- [Кнопки индексной таблицы](#index-table-buttons)
- [Кнопки страницы формы](#form-page-buttons)
- [Кнопки страницы детального просмотра](#detail-page-buttons)

---

<a name="basics"></a>
## Основы

Кнопки на страницах ресурса отвечают за основные действия с элементами
и являются компонентами [ActionButton](/docs/{{version}}/components/action-button).

В **MoonShine** есть множество методов, позволяющих переопределить у ресурса как отдельные
[кнопки](/docs/{{version}}/components/action-button), так и всю [группу](/docs/{{version}}/components/action-group).

> [!NOTE]
> Более подробная информация о компоненте [ActionButton](/docs/{{version}}/components/action-button).

> [!WARNING]
> Кнопки для создания, просмотра, редактирования, удаления и массового удаления размещены в отдельных классах,
> чтобы применить к ним все необходимые методы и тем самым устранить дублирование, поскольку эти кнопки также используются в `HasMany`, `BelongsToMany` и т.д.

<a name="index-page-buttons"></a>
## Кнопки индексной страницы

<a name="index-top-buttons"></a>
### topLeftButtons и topRightButtons

Методы `topLeftButtons()` и `topRightButtons()` в классе индексной страницы позволяют добавлять\переопределять
[кнопки](/docs/{{version}}/components/action-button) над таблицей.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Resources\Post\Pages;

use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\ActionButton; // [tl! collapse:end]

class PostIndexPage extends IndexPage
{
    // ...

    protected function topLeftButtons(): ListOf
    {
        return parent::topLeftButtons()
            ->add(
                ActionButton::make('Refresh', '#')
                    ->dispatchEvent(
                        AlpineJs::event(JsEvent::TABLE_UPDATED, $this->getListComponentName())
                    )
            );
    }
}
```

![resource_buttons_actions](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_actions.png#light)
![resource_buttons_actions_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_actions_dark.png#dark)

<a name="modify-create-button"></a>
### Модификация кнопки создания

Метод `modifyCreateButton()` позволяет модифицировать кнопку создания нового элемента.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyCreateButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->error();
}
```

Так же, вы можете переопределить кнопку.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\UI\Components\ActionButton;

protected function modifyCreateButton(ActionButtonContract $button): ActionButtonContract
{
    return ActionButton::make('Create');
}
```

![resource_button_create](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_create.png#light)
![resource_button_create_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_create_dark.png#dark)

<a name="modify-filters-button"></a>
### Модификация кнопки фильтров

Метод `modifyFiltersButton()` позволяет модифицировать или переопределить кнопку фильтров.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyFiltersButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->error();
}
```

![resource_button_filters](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_filters.png#light)
![resource_button_filters_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_filters_dark.png#dark)

<a name="index-table-buttons"></a>
## Кнопки индексной таблицы

Для добавления\переопределения кнопок в индексной таблице, используйте метод `buttons()` в классе индексной страницы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use Illuminate\Database\Eloquent\Model;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function buttons(): ListOf
{
    return parent::buttons()
        ->prepend(
            ActionButton::make(
                'Link',
                fn(Model $item) => '/endpoint?id=' . $item->getKey()
            )
        );
}
```

![resource_buttons_index](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_index.png#light)
![resource_buttons_index_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_index_dark.png#dark)

Для массовых действий с элементами необходимо добавить метод `bulk()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function buttons(): ListOf
{
    return parent::buttons()
        ->prepend(
            ActionButton::make('Link', '/endpoint')
                ->bulk()
        );
}
```

![resource_buttons_bulk](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_bulk.png#light)
![resource_buttons_bulk_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_bulk_dark.png#dark)

<a name="modify-detail-button"></a>
### Модификация кнопки детального просмотра

Метод `modifyDetailButton()` позволяет модифицировать или переопределить кнопку детального просмотра элемента.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyDetailButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->warning();
}
```

![resource_button_detail](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_detail.png#light)
![resource_button_detail_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_detail_dark.png#dark)

<a name="modify-edit-button"></a>
### Модификация кнопки редактирования

Метод `modifyEditButton()` позволяет модифицировать или переопределить кнопку редактирования элемента.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyEditButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->icon('pencil-square');
}
```

![resource_button_edit](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_edit.png#light)
![resource_button_edit_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_edit_dark.png#dark)

<a name="modify-delete-button"></a>
### Модификация кнопки удаления

Метод `modifyDeleteButton()` позволяет модифицировать или переопределить кнопку удаления элемента.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyDeleteButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->icon('x-mark');
}
```

![resource_button_delete](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_delete.png#light)
![resource_button_delete_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_delete_dark.png#dark)

<a name="modify-mass-delete-button"></a>
### Модификация кнопки массового удаления

Метод `modifyMassDeleteButton()` позволяет модифицировать или переопределить кнопку массового удаления.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyMassDeleteButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->icon('x-mark');
}
```

![resource_button_mass_delete](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_mass_delete.png#light)
![resource_button_mass_delete](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_button_mass_delete_dark.png#dark)

<a name="form-page-buttons"></a>
## Кнопки страницы формы

Чтобы добавить кнопки на страницу с формой, используйте метод `buttons()` в классе страницы формы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function buttons(): ListOf
{
    return parent::buttons()
        ->add(
            ActionButton::make('Link')->method('updateSomething')
        );
}
```

![resource_buttons_form](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_form.png#light)
![resource_buttons_form_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_form_dark.png#dark)

Метод `formButtons()` позволяет добавить\переопределить [кнопки](/docs/{{version}}/components/action-button) непосредственно в форму создания или редактирования.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function formButtons(): ListOf
{
    return parent::formButtons()
        ->add(
            ActionButton::make('Back', fn() => $this->getIndexPageUrl())->class('btn-lg')
        );
}
```

![resource_buttons_form_builder](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_form_builder.png#light)
![resource_buttons_form_builder](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_form_builder_dark.png#dark)

<a name="detail-page-buttons"></a>
## Кнопки страницы детального просмотра

Чтобы добавить\переопределить кнопки на странице детального просмотра, используйте метод `buttons()` в классе детальной страницы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function buttons(): ListOf
{
    return parent::buttons()
        ->add(ActionButton::make('Link', '/endpoint'));
}
```

![resource_buttons_detail](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_detail.png#light)
![resource_buttons_detail_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_detail_dark.png#dark)
