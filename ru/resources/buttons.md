# Кнопки

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
## Основы

Кнопки отображаются на страницах ресурса: на странице индекса, страницах форм (создание/редактирование) и странице детального просмотра.  
Они отвечают за основные действия с элементами и являются компонентами [`ActionButton`](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

В админ-панели **MoonShine** существует множество методов, которые позволяют переопределить ресурс как отдельную [кнопку](https://moonshine-laravel.com/docs/resource/actionbutton/action_button), так и всю [группу](https://moonshine-laravel.com/docs/resource/actionbutton/action_button#group).

> [!NOTE]
> Более подробная информация о компоненте [ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

> [!WARNING]
> Кнопки для создания, просмотра, редактирования, удаления и массового удаления размещены в отдельных классах, чтобы применить к ним все необходимые методы и тем самым устранить дублирование, поскольку эти кнопки также используются в HasMany, BelongsToMany и т.д.

<a name="create"></a>
## Кнопка создания

#### Модификация

Метод `modifyCreateButton()` позволяет модифицировать кнопку для создания нового элемента.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyCreateButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_create](https://moonshine-laravel.com/screenshots/resource_button_create.png) 
![resource_button_create_dark](https://moonshine-laravel.com/screenshots/resource_button_create_dark.png)

#### Переопределение

Метод `getCreateButton()` позволяет переопределить кнопку для создания нового элемента.

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
## Кнопка детального просмотра

#### Модификация

Метод `modifyDetailButton()` позволяет модифицировать кнопку детального просмотра элемента.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyDetailButton(ActionButton $button): ActionButton
{
    return $button->warning();
}
```

![resource_button_detail](https://moonshine-laravel.com/screenshots/resource_button_detail.png) 
![resource_button_detail_dark](https://moonshine-laravel.com/screenshots/resource_button_detail_dark.png)

#### Переопределение

Метод `getDetailButton()` позволяет переопределить кнопку детального просмотра элемента.

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
## Кнопка редактирования

#### Модификация

Метод `modifyEditButton()` позволяет модифицировать кнопку редактирования элемента.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyEditButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.pencil-square');
}
```

![resource_button_edit](https://moonshine-laravel.com/screenshots/resource_button_edit.png) 
![resource_button_edit_dark](https://moonshine-laravel.com/screenshots/resource_button_edit_dark.png)

#### Переопределение

Метод `getEditButton()` позволяет переопределить кнопку редактирования элемента.

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
## Кнопка удаления

#### Модификация

Метод `modifyDeleteButton()` позволяет модифицировать кнопку удаления элемента.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
}
```

![resource_button_delete](https://moonshine-laravel.com/screenshots/resource_button_delete.png) 
![resource_button_delete_dark](https://moonshine-laravel.com/screenshots/resource_button_delete_dark.png)

#### Переопределение

Метод `getDeleteButton()` позволяет переопределить кнопку удаления элемента.

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
## Кнопка массового удаления

#### Модификация

Метод `modifyMassDeleteButton()` позволяет модифицировать кнопку массового удаления.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyMassDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
}
```

![resource_button_mass_delete](https://moonshine-laravel.com/screenshots/resource_button_mass_delete.png) ![resource_button_mass_delete_dark](https://moonshine-laravel.com/screenshots/resource_button_mass_delete_dark.png)

#### Переопределение

Метод `getMassDeleteButton()` позволяет переопределить кнопку массового удаления.

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
## Кнопка экспорта

#### Модификация

Метод `modifyExportButton()` позволяет модифицировать кнопку экспорта.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyExportButton(ActionButton $button): ActionButton
{
    return $button->secondary();
}
```

![resource_button_export](https://moonshine-laravel.com/screenshots/resource_button_export.png) 
![resource_button_export_dark](https://moonshine-laravel.com/screenshots/resource_button_export_dark.png)

#### Переопределение

Метод `getExportButton()` позволяет переопределить кнопку экспорта.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\ExportButton;

public function getExportButton(): ActionButton
{
    return ExportButton::for($this, export: $this->export());
}
```

<a name="import"></a>
## Кнопка импорта

#### Модификация

Метод `modifyImportButton()` позволяет модифицировать кнопку импорта.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyImportButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_import](https://moonshine-laravel.com/screenshots/resource_button_import.png) 
![resource_button_import_dark](https://moonshine-laravel.com/screenshots/resource_button_import_dark.png)

#### Переопределение

Метод `getImportButton()` позволяет переопределить кнопку импорта.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\ImportButton;

public function getImportButton(): ActionButton
{
    return ImportButton::for($this, import: $this->import());
}
```

<a name="filters"></a>
## Кнопка фильтров

#### Модификация

Метод `modifyFiltersButton()` позволяет модифицировать кнопку фильтров.

```php
use MoonShine\ActionButtons\ActionButton;

protected function modifyFiltersButton(ActionButton $button): ActionButton
{
    return $button->error();
}
```

![resource_button_filters](https://moonshine-laravel.com/screenshots/resource_button_filters.png) 
![resource_button_filters_dark](https://moonshine-laravel.com/screenshots/resource_button_filters_dark.png)

#### Переопределение

Метод `getFiltersButton()` позволяет переопределить кнопку фильтров.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\FiltersButton;

public function getFiltersButton(): ActionButton
{
    return FiltersButton::for($this);
}
```

<a name="form"></a>
## Кнопки форм

Метод `getFormBuilderButtons()` позволяет добавить дополнительные [кнопки](https://moonshine-laravel.com/docs/resource/actionbutton/action_button) в форму создания или редактирования.

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
## Кнопки на странице индекса

По умолчанию на странице индекса ресурса модели есть только кнопка создания.  
Метод `actions()` позволяет добавить дополнительные [кнопки](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

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
## Кнопки элемента

Метод `buttons()` позволяет указать дополнительные кнопки, которые будут отображаться в таблице индекса, в формах создания и редактирования, а также на детальной странице, если они не переопределены для страниц соответствующими методами [`indexButton()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#indexButton), [`formButtons()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#formButtons) и [`detailButtons()`](https://moonshine-laravel.com/docs/resource/models-resources/resources-buttons#detailButtons).

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
## Кнопки в таблице индекса

Для добавления кнопок в таблицу индекса используйте метод `indexButtons()`.

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
> Пример создания пользовательских кнопок для таблицы индекса в разделе [Рецепты](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-buttons)

Для массовых действий с элементами необходимо добавить метод `bulk()`

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

#### Переопределение группы

Если вы хотите полностью изменить все кнопки элементов в таблице индекса, то необходимо переопределить метод `getIndexItemButtons()` в ресурсе.

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
## Кнопки на странице формы

Чтобы добавить кнопки на страницу с формой, используйте метод `formButtons()`.

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

#### Переопределение группы

Если вы хотите полностью изменить все кнопки элемента на странице формы, то необходимо переопределить метод `getFormItemButtons()` в ресурсе.

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
## Кнопки на странице детального просмотра

Чтобы добавить кнопки на страницу детального просмотра, используйте метод `detailButtons()`.

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

#### Переопределение группы

Если вы хотите полностью изменить все кнопки элемента на странице детального просмотра, то необходимо переопределить метод `getDetailItemButtons()` в ресурсе.

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
