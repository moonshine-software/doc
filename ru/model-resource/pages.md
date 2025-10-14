---
video: https://youtu.be/bcFOkXuPSRk?si=RmlstXkRnan5r1K8&t=246
---

# Страницы

- [Основы](#basics)
- [Обратная совместимость](#backward-compatibility)
- [Breaking Changes](#breaking-changes)
- [Структура](#structure)
- [Типы страниц](#page-type)
- [Добавление полей](#fields)
- [Основные компоненты](#components)
- [Слои на странице](#layers)
- [Симуляция Route](#simulate)

---

<a name="basics"></a>
## Основы

В **MoonShine 4** страницы являются главным элементом ресурса.
Вся логика отображения, построения таблиц и форм, а также действий с записями находится непосредственно в классах страниц.

Если вы используете CRUD-страницы (`IndexPage`, `FormPage`, `DetailPage`), вы можете полностью реализовать логику ресурса внутри них.

<a name="backward-compatibility"></a>
## Обратная совместимость
Для большинства методов ресурсов сохранена совместимость с **версией 3**,
но в **версии 5** эти методы будут окончательно **удалены**.

<a name="breaking-changes"></a>
## Breaking Changes
| Что изменилось                    | Было                                           | Стало                                                              |
|-----------------------------------|------------------------------------------------|--------------------------------------------------------------------|
| Логика страниц                    | Методы `index`, `form`, `detail` в Ресурсе     | Отдельные классы `UserIndexPage`, `UserFormPage`, `UserDetailPage` |
| Формы                             | `formBuilder()` в Ресурсе                      | `fields()` в классе `FormPage`                                     |
| Кнопки                            | `topButtons()` в Ресурсе                       | `topLayer()` в классе `IndexPage`                                  |
| Метрики                           | `metrics()` в Ресурсе                          | `metrics()` в классе `IndexPage`                                   |
| Таблица (`TableBuilder`)          | `tr()`, `td()`, `thead()`, `tbody()` в Ресурсе | в классе `IndexPage`                                               |
| Сахар форм                        | в Ресурсе                                      | в классе `FormPage`                                                |
| Сахар таблиц                      | в Ресурсе                                      | в классе `IndexPage`                                               |
| Модификаторы кнопок и компонентов | в Ресурсе                                      | в классе `CrudPage`                                                |
| метод `topButtons`                | в слое `mainLayer`                             | в слое `topLayer`                                                  |


<a name="structure"></a>
## Структура
Cтруктура страниц ресурса, позволяет гибко управлять отображением, маршрутизацией и поведением каждой страницы отдельно. Каждая страница ресурса располагается в отдельном классе в директории Pages внутри ресурса.
```
app
    └── MoonShine
        └── Resources
            └── User
                ├── UserResource.php
                └── Pages
                    ├── UserIndexPage.php
                    ├── UserFormPage.php
                    └── UserDetailPage.php
```


### Назначение файлов
| Файл                 | Описание                                                                               |
| -------------------- | -------------------------------------------------------------------------------------- |
| `UserResource.php`   | Основной класс ресурса. Определяет модель, заголовки, разрешения, фильтры, поля и т.д. |
| `UserIndexPage.php`  | Класс страницы списка записей (аналог `index()` ранее).                                |
| `UserFormPage.php`   | Класс страницы формы создания или редактирования записи.                               |
| `UserDetailPage.php` | Класс страницы просмотра одной записи.                                                 |



## осталось из 3 версии пока
Это создаст класс ресурса модели и дополнительные классы для страниц индекса, детального просмотра и формы.
Классы страниц по умолчанию будут располагаться в директории `app/MoonShine/Pages`.

В созданном ресурсе модели страницы `CRUD` будут зарегистрированы в методе `pages()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Resources;

use App\MoonShine\Pages\Post\PostIndexPage;
use App\MoonShine\Pages\Post\PostFormPage;
use App\MoonShine\Pages\Post\PostDetailPage;
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
namespace App\MoonShine\Pages\Post;

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

В **MoonShine** можно быстро изменить основной компонент на странице.

### IndexPage

Метод `getItemsComponent()` позволяет изменить основной компонент страницы индекса.

```php
getItemsComponent(iterable $items, Fields $fields)
```

- `$items` - значения полей,
- `$fields` - поля.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\TableBuilderContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\Table\TableBuilder;

class ArticleIndexPage extends IndexPage
{
    // ...

    protected function getItemsComponent(iterable $items, Fields $fields): ComponentContract
    {
        return TableBuilder::make(items: $items)
            ->name($this->getListComponentName())
            ->fields($fields)
            ->cast($this->getResource()->getCaster())
            ->withNotFound()
            ->when(
                ! is_null($head = $this->getResource()->getHeadRows()),
                fn (TableBuilderContract $table): TableBuilderContract => $table->headRows($head)
            )
            ->when(
                ! is_null($body = $this->getResource()->getRows()),
                fn (TableBuilderContract $table): TableBuilderContract => $table->rows($body)
            )
            ->when(
                ! is_null($foot = $this->getResource()->getFootRows()),
                fn (TableBuilderContract $table): TableBuilderContract => $table->footRows($foot)
            )
            ->when(
                ! is_null($this->getResource()->getTrAttributes()),
                fn (TableBuilderContract $table): TableBuilderContract => $table->trAttributes(
                    $this->getResource()->getTrAttributes()
                )
            )
            ->when(
                ! is_null($this->getResource()->getTdAttributes()),
                fn (TableBuilderContract $table): TableBuilderContract => $table->tdAttributes(
                    $this->getResource()->getTdAttributes()
                )
            )
            ->buttons($this->getResource()->getIndexButtons())
            ->clickAction($this->getResource()->getClickAction())
            ->when($this->getResource()->isAsync(), static function (TableBuilderContract $table): void {
                $table->async()->pushState();
            })
            ->when($this->getResource()->isStickyTable(), function (TableBuilderContract $table): void {
                $table->sticky();
            })
            ->when($this->getResource()->isColumnSelection(), function (TableBuilderContract $table): void {
                $table->columnSelection();
            });
    }
}
```

> [!NOTE]
> Пример страницы индекса с компонентом `CardsBuilder` в разделе [Рецепты](/docs/{{version}}/recipes/index-page-cards).

### DetailPage

Метод `getDetailComponent()` позволяет изменить основной компонент страницы детального просмотра.

```php
getDetailComponent(?DataWrapperContract $item, Fields $fields)
```

- `$item` - данные,
- `$fields` - поля.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Collections\Fields;
use MoonShine\UI\Components\Table\TableBuilder;

class ArticleDetailPage extends DetailPage
{
    // ...

    protected function getDetailComponent(?DataWrapperContract $item, Fields $fields): ComponentContract
    {
        return TableBuilder::make($fields)
            ->cast($this->getResource()->getCaster())
            ->items([$item])
            ->vertical()
            ->simple()
            ->preview();
    }
}
```
### FormPage

Метод `getFormComponent()` позволяет изменить основной компонент на странице с формой.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Collections\Fields;

getFormComponent(
  string $action,
  ?DataWrapperContract $item,
  Fields $fields,
  bool $isAsync = true,
)
```

- `$action` - endpoint,
- `$item` - данные,
- `$fields` - поля,
- `$isAsync` - асинхронный режим.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Collections\Fields;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Hidden; // [tl! collapse:end]

class ArticleFormPage extends FormPage
{
    // ...

    protected function getFormComponent(
        string $action,
        ?DataWrapperContract $item,
        Fields $fields,
        bool $isAsync = true,
    ): ComponentContract {
        $resource = $this->getResource();

        return FormBuilder::make($action)
            ->cast($this->getResource()->getCaster())
            ->fill($item)
            ->fields([
                ...$fields
                    ->when(
                        ! is_null($item),
                        static fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_method')->setValue('PUT')
                        )
                    )
                    ->when(
                        ! $resource->isItemExists() && ! $resource->isCreateInModal(),
                        static fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_force_redirect')->setValue(true)
                        )
                    )
                    ->toArray(),
            ])
            ->when(
                ! $resource->hasErrorsAbove(),
                fn (FormBuilderContract $form): FormBuilderContract => $form->errorsAbove($resource->hasErrorsAbove())
            )
            ->when(
                $isAsync,
                static fn (FormBuilderContract $formBuilder): FormBuilderContract => $formBuilder
                    ->async(events: array_filter([
                        $resource->getListEventName(
                            request()->input('_component_name', 'default'),
                            $isAsync && $resource->isItemExists() ? array_filter([
                                'page' => request()->input('page'),
                                'sort' => request()->input('sort'),
                            ]) : []
                        ),
                        ! $resource->isItemExists() && $resource->isCreateInModal()
                            ? AlpineJs::event(JsEvent::FORM_RESET, $resource->getUriKey())
                            : null,
                    ]))
            )
            ->when(
                $resource->isPrecognitive() || (moonshineRequest()->isFragmentLoad('crud-form') && ! $isAsync),
                static fn (FormBuilderContract $form): FormBuilderContract => $form->precognitive()
            )
            ->when(
                $resource->isSubmitShowWhen(),
                static fn (FormBuilderContract $form): FormBuilderContract => $form->submitShowWhenAttribute()
            )
            ->name($resource->getUriKey())
            ->submit(__('moonshine::ui.save'), ['class' => 'btn-primary btn-lg'])
            ->buttons($resource->getFormBuilderButtons());
    }
}
```

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
