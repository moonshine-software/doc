https://moonshine-laravel.com/docs/resource/models-resources/resources-pages?change-moonshine-locale=en

------
# With pages

- [Basics](#basics)
- [PageType](#page-type)
- [Adding fields](#fields)
- [Main components](#components)
- [Layers on a page](#layers)

<a name="basics"></a>
## Basics

**MoonShine** provides the ability to customize the *ModelResource* pages crud, for this it is necessary, when creating a resource through the command, select resource type `Model resource with pages`.

This will create a model resource class and additional classes for the index, detail, and form pages. Page classes will be located by default in the `app/MoonShine/Pages` directory.

In the created model resource, crud pages will be registered in the `pages()` method.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use App\MoonShine\Pages\Post\PostIndexPage;
use App\MoonShine\Pages\Post\PostFormPage;
use App\MoonShine\Pages\Post\PostDetailPage;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function pages(): array
    {
        return [
            PostIndexPage::make($this->title()),
            PostFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            PostDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    //...
}
```

<a name="page-type"></a>
## PageType

To specify the page type in **ModelResource**, use *enum class* `PageType`.

The following page types are available:

- `INDEX` - index page,
- `FORM` - form page,
- `DETAIL` - detail page.

```php
use MoonShine\Enums\PageType;

//...

PageType::INDEX;
PageType::FORM;
PageType::DETAIL;
```

<a name="fields"></a>
## Adding fields

[Fields](https://moonshine-laravel.com/docs/resource/fields/fields-index) in **MoonShine** are used not only for data input, but also for their output.  
The `fields()` method in the page *crud* class allows you to specify the required fields.

```php
namespace App\MoonShine\Pages\Post;

use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }

    //...
}
```

<a name="components"></a>
## Main components

In the **MoonShine** admin panel, you can quickly change the main component on the page.

#### IndexPage

The `itemsComponent()` method allows you to change the main component of the index page.

```php
itemsComponent(iterable $items, Fields $fields)
```

- `$items` - field values,
- `$fields` - fields.

```php
use MoonShine\Components\TableBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Fields\Fields;
use MoonShine\Pages\Crud\IndexPage;

class ArticleIndexPage extends IndexPage
{
    // ...

    protected function itemsComponent(iterable $items, Fields $fields): MoonShineRenderable
    {
        return TableBuilder::make(items: $items)
            ->name($this->listComponentName())
            ->fields($fields)
            ->cast($this->getResource()->getModelCast())
            ->withNotFound()
            ->when(
                ! is_null($this->getResource()->trAttributes()),
                fn (TableBuilder $table): TableBuilder => $table->trAttributes(
                    $this->getResource()->trAttributes()
                )
            )
            ->when(
                ! is_null($this->getResource()->tdAttributes()),
                fn (TableBuilder $table): TableBuilder => $table->tdAttributes(
                    $this->getResource()->tdAttributes()
                )
            )
            ->buttons($this->getResource()->getIndexItemButtons())
            ->customAttributes([
                'data-click-action' => $this->getResource()->getClickAction(),
            ])
            ->when($this->getResource()->isAsync(), function (TableBuilder $table): void {
                $table->async()->customAttributes([
                    'data-pushstate' => 'true',
                ]);
            });
    }
}
```
> [!TIP]
> Example index page with *CardsBuilder* component in section [Recipes](https://moonshine-laravel.com/docs/resource/recipes/recipes#index-page-cards)
- DetailPage

The `detailComponent()` method allows you to change the main component of a detail page.

```php
detailComponent(?Model $item, Fields $fields)
```

-`$item` - Eloquent Model
-`$fields` - fields

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Components\TableBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Fields\Fields;
use MoonShine\Pages\Crud\DetailPage;

class ArticleDetailPage extends DetailPage
{
    // ...

    protected function detailComponent(?Model $item, Fields $fields): MoonShineRenderable
    {
        return TableBuilder::make($fields)
            ->cast($this->getResource()->getModelCast())
            ->items([$item])
            ->vertical()
            ->simple()
            ->preview()
            ->tdAttributes(fn (
                $data,
                int $row,
                int $cell,
                ComponentAttributeBag $attributes
            ): ComponentAttributeBag => $attributes->when(
                $cell === 0,
                fn (ComponentAttributeBag $attr): ComponentAttributeBag => $attr->merge([
                    'class' => 'font-semibold',
                    'width' => '20%',
                ])
            ));
    }
}
```
#### FormPage

The `formComponent()` method allows you to change the main component on the page with the form.

```php
formComponent(
    string $action,
    ?Model $item,
    Fields $fields,
    bool $isAsync = false,
): MoonShineRenderable
```

-`$action` - action,
-`$item` - Eloquent Model,
-`$fields` - fields,
-`$isAsync` - asynchronous mode.

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Components\FormBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Hidden;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Support\AlpineJs;

class ArticleFormPage extends FormPage
{
    // ...

    protected function formComponent(
        string $action,
        ?Model $item,
        Fields $fields,
        bool $isAsync = false,
    ): MoonShineRenderable {
        $resource = $this->getResource();

        return FormBuilder::make($action)
            ->fillCast(
                $item,
                $resource->getModelCast()
            )
            ->fields(
                $fields
                    ->when(
                        ! is_null($item),
                        fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_method')->setValue('PUT')
                        )
                    )
                    ->when(
                        ! $item?->exists && ! $resource->isCreateInModal(),
                        fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_force_redirect')->setValue(true)
                        )
                    )
                    ->toArray()
            )
            ->when(
                $isAsync,
                fn (FormBuilder $formBuilder): FormBuilder => $formBuilder
                    ->async(asyncEvents: [
                        $resource->listEventName(request('_component_name', 'default')),
                        AlpineJs::event(JsEvent::FORM_RESET, 'crud'),
                    ])
            )
            ->when(
                $resource->isPrecognitive() || (moonshineRequest()->isFragmentLoad('crud-form') && ! $isAsync),
                fn (FormBuilder $form): FormBuilder => $form->precognitive()
            )
            ->name('crud')
            ->submit(__('moonshine::ui.save'), ['class' => 'btn-primary btn-lg']);
    }
}
```

<a name="layers"></a>
## Layers on a page

For convenience, all *crud* pages are divided into three layers, which are responsible for displaying a specific area on the page.

- `TopLayer` - used to display metrics on the index page and for additional buttons on the edit page
- `MainLayer` - this layer is used to display basic information using [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder) and [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder)
- `BottomLayer` - used to display additional information

To customize layers, the corresponding methods are used: `topLayer()`, `mainLayer()`, and `bottomLayer()`. Methods must return [Components](https://moonshine-laravel.com/docs/resource/page/page-class#components) an array.

```php
namespace App\MoonShine\Pages\Post;

use MoonShine\Decorations\Heading;
use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    //...

    protected function topLayer(): array
    {
        return [
            Heading::make('Custom top'),
            ...parent::topLayer()
        ];
    }

    protected function mainLayer(): array
    {
        return [
            Heading::make('Custom main'),
            ...parent::mainLayer()
        ];
    }

    protected function bottomLayer(): array
    {
        return [
            Heading::make('Custom bottom'),
            ...parent::bottomLayer()
        ];
    }

    //...
}
```
> [!TIP]
> If you need to access the components of a certain layer through a resource or page, then use the `getLayerComponents` method.

```php
use MoonShine\Enums\Layer;
use MoonShine\Enums\PageType;

// ...

// Resource
$this->getPages()
    ->findByType(PageType::FORM)
    ->getLayerComponents(Layer::BOTTOM);

// Page
$this->getLayerComponents(Layer::BOTTOM);
```

> [!TIP]
> If you need to add a component for the specified page to the desired layer through a resource, then use the `onBoot` method resource and page `pushToLayer`.

```php
protected function onBoot(): void
{
    $this->getPages()
        ->findByUri(PageType::FORM->value)
        ->pushToLayer(
            layer: Layer::BOTTOM,
            component: Permissions::make(
                'Permissions',
                $this,
            )
        );
}
```
