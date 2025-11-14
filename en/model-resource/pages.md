---
video: https://youtu.be/5o8qSf94Bf0?si=5mR85avWy4pZWfM2&t=245
---

# Pages

- [Basics](#basics)
- [List Page](#index-page)
- [Form Page](#form-page)
- [Detail Page](#detail-page)
- [Page Types](#page-type)
- [Fields](#fields)
- [Layers on the Page](#layers)
- [Main Component](#main-component)
- [Simulate Route](#simulate)

---

<a name="basics"></a>
## Basics

Pages are the core of the **MoonShine** architecture.
All key functionality is defined directly in page classes, which provides flexibility and modularity.

When creating a resource, classes are also created for the list pages (`IndexPage`), detailed view (`DetailPage`) and form (`FormPage`).
These pages will be registered with the resource in the `pages()` method.

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

<a name="index-page"></a>
## List Page

List page extends the `IndexPage` class.
It is the main section of the resource and is responsible for displaying the list of elements, filtering it, sorting it, and much more.

### Lazy mode

Lazy mode delays loading the index table until it becomes visible on the page.

```php
protected bool $isLazy = true;
```

### Metrics

The `metrics()` method allows you to define metrics to display on the list page
(more details in the [Metrics](/docs/{{version}}/model-resource/metrics) section).

### Filters

In the `filters()` method you can specify a list of fields to form the filter form
(more details in the [Filters](/docs/{{version}}/model-resource/filters) section).

### Query Tags

The `queryTags()` method allows you to add quick filtering buttons based on preset conditions
(more details in the [Query Tags](/docs/{{version}}/model-resource/query-tags) section).

### Handlers

The `handlers()` method for registering event handlers
(more details in the [Handlers](/docs/{{version}}/advanced/handlers) section).

### Main component

You can get the main component of a list page using the `getListComponent()` method to output it somewhere.

```php
$resource->getIndexPage()->getListComponent()
```

To modify the main `IndexPage` component, use the `modifyListComponent()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;

/**
 * @param TableBuilder $component
 * @return ComponentContract
 */
protected function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component
        ->sticky()
        ->stickyButtons()
        ->columnSelection();
}
```

To completely replace the main `IndexPage` component, use your own class
(more details in the [Main Component](#main-component) section below).

<a name="form-page"></a>
## FormPage

Form page extends the `FormPage` class and is responsible for creating and editing elements.

<a name="validation"></a>
### Validation

You can add validation for resource form fields using Laravel's standard validation rules.

#### Validation rules

The `rules()` method allows you to define validation rules for fields.

```php
protected function rules(DataWrapperContract $item): array
{
    return [
        'title' => ['required', 'string', 'min:5'],
        'content' => ['required', 'string'],
        'email' => ['sometimes', 'email'],
    ];
}
```

#### Validation messages

The `validationMessages()` method allows you to override validation error messages.

```php
protected function rules(DataWrapperContract $item): array
{
    return [
        'title' => ['required', 'string', 'min:5'],
    ];
}

public function validationMessages(): array
{
    return [
        'title.required' => 'Title is required',
        'title.min' => 'Title must contain at least :min characters',
    ];
}
```

#### Preparing data for validation

The `prepareForValidation()` method allows you to change data before validation.

```php
public function prepareForValidation(): void
{
    request()->merge([
        'slug' => request()
            ->string('slug')
            ->lower()
            ->value(),
    ]);
}
```

#### Precognitive validation

The `$isPrecognitive` property allows you to enable [precognitive validation](https://laravel.com/docs/precognition) for the form.

```php filename:PostFormPage.php
protected bool $isPrecognitive = true;
```

Precognitive validation allows you to validate form fields in real time as you enter data.

### Main component

You can get the main form page component using the `getFormComponent()` method to output it somewhere.

```php
$resource->getFormPage()->getFormComponent()
```

To modify the main `FormPage` component, use the `modifyFormComponent()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\FormBuilderContract;

protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
{
    return $component->withoutRedirect();
}
```

To completely replace the main `FormPage` component, use your own class
(more details in the [Main Component](#main-component) section below).

<a name="detail-page"></a>
## Detail Page

You can get the detail page's main component using the `getDetailComponent()` method to output it somewhere.

```php
$resource->getDetailPage()->getDetailComponent()
```

Detail page extends the `DetailPage` class and is responsible for displaying an element in detail.

### Main component

To modify the main `DetailPage` component, use the `modifyDetailComponent()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;

/**
 * @param TableBuilder $component
 * @return ComponentContract
 */
public function modifyDetailComponent(ComponentContract $component): ComponentContract
{
    return $component->vertical(
        title: fn(FieldContract $field, Column $default, TableBuilder $ctx) => $default->columnSpan(2),
        value: fn(FieldContract $field, Column $default, TableBuilder $ctx) => $default->columnSpan(10),
    );
}
```

To completely replace the main `DetailPage` component, use your own class
(more details in the [Main Component](#main-component) section below).

<a name="page-type"></a>
## Page types

To specify the page type in `ModelResource`, the `enum` class `PageType` is used.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

PageType::INDEX;
PageType::FORM;
PageType::DETAIL;
```

<a name="fields"></a>
## Fields

> [!TIP]
> To learn about adding fields to pages, see [ModelResource > Fields](/docs/{{version}}/model-resource/fields).

<a name="layers"></a>
## Layers on the page

For convenience, all *crud* pages are divided into three layers, which are responsible for displaying a specific area on the page.

- `TopLayer` - used to display metrics on the index page and for additional buttons on the edit page,
- `MainLayer` - this layer is used to display main information using [FormBuilder](/docs/{{version}}/components/form-builder)
and [TableBuilder](/docs/{{version}}/components/table-builder),
- `BottomLayer` - used to display additional information.

To configure layers, the corresponding methods are used: `topLayer()`, `mainLayer()` and `bottomLayer()`.
Methods must return an array of [Components](/docs/{{version}}/page/index#components).

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
> If you need to access the components of a specific layer, then use the `getLayerComponents()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\Layer;

// Resource
$this->getFormPage()->getLayerComponents(Layer::BOTTOM);

// Page
$this->getLayerComponents(Layer::BOTTOM);
```

> [!TIP]
> If you need to add a component for a specified page to the desired layer via a resource,
> then use the `onLoad()` method of the resource and the `pushToLayer()` method of the page.

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

<a name="main-component"></a>
## Main Component

You can completely override the main resource page component.
This allows you to encapsulate your own component implementation and reuse it between pages and resources.

To do this, you need to create a class that implements the appropriate interface,
implement the `__invoke()` method in it and replace the value of the `$component` property on the page with this class.

Below we provide specific examples of implementation for different pages.

### IndexPage

```php
function __invoke(
    IndexPageContract $page,
    iterable $items,
    FieldsContract $fields
): ComponentContract
```

- `$page` - object of the index page on which the component is located,
- `$items` - list elements to display,
- `$fields` - fields that will be displayed in the list.

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

```php filename:ArticleIndexPage
protected string $component = ArticleListComponent::class;
```

> [!NOTE]
> Example of an index page with the `CardsBuilder` component in the [Recipes](/docs/{{version}}/recipes/index-page-cards) section.

### DetailPage

```php
function __invoke(
    DetailPageContract $page,
    ?DataWrapperContract $item,
    FieldsContract $fields,
): ComponentContract
```

- `$page` - object of the detailed page on which the component is located,
- `$item` - object with data,
- `$fields` - fields that will be displayed in the component.

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

```php filename:ArticleDetailPage
protected string $component = ArticleDetailComponent::class;
```

### FormPage

```php
function __invoke(
    FormPageContract $page,
    string $action,
    ?DataWrapperContract $item,
    FieldsContract $fields,
    bool $isAsync = true,
): FormBuilderContract
```

- `$page` - object of the page on which the component is located,
- `$action` - form handler,
- `$item` - object with data,
- `$fields` - fields that will be displayed in the component.

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

final class ArticleFormComponent implements DefaultFormContract
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

```php filename:ArticleFormPage
protected string $component = ArticleFormComponent::class;
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
