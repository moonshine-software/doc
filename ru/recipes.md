# Рецепты

- [Форма и события](#form-with-events)
- [Компонент представления с AlpineJs](#make-component)
- [Подключение сборки Vite](#assets-vite)
- [Пользовательские кнопки](#custom-buttons)
- [HasOne через поле Template](#hasone-through-template)
- [Изменение хлебных крошек из ресурса](#custom-breadcrumbs)
- [Индексная страница через CardsBuilder](#index-page-cards)
- [Сортировка для CardsBuilder](#sorting-for-cards-builder)
- [updateOnPreview для полей pivot](#update-on-preview-pivot)
- [ID родителя в HasMany](#hasmany-parent-id)
- [Количество символов TinyMce в предпросмотре](#tinymce-limit-preview)
- [Изменение логики поля](#change-field-logic)
- [Сохранение изображений в связанной таблице](#images-in-linked-table)
- [Пользовательский фильтр выбора](#custom-select-filter)
- [Асинхронные метрики](#async-metrics)

---

<a name="form-with-events"></a>
## Форма и события

При успешном запросе форма обновляет таблицу и сбрасывает значения.

```php
Block::make([
    FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(asyncEvents: ['table-updated-main-table','form-reset-main-form'])
]),

TableBuilder::make()
    ->fields([
        ID::make(),
        Text::make('Title'),
        Textarea::make('Body'),
    ])
    ->creatable()
    ->items(Post::query()->paginate())
    ->name('main-table')
    ->async()

```

Давайте также рассмотрим, как добавить свои собственные события

```php
<div x-data=""
     @my-event.window="alert()"
>
</div>
```

```php
<div x-data="my"
     @my-event.window="asyncRequest"
>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("my", () => ({
            init() {

            },
            asyncRequest() {
                this.$event.preventDefault()

                // this.$el
                // this.$root
            }
        }))
    })
</script>
```

```php
FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(asyncEvents: ['my-event'])
```

<a name="make-component"></a>
## Компонент представления с AlpineJs

Мы также рекомендуем вам ознакомиться с AlpineJs и использовать всю мощь этого js-фреймворка.

Вы можете использовать его реактивность, давайте посмотрим, как удобно создать компонент.

```php
<div x-data="myComponent">
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("myComponent", () => ({
            init() {

            },
        }))
    })
</script>
```

<a name="assets-vite"></a>
## Подключение сборки Vite

Давайте добавим одну скомпилированную с помощью Vite сборку.

```php
public function indexButtons(): array
{
    $resource = new CommentResource();
    return [
        ActionButton::make('Custom button', static fn ($data): string => to_page(
            page: $resource->formPage(),
            resource: $resource,
            params: ['resourceItem' => $data->getKey()]
        ))
    ];
}
```

<a name="custom-buttons"></a>
## Пользовательские кнопки

Давайте добавим пользовательские кнопки в индексную таблицу.

```php
public function indexButtons(): array
{
    $resource = new CommentResource();
    return [
        ActionButton::make('Custom button', static fn ($data): string => to_page(
            page: $resource->formPage(),
            resource: $resource,
            params: ['resourceItem' => $data->getKey()]
        ))
    ];
}
```

<a name="hasone-through-template"></a>
## HasOne через поле Template

Пример реализации отношения _HasOne_ через поле `Template`.

```php
use MoonShine\Fields\Template;

//...

public function fields(): array
{
    return [
        Template::make('Comment')
          ->changeFill(fn (Article $data) => $data->comment)
          ->changePreview(fn($data) => $data?->id ?? '-')
          ->fields((new CommentResource())->getFormFields())
          ->changeRender(function (?Comment $data, Template $field) {
              $fields = $field->preparedFields();
              $fields->fill($data?->toArray() ?? [], $data ?? new Comment());

              return Components::make($fields);
          })
          ->onAfterApply(function (Article $item, array $value) {
              $item->comment()->updateOrCreate([
                  'id' => $value['id']
              ], $value);

              return $item;
          })
    ];
}

//...
```

<a name="custom-breadcrumbs"></a>
## Изменение хлебных крошек из ресурса

Вы можете изменить хлебные крошки страницы непосредственно из ресурса.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    protected function onBoot(): void
    {
        $this->formPage()
            ->setBreadcrumbs([
                '#' => $this->title()
            ]);
    }

    //...
}
```

<a name="index-page-cards"></a>
## Индексная страница через CardsBuilder

Давайте изменим отображение элементов на индексной странице через компонент *CardsBuilder*.

```php
class MoonShineUserIndexPage extends IndexPage
{
    public function listComponentName(): string
    {
        return 'index-cards';
    }

    public function listEventName(): string
    {
        return 'cards-updated';
    }

    protected function itemsComponent(iterable $items, Fields $fields): MoonShineRenderable
    {
        return CardsBuilder::make($items, $fields)
            ->cast($this->getResource()->getModelCast())
            ->name($this->listComponentName())
            ->async()
            ->overlay()
            ->title('email')
            ->subtitle('name')
            ->url(fn ($user) => $this->getResource()->formPageUrl($user))
            ->thumbnail(fn ($user) => asset($user->avatar))
            ->buttons($this->getResource()->getIndexItemButtons());
    }
}
```

<a name="sorting-for-cards-builder"></a>
## Сортировка для CardsBuilder

Давайте создадим сортировку для компонента CardsBuilder:

```php
Select::make('Sorts')->options([
    'created_at' => 'Date',
    'id' => 'ID',
])
    ->onChangeMethod('reSort', events: ['cards-updated-cards'])
    ->setValue(session('sort_column') ?: 'created_at'),


CardsBuilder::make(
    items: Article::query()->with('author')
        ->when(
            session('sort_column'),
            fn($q) => $q->orderBy(session('sort_column'), session('sort_direction', 'asc')),
            fn($q) => $q->latest()
        )
        ->paginate()
)
    ->name('cards')
    ->async()
    ->cast(ModelCast::make(Article::class))
    ->title('title')
    ->url(fn($data) => (new ArticleResource())->formPageUrl($data))
    ->overlay()
    ->columnSpan(4) ,

// ...

public function reSort(MoonShineRequest $request): void
{
    session()->put('sort_column', $request->get('value'));
    session()->put('sort_direction', 'ASC');
}
```

<a name="update-on-preview-pivot"></a>
## updateOnPreview для полей pivot

Реализация через _asyncMethod_ метода для изменения pivot поля на индексной странице:

```php
public function fields(): array
{
    return [
        Grid::make([
            Column::make([
                ID::make()->sortable(),
                Text::make('Team title')->required(),
                Number::make('Team number'),
                BelongsTo::make('Tournament', resource: new TournamentResource())
                    ->searchable(),
            ]),
            Column::make([
                BelongsToMany::make('Users', resource: new UserResource())
                    ->fields([
                        Switcher::make('Approved')
                            ->updateOnPreview(MoonShineRouter::asyncMethodClosure(
                                'updatePivot',
                                params: fn($data) => ['parent' => $data->pivot->tournamen_team_id]
                            )),
                    ])
                    ->searchable(),
            ])
        ])
    ];
}

public function updatePivot(MoonShineRequest $request): MoonShineJsonResponse
{
    $item = TournamentTeam::query()
        ->findOrFail($request->get('parent'));

    $column = (string) $request->str('field')->remove('pivot.');

    $item->users()->updateExistingPivot($request->get('resourceItem'), [
        $column => $request->get('value'),
    ]);

    return MoonShineJsonResponse::make()
        ->toast('Success');
}
```

<a name="hasmany-parent-id"></a>
## ID родителя в HasMany

Связь _HasMany_ хранит данные файлов, которые нужно сохранить в директории по id родителя.

```php
use App\Models\PostImage;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    public string $model = PostImage::class;

    protected function getParentResourceClassName(): string
    {
        return PostResource::class;
    }

    protected function getParentRelationName(): string
    {
        return 'post';
    }

    public function fields(): array
    {
        return [
            ID::make(),
            Image::make('Path')
                ->when(
                    $parentId = $this->getParentId(),
                    fn(Image $image) => $image->dir('post_images/'.$parentId)
                )
            ,
            BelongsTo::make('Post', 'post', resource: new PostResource())
        ];
    }

    //...
}
```

<a name="tinymce-limit-preview"></a>
## Количество символов TinyMce в предпросмотре

Иногда необходимо отобразить поле _TinyMce_ в предпросмотре с ограниченным количеством символов. Для этого можно использовать метод `changePreview()`.

```php
public function fields(): array
{
    return [
        TinyMce::make('Description')
            ->changePreview(fn(string $text) => str($text)->stripTags()->limit(10))
    ];
}

//...
}
```

<a name="change-field-logic"></a>
## Изменение логики поведения поля Image для сохранения путей к изображениям в отдельной таблице базы данных

- Для решения этой задачи необходимо заблокировать метод `onApply()` и перенести логику в `onAfterApply()`. Это позволит получить родительскую модель на странице создания. У нас будет доступ к модели, и мы сможем работать с ее отношениями.
- Метод `onAfterApply()` сохраняет и получает старые и текущие значения, а также очищает удаленные файлы.
- После удаления родительской записи метод `onAfterDestroy()` удаляет загруженные файлы.

```php
use MoonShine\Fields\Image;

//...

Image::make('Images', 'images')
    ->multiple()
    ->removable()
    ->changeFill(function (Model $data, Image $field) {
        // return $data->images->pluck('file');
        // или raw
        return DB::table('images')->pluck('file');
    })
    ->onApply(function (Model $data) {
        // блокируем onApply
        return $data;
    })
    ->onAfterApply(function (Model $data, false|array $values, Image $field) {
        // $field->getRemainingValues(); значения, которые остались в форме с учетом удалений
        // $field->toValue(); текущие изображения
        // $field->toValue()->diff($field->getRemainingValues()) удаленные изображения

        if($values !== false) {
            foreach ($values as $value) {
                DB::table('images')->insert([
                    'file' => $field->store($value),
                ]);
            }
        }

        foreach ($field->toValue()->diff($field->getRemainingValues()) as $removed) {
            DB::table('images')->where('file', $removed)->delete();
            Storage::disk('public')->delete($removed);
        }

        // или $field->removeExcludedFiles();

        return $data;
    })
    ->onAfterDestroy(function (Model $data, mixed $values, Image $field) {
        foreach ($values as $value) {
            Storage::disk('public')->delete($value);
        }

        return $data;
    })

//...
```

> [!WARNING]
> В коде закомментирован вариант с отношением и приведен пример нативного получения путей к файлам из другой таблицы.

<a name="images-in-linked-table"></a>
## Сохранение изображений в связанной таблице

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use MoonShine\Fields\Image;

// ...

Image::make('Images', 'images')
  ->multiple()
  ->removable()
  ->changeFill(function (Model $data, Image $field) {
    // return $data->images->pluck('file');
    // или raw
    return DB::table('images')->pluck('file');
  })
  ->onApply(function (Model $data) {
      // блокируем onApply
      return $data;
  })
  ->onAfterApply(function (Model $data, false|array $values, Image $field) {
    // $field->getRemainingValues(); значения, которые остались в форме с учетом удалений
    // $field->toValue(); текущие изображения
    // $field->toValue()->diff($field->getRemainingValues()) удаленные изображения

    if($values !== false) {
        foreach ($values as $value) {
            DB::table('images')->insert([
                'file' => $field->store($value),
            ]);
        }
    }

    foreach ($field->toValue()->diff($field->getRemainingValues()) as $removed) {
        DB::table('images')->where('file', $removed)->delete();
        Storage::disk('public')->delete($removed);
    }

    // или $field->removeExcludedFiles();

    return $data;
  })
  ->onAfterDestroy(function (Model $data, mixed $values, Image $field) {
    foreach ($values as $value) {
        Storage::disk('public')->delete($value);
    }

    return $data;
  })
```

<a name="custom-select-filter"></a>
## Пользовательский фильтр выбора

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function filters(): array
    {
        return [
            Select::make('Activity status', 'active')
                ->options([
                    '0' => 'Only NOT active',
                    '1' => 'Only active',
                ])
                ->nullable()
                ->onApply(fn(Builder $query, $value) => $query->where('active', $value)),
        ];
    }

    //...
}
```

<a name="async-metrics"></a>
## Асинхронные метрики

Метрики с параметрами формы

```php
$startDate = request()->date('_form.start_date');
$endDate = request()->date('_form.end_date');

FormBuilder::make()
    ->dispatchEvent(AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'metrics'))
    ->fields([
        Flex::make([
            Date::make('Start date'),
            Date::make('End date'),
        ]),
    ]),

Fragment::make([
    FlexibleRender::make("$startDate - $endDate"),

    LineChartMetric::make('Orders')
        ->line([
            'Profit' => Order::query()
                ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('sum', 'date')
                ->toArray(),
        ])
        ->line([
            'Avg' => Order::query()
                ->selectRaw('AVG(price) as average, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('avg', 'date')
                ->toArray(),
        ], '#EC4176'),
])->name('metrics'),
```
