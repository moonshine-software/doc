---
video: https://youtu.be/bcFOkXuPSRk?si=RmlstXkRnan5r1K8&t=246
---

# Страницы

- [Основы](#basics)
- [Функциональность страниц](#functionality)
- [Типы страниц](#page-type)
- [Добавление полей](#fields)
- [Основные компоненты](#components)
- [Слои на странице](#layers)
- [Симуляция Route](#simulate)

---

<a name="basics"></a>
## Основы

**MoonShine** предоставляет возможность настройки `CRUD` страниц.
Для этого необходимо при создании ресурса через команду выбрать тип ресурса `Model resource with pages`.

Это создаст класс ресурса модели и дополнительные классы для страниц индекса, детального просмотра и формы.
Классы страниц по умолчанию будут располагаться в директории `app/MoonShine/Pages`.

В созданном ресурсе модели страницы `CRUD` будут зарегистрированы в методе `pages()`.

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
## Функциональность страниц

Страницы являются основой архитектуры **MoonShine**. Вся ключевая функциональность определяется непосредственно в классах страниц, что обеспечивает гибкость и модульность.

### IndexPage

`IndexPage` отвечает за отображение списка элементов и содержит следующую функциональность:

- **Метрики** - метод `metrics()` позволяет определить метрики для отображения на странице списка (подробнее в разделе [Метрики](/docs/{{version}}/model-resource/metrics)).
- **Фильтры** - метод `filters()` для определения фильтров данных (подробнее в разделе [Фильтры](/docs/{{version}}/model-resource/filters)).
- **Query Tags** - метод `queryTags()` для быстрой фильтрации по предустановленным условиям (подробнее в разделе [Query Tags](/docs/{{version}}/model-resource/query-tags)).
- **Обработчики** - метод `handlers()` для регистрации обработчиков событий (подробнее в разделе [Обработчики](/docs/{{version}}/advanced/handlers)).
- **Кнопки** - метод `topButtons()` для добавления кнопок в верхнюю часть страницы (подробнее в разделе [Кнопки](/docs/{{version}}/model-resource/buttons)).
- **Работа с компонентами** - для полной замены компонента используйте собственный класс (подробнее в разделе [Основные компоненты](#components) ниже), для модификации существующего компонента используйте метод `modifyListComponent()` (подробнее в разделе [Таблицы](/docs/{{version}}/model-resource/table#modifiers)).

### FormPage

`FormPage` отвечает за создание и редактирование элементов:

- **Работа с компонентами** - для полной замены компонента используйте собственный класс (подробнее в разделе [Основные компоненты](#components) ниже), для модификации существующего компонента используйте метод `modifyFormComponent()` (подробнее в разделе [Форма](/docs/{{version}}/model-resource/form#modifiers)).

### DetailPage

`DetailPage` отвечает за детальное отображение элемента:

- **Работа с компонентами** - для полной замены компонента используйте собственный класс (подробнее в разделе [Основные компоненты](#components) ниже), для модификации существующего компонента используйте метод `modifyDetailComponent()` (подробнее в разделе [Таблицы](/docs/{{version}}/model-resource/table#modifiers)).

> [!NOTE]
> Для обратной совместимости все перечисленные методы также доступны в классе `ModelResource`, но рекомендуется определять их непосредственно в соответствующих классах страниц.

<a name="page-type"></a>
## Типы страниц

Для указания типа страницы в `ModelResource` используется `enum` класс `PageType`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

PageType::INDEX; // Страница индекса
PageType::FORM; // Страница формы
PageType::DETAIL; // Страница детального просмотра
```

<a name="fields"></a>
## Добавление полей

[Поля](/docs/{{version}}/fields/index) в **MoonShine** используются не только для ввода данных, но и для их вывода.
Метод `fields()` в классе страницы `CRUD` позволяет указать необходимые поля.

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
## Основные компоненты

Основной компонент страницы задается классом, реализующим один из интерфейсов неймспейса `MoonShine\Crud\Contracts\PageComponents`. Это позволяет полностью заменить компонент, инкапсулировать логику и переиспользовать ее между страницами и ресурсами.

Доступные интерфейсы:

- `DefaultListComponentContract` — основной компонент индексной страницы (список элементов),
- `DefaultDetailComponentContract` — основной компонент детальной страницы,
- `DefaultFormContract` — основной компонент формы.

Класс должен реализовывать метод `__invoke()`, который возвращает компонент, реализующий интерфейс `MoonShine\Contracts\UI\ComponentContract`.

### IndexPage

Для изменения компонента индексной страницы необходимо создать класс, реализующий интерфейс `DefaultListComponentContract`:

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

Аргументы метода `__invoke()`:

- `$page` - объект индексной страницы, на которой располагается компонент,
- `$items` - элементы списка для отображения,
- `$fields` - поля, которые будут отображаться в списке.

Теперь в классе страницы в свойстве `$component` нужно переопределить компонент для отображения списка:

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

Вы также можете изменить компонент списка с помощью метода `getItemsComponent()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\UI\ComponentContract;

getItemsComponent(iterable $items, FieldsContract $fields): ComponentContract
```

- `$items` - значения полей,
- `$fields` - поля.

> [!NOTE]
> Пример страницы индекса с компонентом `CardsBuilder` в разделе [Рецепты](/docs/{{version}}/recipes/index-page-cards).

### DetailPage

Чтобы изменить компонент страницы детального просмотра необходимо создать класс, реализующий интерфейс `DefaultDetailComponentContract`:

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

Аргументы метода `__invoke()`:

- `$page` - объект детальной страницы, на которой располагается компонент,
- `$item` - объект с данными,
- `$fields` - поля, которые будут отображаться в компоненте.

Теперь в классе страницы в свойстве `$component` нужно переопределить компонент для детального просмотра:

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

Также изменить основной компонент страницы детального просмотра можно с помощью метода `getDetailComponent()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

getDetailComponent(bool $withoutFragment = false): ComponentContract
```

- `$withoutFragment` - флаг необходимости оборачивать компонент в `Fragment`.

### FormPage

Для изменения компонента страницы с формой редактирования элемента необходимо создать класс, реализующий интерфейс `DefaultFormContract`:

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

Аргументы метода `__invoke()`:

- `$page` - объект страницы, на которой располагается компонент,
- `$action` - обработчик формы,
- `$item` - объект с данными,
- `$fields` - поля, которые будут отображаться в компоненте.

Теперь в классе страницы в свойстве `$component` нужно переопределить компонент формы:

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

Вы также с помощью метода `getFormComponent()` можете изменить основной компонент на странице с формой:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

getFormComponent(bool $withoutFragment = false): ComponentContract
```

- `$withoutFragment` - флаг необходимости оборачивать компонент в `Fragment`.

<a name="layers"></a>
## Слои на странице

Для удобства все страницы *crud* разделены на три слоя, которые отвечают за отображение определенной области на странице.

- `TopLayer` - используется для отображения метрик на странице индекса и для дополнительных кнопок на странице редактирования,
- `MainLayer` - этот слой используется для отображения основной информации с помощью [FormBuilder](/docs/{{version}}/components/form-builder) и [TableBuilder](/docs/{{version}}/components/table-builder),
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
> Если вам нужно получить доступ к компонентам определенного слоя через ресурс или страницу, то используйте метод `getLayerComponents()`.

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
> Если вам нужно добавить компонент для указанной страницы в нужный слой через ресурс, то используйте метод `onLoad()` ресурса и `pushToLayer()` страницы.

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
