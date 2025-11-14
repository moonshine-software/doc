---
video: https://youtu.be/bcFOkXuPSRk?si=RmlstXkRnan5r1K8&t=246
---

# Страницы

- [Основы](#basics)
- [Страница списка](#index-page)
- [Страница формы](#form-page)
- [Детальная страница](#detail-page)
- [Типы страниц](#page-type)
- [Поля](#fields)
- [Слои на странице](#layers)
- [Основной компонент](#main-component)
- [Симуляция Route](#simulate)

---

<a name="basics"></a>
## Основы

Страницы являются основой архитектуры **MoonShine**.
Вся ключевая функциональность определяется непосредственно в классах страниц, что обеспечивает гибкость и модульность.

При создании ресурса так же создаются классы для страниц списка (`IndexPage`), детального просмотра (`DetailPage`) и формы (`FormPage`).
Эти страницы зарегистрируются в ресурсе в методе `pages()`.

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
## Страница списка

Страница списка расширяет класс `IndexPage`.
Она является основным разделом ресурса и отвечает за отображение списка элементов, его фильтрацию, сортировку и многое другое.

### Lazy режим

Lazy-режим откладывает загрузку индексной таблицы до момента, когда она станет видимой на странице.

```php
protected bool $isLazy = true;
```

### Метрики

Метод `metrics()` позволяет определить метрики для отображения на странице списка
(подробнее в разделе [Метрики](/docs/{{version}}/model-resource/metrics)).

### Фильтры

В методе `filters()` вы можете указать список полей для формирования формы фильтра
(подробнее в разделе [Фильтры](/docs/{{version}}/model-resource/filters)).

### Query Tags

Метод `queryTags()` позволяет добавлять кнопки быстрой фильтрации по предустановленным условиям
(подробнее в разделе [Query Tags](/docs/{{version}}/model-resource/query-tags)).

### Обработчики

Метод `handlers()` для регистрации обработчиков событий
(подробнее в разделе [Обработчики](/docs/{{version}}/advanced/handlers)).

### Основной компонент

Вы можете получить основной компонент страницы списка с помощью метода `getListComponent()`, чтобы вывести его где-либо.

```php
$resource->getIndexPage()->getListComponent()
```

Для модификации основного компонента `IndexPage`, используйте метод `modifyListComponent()`.

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

Для полной замены основного компонента `IndexPage` используйте собственный класс
(подробнее в разделе [Основной компонент](#main-component) ниже).

<a name="form-page"></a>
## Страница формы

Страница формы расширяет класс `FormPage` и отвечает за создание и редактирование элементов.

<a name="validation"></a>
### Validation

Вы можете добавить валидацию для полей формы ресурса, используя стандартные правила валидации Laravel.

#### Правила валидации

Метод `rules()` позволяет определить правила валидации для полей.

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

#### Сообщения валидации

Метод `validationMessages()` позволяет переопределить сообщения об ошибках валидации.

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
        'title.required' => 'Заголовок обязателен для заполнения',
        'title.min' => 'Заголовок должен содержать минимум :min символов',
    ];
}
```

#### Подготовка данных для валидации

Метод `prepareForValidation()` позволяет изменить данные перед валидацией.

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

#### Precognitive валидация

Свойство `$isPrecognitive` позволяет включить [precognitive валидацию](https://laravel.com/docs/precognition) для формы.

```php filename:PostFormPage.php
protected bool $isPrecognitive = true;
```

Precognitive валидация позволяет валидировать поля формы в реальном времени при вводе данных.

### Основной компонент

Вы можете получить основной компонент страницы формы с помощью метода `getFormComponent()`, чтобы вывести его где-либо.

```php
$resource->getFormPage()->getFormComponent()
```

Для модификации основного компонента `FormPage`, используйте метод `modifyFormComponent()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\FormBuilderContract;

protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
{
    return $component->withoutRedirect();
}
```

Для полной замены основного компонента `FormPage` используйте собственный класс
(подробнее в разделе [Основной компонент](#main-component) ниже).

<a name="detail-page"></a>
## Детальная страница

Вы можете получить основной компонент детальной страницы с помощью метода `getDetailComponent()`, чтобы вывести его где-либо.

```php
$resource->getDetailPage()->getDetailComponent()
```

Детальная страница расширяет класс `DetailPage` и отвечает за детальное отображение элемента.

### Основной компонент

Для модификации основного компонента `DetailPage`, используйте метод `modifyDetailComponent()`.

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

Для полной замены основного компонента `DetailPage` используйте собственный класс
(подробнее в разделе [Основной компонент](#main-component) ниже).

<a name="page-type"></a>
## Типы страниц

Для указания типа страницы в `ModelResource` используется `enum` класс `PageType`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

PageType::INDEX;
PageType::FORM;
PageType::DETAIL;
```

<a name="fields"></a>
## Поля

> [!TIP]
> О добавлении полей на страницы смотрите в разделе [ModelResource > Поля](/docs/{{version}}/model-resource/fields).

<a name="layers"></a>
## Слои на странице

Для удобства все страницы *crud* разделены на три слоя, которые отвечают за отображение определенной области на странице.

- `TopLayer` - используется для отображения метрик на странице индекса и для дополнительных кнопок на странице редактирования,
- `MainLayer` - этот слой используется для отображения основной информации с помощью [FormBuilder](/docs/{{version}}/components/form-builder)
и [TableBuilder](/docs/{{version}}/components/table-builder),
- `BottomLayer` - используется для отображения дополнительной информации.

Для настройки слоев используются соответствующие методы: `topLayer()`, `mainLayer()` и `bottomLayer()`.
Методы должны возвращать массив [Компонентов](/docs/{{version}}/page/index#components).

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
> Если вам нужно получить доступ к компонентам определенного слоя, то используйте метод `getLayerComponents()`.

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
> Если вам нужно добавить компонент для указанной страницы в нужный слой через ресурс,
> то используйте метод `onLoad()` ресурса и `pushToLayer()` страницы.

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
## Основной компонент

Вы можете полностью переопределить основной компонент страницы ресурса.
Это позволяет инкапсулировать собственную реализацию компонента и переиспользовать ее между страницами и ресурсами.

Для этого необходимо создать класс, реализующий соответствующий интерфейс,
реализовать в нём метод `__invoke()` и заменить этим классом значение свойства `$component` на странице.

Далее приведём конкретные примеры реализации для разных страниц.

### IndexPage

```php
function __invoke(
    IndexPageContract $page,
    iterable $items,
    FieldsContract $fields
): ComponentContract
```

- `$page` - объект индексной страницы, на которой располагается компонент,
- `$items` - элементы списка для отображения,
- `$fields` - поля, которые будут отображаться в списке.

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
> Пример страницы индекса с компонентом `CardsBuilder` в разделе [Рецепты](/docs/{{version}}/recipes/index-page-cards).

### DetailPage

```php
function __invoke(
    DetailPageContract $page,
    ?DataWrapperContract $item,
    FieldsContract $fields,
): ComponentContract
```

- `$page` - объект детальной страницы, на которой располагается компонент,
- `$item` - объект с данными,
- `$fields` - поля, которые будут отображаться в компоненте.

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

- `$page` - объект страницы, на которой располагается компонент,
- `$action` - обработчик формы,
- `$item` - объект с данными,
- `$fields` - поля, которые будут отображаться в компоненте.

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
## Симуляция Route

Мы не рекомендуем использовать *CRUD*-страницы на произвольных *URL*.
Однако, если вы хорошо понимаете их логику, можете применять *CRUD*-страницы на нестандартных маршрутах, эмулируя нужные *URL*.

```php
class HomeController extends Controller
{
    public function __invoke(FormArticlePage $page, ArticleResource $resource)
    {
        return $page->simulateRoute($page, $resource);
    }
}
```
