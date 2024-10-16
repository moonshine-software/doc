# Buttons

- [Basics](#basics)
- [Create button](#create)
- [Detail button](#detail)
- [Edit button](#edit)
- [Delete button](#delete)
- [Bulk delete button](#mass-delete)
- [Export button](#export)
- [Import button](#import)
- [Filters button](#filters)
- [Form buttons](#form)
- [Buttons on the index page](#actions)
- [Element buttons](#buttons)
- [Index table](#indexButton)
- [Form page](#formButtons)
- [Detail page](#detailButtons)

---

<a name="basics"></a>
## Basics

Buttons are displayed on resource pages: index page, form pages (create/edit) and detail page.  
They are responsible for basic actions with elements and are components [`ActionButton`](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

In the **MoonShine** admin panel there are many methods that allow you to override the resource as a separate [button](https://moonshine-laravel.com/docs/resource/actionbutton/action_button) , and the whole [group](https://moonshine-laravel.com/docs/resource/actionbutton/action_button#group) .

> [!NOTE]
> More detailed information about the [ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button) component.

> [!WARNING]
> The buttons for creating, viewing, editing, deleting and mass deleting are placed in separate classes, in order to apply all the necessary methods to them and thereby eliminate duplication, since these buttons are also used in HasMany, BelongsToMany, etc.

<a name="create"></a>
## Create button

#### Modification

The `modifyCreateButton()` method allows you to modify the button for creating a new element.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyCreateButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_create](https://moonshine-laravel.com/screenshots/resource_button_create.png) 
![resource_button_create_dark](https://moonshine-laravel.com/screenshots/resource_button_create_dark.png)

#### Override

The `getCreateButton()` method allows you to override the button for creating a new element.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\CreateButton;

public function getCreateButton(?string $componentName = null, bool $isAsync = false): ActionButton
{
    return CreateButton::for(
        $this,
        componentName: $componentName,
        isAsync: $isAsync
    );
}
```

<a name="detail"></a>
## Detail button

#### Modification

The `modifyDetailButton()` method allows you to modify the detail view button of an element.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyDetailButton(ActionButton $button): ActionButton
{
    return $button->warning();
}
```

![resource_button_detail](https://moonshine-laravel.com/screenshots/resource_button_detail.png) 
![resource_button_detail_dark](https://moonshine-laravel.com/screenshots/resource_button_detail_dark.png)

#### Override

The `getDetailButton()` method allows you to override the element's detail view button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\DetailButton;

public function getDetailButton(bool $isAsync = false): ActionButton
{
    return DetailButton::for(
        $this,
        isAsync: $isAsync
    );
}
```

<a name="edit"></a>
## Edit button

#### Modification

The `modifyEditButton()` method allows you to modify the element's edit button.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyEditButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.pencil-square');
}
```

![resource_button_edit](https://moonshine-laravel.com/screenshots/resource_button_edit.png) 
![resource_button_edit_dark](https://moonshine-laravel.com/screenshots/resource_button_edit_dark.png)

#### Override

The `getEditButton()` method allows you to override an element's edit button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\EditButton;

public function getEditButton(?string $componentName = null, bool $isAsync = false): ActionButton
{
    return EditButton::for(
        $this,
        componentName: $componentName,
        isAsync: $isAsync
    );
}
```

<a name="delete"></a>
## Delete button

#### Modification

The `modifyDeleteButton()` method allows you to modify the button to delete an element.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
}
```

![resource_button_delete](https://moonshine-laravel.com/screenshots/resource_button_delete.png) 
![resource_button_delete_dark](https://moonshine-laravel.com/screenshots/resource_button_delete_dark.png)

#### Override

The `getDeleteButton()` method allows you to override the element's delete button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\DeleteButton;

public function getDeleteButton(
    ?string $componentName = null,
    string $redirectAfterDelete = '',
    bool $isAsync = false
): ActionButton {
    return DeleteButton::for(
        $this,
        componentName: $componentName,
        redirectAfterDelete: $isAsync ? '' : $redirectAfterDelete,
        isAsync: $isAsync
    );
}
```

<a name="mass-delete"></a>
## Bulk delete button

#### Modification

The `modifyMassDeleteButton()` method allows you to modify the mass delete button.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyMassDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
}
```

![resource_button_mass_delete](https://moonshine-laravel.com/screenshots/resource_button_mass_delete.png) ![resource_button_mass_delete_dark](https://moonshine-laravel.com/screenshots/resource_button_mass_delete_dark.png)

#### Override

The `getMassDeleteButton()` method allows you to override the mass delete button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\MassDeleteButton;

public function getMassDeleteButton(
    ?string $componentName = null,
    string $redirectAfterDelete = '',
    bool $isAsync = false
): ActionButton {
    return MassDeleteButton::for(
        $this,
        componentName: $componentName,
        redirectAfterDelete: $isAsync ? '' : $redirectAfterDelete,
        isAsync: $isAsync
    );
}
```

<a name="export"></a>
## Export button

#### Modification

The `modifyExportButton()` method allows you to modify the export button.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyExportButton(ActionButton $button): ActionButton
{
    return $button->secondary();
}
```

![resource_button_export](https://moonshine-laravel.com/screenshots/resource_button_export.png) 
![resource_button_export_dark](https://moonshine-laravel.com/screenshots/resource_button_export_dark.png)

#### Override

The `getExportButton()` method allows you to override the export button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\ExportButton;

public function getExportButton(): ActionButton
{
    return ExportButton::for($this, export: $this->export());
}
```

<a name="import"></a>
## Import button

#### Modification

The `modifyImportButton()` method allows you to modify the import button.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyImportButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_import](https://moonshine-laravel.com/screenshots/resource_button_import.png) 
![resource_button_import_dark](https://moonshine-laravel.com/screenshots/resource_button_import_dark.png)

#### Override

The `getImportButton()` method allows you to override the import button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\ImportButton;

public function getImportButton(): ActionButton
{
    return ImportButton::for($this, import: $this->import());
}
```

<a name="filters"></a>
## Filters button

#### Modification

The `modifyFiltersButton()` method allows you to modify the filters button.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyFiltersButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_filters](https://moonshine-laravel.com/screenshots/resource_button_filters.png) 
![resource_button_filters_dark](https://moonshine-laravel.com/screenshots/resource_button_filters_dark.png)

#### Override

The `getFiltersButton()` method allows you to override the filters button.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\FiltersButton;

public function getFiltersButton(): ActionButton
{
    return FiltersButton::for($this);
}
```

<a name="form"></a>
## Form buttons

The `getFormBuilderButtons()` method allows you to add additional [buttons](https://moonshine-laravel.com/docs/resource/actionbutton/action_button) into the create or edit form.

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getFormBuilderButtons(): array
    {
        return [
            ActionButton::make('Back', fn() => $this->indexPageUrl())->customAttributes(['class' => 'btn-lg'])
        ];
    }

    //...
}
```

![resource_buttons_form_builder](https://moonshine-laravel.com/screenshots/resource_buttons_form_builder.png) ![resource_buttons_form_builder_dark](https://moonshine-laravel.com/screenshots/resource_buttons_form_builder_dark.png)

<a name="actions"></a>
## Buttons on the index page

By default, the model resource index page only has a button to create.  
The `actions()` method allows you to add additional [buttons](https://moonshine-laravel.com/docs/resource/actionbutton/action_button) .

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Enums\JsEvent;
use MoonShine\Resources\ModelResource;
use MoonShine\Support\AlpineJs;

class PostResource extends ModelResource
{
    //...

    public function actions(): array
    {
        return [
            ActionButton::make('Refresh', '#')
                ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'))
        ];
    }

    //...
}
```

![resource_buttons_actions](https://moonshine-laravel.com/screenshots/resource_buttons_actions.png) 
![resource_buttons_actions_dark](https://moonshine-laravel.com/screenshots/resource_buttons_actions_dark.png)

<a name="buttons"></a>
## Element buttons

The `buttons()` method allows you to specify additional buttons, which will be displayed in the index table, in the creation and editing forms, as well as on the detailed page, if they are not overridden for pages by the corresponding methods [`indexButton()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#indexButton) , [`formButtons()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#formButtons) and [`detailButtons()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#detailButtons) .

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function buttons(): array
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    }

    //...
}
```

<a name="indexButton"></a>
## Buttons in the index table

To add buttons to the index table, use the `indexButtons()` method.

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function indexButtons(): array
    {
        return [
            ActionButton::make(
                'Link',
                fn(Model $item) => '/endpoint?id=' . $item->getKey()
            )
        ];
    }

    //...
}
```

![resource_buttons_index](https://moonshine-laravel.com/screenshots/resource_buttons_index.png) 
![resource_buttons_index_dark](https://moonshine-laravel.com/screenshots/resource_buttons_index_dark.png)

> [!TIP]
> An example of creating custom buttons for the index table in the section [Recipes](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-buttons)

For bulk actions with elements, you need to add the `bulk()` method

```php
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')
            ->bulk()
    ];
}
```

![resource_buttons_bulk](https://moonshine-laravel.com/screenshots/resource_buttons_bulk.png) 
![resource_buttons_bulk_dark](https://moonshine-laravel.com/screenshots/resource_buttons_bulk_dark.png)

#### Group override

If you want to completely change all the item buttons in the index table, then you need to override the `getIndexItemButtons()` method in the resource.

```php
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getIndexItemButtons(): array
    {
        return [
            ...$this->getIndexButtons(),
            $this->getDetailButton(
                isAsync: $this->isAsync()
            ),
            $this->getEditButton(
                isAsync: $this->isAsync()
            ),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: $this->isAsync()
            ),
            $this->getMassDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: $this->isAsync()
            ),
        ];
    }

    //...
}
```

<a name="formButtons"></a>
## Buttons on the form page

To add buttons to a page with a form, use the `formButtons()` method.

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function formButtons(): array
    {
        return [
            ActionButton::make('Link')->method('updateSomething')
        ];
    }

    //...
}
```

![resource_buttons_form](https://moonshine-laravel.com/screenshots/resource_buttons_form.png) 
![resource_buttons_form_dark](https://moonshine-laravel.com/screenshots/resource_buttons_form_dark.png)

#### Group override

If you want to completely change all the buttons on an element on a form page, then you need to override the `getFormItemButtons()` method in the resource.

```php
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getFormItemButtons(): array
    {
        return [
            ...$this->getFormButtons(),
            $this->getDetailButton(),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: false
            ),
        ];
    }

    //...
}
```

<a name="detailButtons"></a>
## Buttons on the detail page

To add buttons on a detail page, use the `detailButtons()` method.

```php
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function detailButtons(): array
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    }

    //...
}
```

![resource_buttons_detail](https://moonshine-laravel.com/screenshots/resource_buttons_detail.png) 
![resource_buttons_detail_dark](https://moonshine-laravel.com/screenshots/resource_buttons_detail_dark.png)

#### Group override

If you want to completely change all the element buttons on the detail page, then you need to override the `getDetailItemButtons()` method in the resource.

```php
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getDetailItemButtons(): array
    {
        return [
            ...$this->getDetailButtons(),
            $this->getEditButton(
                isAsync: $this->isAsync(),
            ),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: false
            ),
        ];
    }

    //...
}
```
