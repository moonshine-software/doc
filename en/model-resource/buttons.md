---
video: https://youtu.be/5o8qSf94Bf0?si=9dLj_SiXA1-w6hFo&t=1955
---

# Buttons

- [Basics](#basics)
- [Index page buttons](#index-page-buttons)
- [Index table buttons](#index-table-buttons)
- [Form page buttons](#form-page-buttons)
- [Detail page buttons](#detail-page-buttons)

---

<a name="basics"></a>
## Basics

Buttons on resource pages are responsible for the main actions with elements
and are components of [ActionButton](/docs/{{version}}/components/action-button).

There are many methods in MoonShine that allow you to override a resource as separate
[buttons](/docs/{{version}}/components/action-button) and the entire [group](/docs/{{version}}/components/action-group).

> [!NOTE]
> More detailed information about the [ActionButton](/docs/{{version}}/components/action-button) component.

> [!WARNING]
> The buttons for creating, viewing, editing, deleting, and mass deleting are placed in separate classes
> to apply all necessary methods to them and thereby eliminate duplication, as these buttons are also used in `HasMany`, `BelongsToMany`, etc.

<a name="index-page-buttons"></a>
## Index page buttons

<a name="index-top-buttons"></a>
### topLeftButtons and topRightButtons

The `topLeftButtons()` and `topRightButtons()` methods in the index page class allow you to add\override
[buttons](/docs/{{version}}/components/action-button) above the table.

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
### Modification of the create button

The `modifyCreateButton()` method allows you to modify the button for creating a new element.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ActionButtonContract;

protected function modifyCreateButton(ActionButtonContract $button): ActionButtonContract
{
    return $button->error();
}
```

Also, you can redefine the button.

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
### Modification of the filter button

The `modifyFiltersButton()` method allows you to modify or override the filter button.

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
## Index table buttons

To add/override buttons in the index table, use the `buttons()` method in the index page class.

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
                'Link'
                fn(Model $item) => '/endpoint?id=' . $item->getKey()
            )
        );
}
```

![resource_buttons_index](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_index.png#light)
![resource_buttons_index_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_buttons_index_dark.png#dark)

For mass actions with elements, you need to add the `bulk()` method.

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
### Modification of the detailed view button

The `modifyDetailButton()` method allows you to modify or override the detail view button of an element.

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
### Edit button modification

The `modifyEditButton()` method allows you to modify or override an element's edit button.

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
### Modification of the delete button

The `modifyDeleteButton()` method allows you to modify or override an element's delete button.

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
### Modification of the mass delete button

The `modifyMassDeleteButton()` method allows you to modify or override the mass delete button.

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
## Form page buttons

To add buttons to a form page, use the `buttons()` method in the form page class.

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

The `formButtons()` method allows you to add\override [buttons](/docs/{{version}}/components/action-button) directly to the create or edit form.

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
## Detail page buttons

To add\override buttons on the detail page, use the `buttons()` method in the detail page class.

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
