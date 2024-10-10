# Страницы

- [Основы](#basics)
- [PageType](#page-type)
- [Добавление полей](#fields)
- [Основные компоненты](#components)
- [Слои на странице](#layers)

---

<a name="basics"></a>
## Основы

**MoonShine** предоставляет возможность настройки страниц crud *ModelResource*, для этого необходимо при создании ресурса через команду выбрать тип ресурса `Model resource with pages`.

Это создаст класс ресурса модели и дополнительные классы для страниц индекса, детального просмотра и формы. Классы страниц по умолчанию будут располагаться в директории `app/MoonShine/Pages`.

В созданном ресурсе модели страницы crud будут зарегистрированы в методе `pages()`.

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

Для указания типа страницы в **ModelResource** используется *enum класс* `PageType`.

Доступны следующие типы страниц:

- `INDEX` - страница индекса,
- `FORM` - страница формы,
- `DETAIL` - страница детального просмотра.

```php
use MoonShine\Enums\PageType;

//...

PageType::INDEX;
PageType::FORM;
PageType::DETAIL;
```

<a name="fields"></a>
## Добавление полей

[Поля](https://moonshine-laravel.com/docs/resource/fields/fields-index) в **MoonShine** используются не только для ввода данных, но и для их вывода.  
Метод `fields()` в классе страницы *crud* позволяет указать необходимые поля.

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
## Основные компоненты

В админ-панели **MoonShine** можно быстро изменить основной компонент на странице.

#### IndexPage

Метод `itemsComponent()` позволяет изменить основной компонент страницы индекса.

```php
itemsComponent(iterable $items, Fields $fields)
```

- `$items` - значения полей,
- `$fields` - поля.

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
> Пример страницы индекса с компонентом *CardsBuilder* в разделе [Рецепты](https://moonshine-laravel.com/docs/resource/recipes/recipes#index-page-cards)

#### DetailPage

Метод `detailComponent()` позволяет изменить основной компонент страницы детального просмотра.

```php
detailComponent(?Model $item, Fields $fields)
```

-`$item` - Eloquent Model
-`$fields` - поля

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

Метод `formComponent()` позволяет изменить основной компонент на странице с формой.

```php
formComponent(
    string $action,
    ?Model $item,
    Fields $fields,
    bool $isAsync = false,
): MoonShineRenderable
```

-`$action` - действие,
-`$item` - Eloquent Model,
-`$fields` - поля,
-`$isAsync` - асинхронный режим.

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
## Слои на странице

Для удобства все страницы *crud* разделены на три слоя, которые отвечают за отображение определенной области на странице.

- `TopLayer` - используется для отображения метрик на странице индекса и для дополнительных кнопок на странице редактирования
- `MainLayer` - этот слой используется для отображения основной информации с помощью [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder) и [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder)
- `BottomLayer` - используется для отображения дополнительной информации

Для настройки слоев используются соответствующие методы: `topLayer()`, `mainLayer()` и `bottomLayer()`. Методы должны возвращать массив [Компонентов](https://moonshine-laravel.com/docs/resource/page/page-class#components).

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
> Если вам нужно получить доступ к компонентам определенного слоя через ресурс или страницу, то используйте метод `getLayerComponents`.

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
> Если вам нужно добавить компонент для указанной страницы в нужный слой через ресурс, то используйте метод `onBoot` ресурса и `pushToLayer` страницы.

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
