---
video: https://youtu.be/5o8qSf94Bf0?si=5mR85avWy4pZWfM2&t=245
---

# Pages

- [Basics](#basics)
- [Page Functionality](#functionality)
- [Page Types](#page-type)
- [Adding Fields](#fields)
- [Main Components](#components)
- [Layers on the Page](#layers)
- [Simulate Route](#simulate)

---

<a name="basics"></a>
## Basics

**MoonShine** provides the ability to configure `CRUD` pages.
To do this, you need to choose the resource type `Model resource with pages` when creating a resource via the command.

This will create a model resource class and additional classes for the index, detail view, and form pages.
The page classes will, by default, be located in the `app/MoonShine/Pages` directory.

In the created model resource, `CRUD` pages will be registered in the `pages()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Resources;

use App\MoonShine\Resources\Post\Pages\PostIndexPage;
use App\MoonShine\Resources\Post\Pages\PostFormPage;
use App\MoonShine\Resources\Post\Pages\PostDetailPage;
use MoonShine\Laravel\Resources\ModelResource; // [tl! collapse:end]

class PostResource extends ModelResource
{
    // ...

    protected function pages(): array
    {
        return [
            PostIndexPage::class,
            PostFormPage::class,
            PostDetailPage::class,
        ];
    }
}
```

<a name="functionality"></a>
## Page Functionality

Pages are the foundation of the **MoonShine** architecture. All key functionality is defined directly in page classes, ensuring flexibility and modularity.

### IndexPage

`IndexPage` is responsible for displaying the list of items and contains the following functionality:

- **Metrics** - the `metrics()` method allows you to define metrics for display on the list page (see [Metrics](/docs/{{version}}/model-resource/metrics) section for details).
- **Filters** - the `filters()` method for defining data filters (see [Filters](/docs/{{version}}/model-resource/filters) section for details).
- **Query Tags** - the `queryTags()` method for quick filtering by preset conditions (see [Query Tags](/docs/{{version}}/model-resource/query-tags) section for details).
- **Handlers** - the `handlers()` method for registering event handlers (see [Handlers](/docs/{{version}}/advanced/handlers) section for details).
- **Buttons** - the `topButtons()` method for adding buttons to the top of the page (see [Buttons](/docs/{{version}}/model-resource/buttons) section for details).
- **Working with components** - to completely replace a component, use your own class (see [Main Components](#components) section below for details), to modify an existing component, use the `modifyListComponent()` method (see [Tables](/docs/{{version}}/model-resource/table#modifiers) section for details).

### FormPage

`FormPage` is responsible for creating and editing items:

- **Working with components** - to completely replace a component, use your own class (see [Main Components](#components) section below for details), to modify an existing component, use the `modifyFormComponent()` method (see [Form](/docs/{{version}}/model-resource/form#modifiers) section for details).

### DetailPage

`DetailPage` is responsible for the detailed display of an item:

- **Working with components** - to completely replace a component, use your own class (see [Main Components](#components) section below for details), to modify an existing component, use the `modifyDetailComponent()` method (see [Tables](/docs/{{version}}/model-resource/table#modifiers) section for details).

> [!NOTE]
> For backward compatibility, all the listed methods are also available in the `ModelResource` class, but it is recommended to define them directly in the corresponding page classes.

<a name="page-type"></a>
## Page Types

To specify the page type in `ModelResource`, the `enum` class `PageType` is used.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

PageType::INDEX; // Index page
PageType::FORM; // Form page
PageType::DETAIL; // Detail page
```

<a name="fields"></a>
## Adding Fields

[Fields](/docs/{{version}}/fields/index) in **MoonShine** are used not only for data input but also for output.
The `fields()` method in the `CRUD` page class allows you to specify the necessary fields.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Resources\Post\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    // ...

    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }
}
```

<a name="components"></a>
## Main Components

The main component of the page is specified by a class that implements one of the namespace interfaces `MoonShine\Crud\Contracts\PageComponents`. This allows you to completely replace a component, encapsulate the logic, and reuse it between pages and resources.

Available interfaces:

- `DefaultListComponentContract` - the main component of the index page (list of elements),
- `DefaultDetailComponentContract` - the main component of the detail page,
- `DefaultFormContract` - the main form component.

The class must implement the `__invoke()` method, which returns a component that implements the `MoonShine\Contracts\UI\ComponentContract` interface.

### IndexPage

To change the index page component, you need to create a class that implements the `DefaultListComponentContract` interface:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:8]
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\TableBuilderContract;
use MoonShine\Core\Traits\WithCore;
use MoonShine\Crud\Contracts\Page\IndexPageContract;
use MoonShine\Crud\Contracts\PageComponents\DefaultListComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;

final class ArticleListComponent implements DefaultListComponentContract
{
    use WithCore;

    public function __construct(CoreContract $core) {
        $this->setCore($core);
    }

    /**
     * @param  iterable<array-key, mixed>  $items
     */
    public function __invoke(
        IndexPageContract $page,
        iterable $items,
        FieldsContract $fields
    ): ComponentContract
    {
        $resource = $page->getResource();

        return TableBuilder::make(items: $items)
            ->name($page->getListComponentName())
            ->fields($fields)
            ->cast($resource->getCaster())
            ->withNotFound()
            ->buttons($page->getButtons())
            ->when($page->isAsync(), function (TableBuilderContract $table) use($page): void {
                $table->async(
                    url: fn (): string
                        => $page->getRouter()->getEndpoints()->component(
                        name: $table->getName(),
                        additionally: $this->getCore()->getRequest()->getRequest()->getQueryParams(),
                    ),
                )->pushState();
            })
            ->when($page->isLazy(), function (TableBuilderContract $table) use($resource): void {
                $table->lazy()->whenAsync(
                    fn (TableBuilderContract $t): TableBuilderContract
                        => $t->items(
                        $resource->getItems(),
                    ),
                );
            })
            ->when(
                ! \is_null($resource->getItemsResolver()),
                function (TableBuilderContract $table) use($resource): void {
                    $table->itemsResolver(
                        $resource->getItemsResolver(),
                    );
                },
            );
    }
}
```

`__invoke()` method arguments:

- `$page` - object of the index page on which the component is located,
- `$items` - list elements to display,
- `$fields` - fields that will be displayed in the list.

Now in the page class in the `$component` property you need to override the component to display the list:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Contracts\PageComponents\DefaultListComponentContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class ArticleIndexPage extends IndexPage
{
    /**
     * @var class-string<DefaultListComponentContract>
     */
    protected string $component = ArticleListComponent::class;
}
```

You can also change the list component using the `getItemsComponent()` method:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\UI\ComponentContract;

getItemsComponent(iterable $items, FieldsContract $fields): ComponentContract
```

- `$items` - field values,
- `$fields` - fields.

> [!NOTE]
> Example of an index page with the `CardsBuilder` component in the [Recipes](/docs/{{version}}/recipes/index-page-cards) section.

### DetailPage

To change the detail view page component, you need to create a class that implements the `DefaultDetailComponentContract` interface:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Crud\Contracts\Page\DetailPageContract;
use MoonShine\Crud\Contracts\PageComponents\DefaultDetailComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;

final class ArticleDetailComponent implements DefaultDetailComponentContract
{
    public function __invoke(
        DetailPageContract $page,
        ?DataWrapperContract $item,
        FieldsContract $fields,
    ): ComponentContract {
        $resource = $page->getResource();

        return TableBuilder::make($fields)
            ->cast($resource->getCaster())
            ->items([$item])
            ->vertical(
                title: $resource->isDetailInModal() ? 3 : 2,
                value: $resource->isDetailInModal() ? 9 : 10,
            )
            ->simple()
            ->preview()
            ->class('table-divider');
    }
}
```

`__invoke()` method arguments:

- `$page` - object of the detailed page on which the component is located,
- `$item` - object with data,
- `$fields` - fields that will be displayed in the component.

Now in the page class in the `$component` property you need to override the component for detailed viewing:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Contracts\PageComponents\DefaultDetailComponentContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;

class ArticleDetailPage extends DetailPage
{
    /**
     * @var class-string<DefaultDetailComponentContract>
     */
    protected string $component = ArticleDetailComponent::class;
}
```

You can also change the main component of the detail view page using the `getDetailComponent()` method:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

getDetailComponent(bool $withoutFragment = false): ComponentContract
```

- `$withoutFragment` - flag of whether the component should be wrapped in a `Fragment`.

### FormPage

To change a page component with an element edit form, you need to create a class that implements the `DefaultFormContract` interface:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:12]
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Core\Traits\WithCore;
use MoonShine\Crud\Collections\Fields;
use MoonShine\Crud\Contracts\Page\FormPageContract;
use MoonShine\Crud\Contracts\PageComponents\DefaultFormContract;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Hidden;

final class ArticleForm implements DefaultFormContract
{
    use WithCore;

    public function __construct(CoreContract $core) {
        $this->setCore($core);
    }

    public function __invoke(
        FormPageContract $page,
        string $action,
        ?DataWrapperContract $item,
        FieldsContract $fields,
        bool $isAsync = true,
    ): FormBuilderContract
    {
        $resource = $page->getResource();

        return FormBuilder::make($action)
            ->cast($resource->getCaster())
            ->fill($item)
            ->fields([
                /** @phpstan-ignore argument.templateType */
                ...$fields
                    ->when(
                        ! \is_null($item),
                        static fn (Fields $fields): Fields
                            => $fields->push(
                            Hidden::make('_method')->setValue('PUT'),
                        ),
                    )
                    ->toArray(),
            ])
            ->when(
                ! $page->hasErrorsAbove(),
                fn (FormBuilderContract $form): FormBuilderContract => $form->errorsAbove($page->hasErrorsAbove()),
            )
            ->when(
                $isAsync,
                fn (FormBuilderContract $formBuilder): FormBuilderContract
                    => $formBuilder
                    ->async(
                        events: array_filter([
                            $resource->getListEventName(
                                $this->getCore()->getRequest()->getScalar('_component_name', 'default'),
                                $isAsync && $resource->isItemExists() ? array_filter([
                                    'page' => $this->getCore()->getRequest()->getScalar('page'),
                                    'sort' => $this->getCore()->getRequest()->getScalar('sort'),
                                ]) : [],
                            ),
                            ! $resource->isItemExists() && $resource->isCreateInModal()
                                ? AlpineJs::event(JsEvent::FORM_RESET, $resource->getUriKey())
                                : null,
                        ]),
                    ),
            )
            ->when(
                $page->isPrecognitive() || ($this->getCore()->getCrudRequest()->isFragmentLoad('crud-form') && ! $isAsync),
                static fn (FormBuilderContract $form): FormBuilderContract => $form->precognitive(),
            )
            ->name($resource->getUriKey())
            ->submit(
                $this->getCore()->getTranslator()->get('moonshine::ui.save'),
                ['class' => 'btn-primary btn-lg'],
            )
            ->buttons($page->getFormButtons());
    }
}
```

`__invoke()` method arguments:

- `$page` - object of the page on which the component is located,
- `$action` - form handler,
- `$item` - object with data,
- `$fields` - fields that will be displayed in the component.

Now in the page class in the `$component` property you need to override the form component:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Contracts\PageComponents\DefaultFormContract;
use MoonShine\Laravel\Pages\Crud\FormPage;

class ArticleFormPage extends FormPage
{
    /**
     * @var class-string<DefaultFormContract>
     */
    protected string $component = ArticleForm::class;
}
```

You can also use the `getFormComponent()` method to change the main component on the form page:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

getFormComponent(bool $withoutFragment = false): ComponentContract
```

- `$withoutFragment` - flag of whether the component should be wrapped in a `Fragment`.

<a name="layers"></a>
## Layers on the Page

For convenience, all *CRUD* pages are divided into three layers, which are responsible for displaying a certain area on the page.

- `TopLayer` - used for displaying metrics on the index page and for additional buttons on the edit page,
- `MainLayer` - this layer is used for displaying main information using [FormBuilder](/docs/{{version}}/components/form-builder) and [TableBuilder](/docs/{{version}}/components/table-builder),
- `BottomLayer` - used for displaying additional information.

To configure the layers, the corresponding methods are used: `topLayer()`, `mainLayer()`, and `bottomLayer()`.
The methods must return an array of [Components](/docs/{{version}}/page/index#components).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\Heading;

class PostIndexPage extends IndexPage
{
    // ...

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
}
```

> [!TIP]
> If you need to access components of a specific layer from a resource or page, use the `getLayerComponents()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\Layer;

// ...

// Resource
$this->getFormPage()->getLayerComponents(Layer::BOTTOM);

// Page
$this->getLayerComponents(Layer::BOTTOM);
```

> [!TIP]
> If you need to add a component to a specified page in the desired layer from a resource, use the resource's `onLoad()` method and the page's `pushToLayer()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Permissions\Components\Permissions;
use MoonShine\Support\Enums\Layer;

protected function onLoad(): void
{
    $this->getFormPage()
        ->pushToLayer(
            layer: Layer::BOTTOM,
            component: Permissions::make(
                'Permissions',
                $this,
            )
        );
}
```

<a name="simulate"></a>
## Simulate Route

We do not recommend using *CRUD* pages to arbitrary *URL*.
However, if you understand their logic well, you can use *CRUD* pages on non-standard routes, emulating the necessary *URL*.

```php
class HomeController extends Controller
{
    public function __invoke(FormArticlePage $page, ArticleResource $resource)
    {
        return $page->simulateRoute($page, $resource);
    }
}
```
