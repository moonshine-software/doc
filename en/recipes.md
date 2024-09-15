https://moonshine-laravel.com/docs/resource/recipes/recipes?change-moonshine-locale=en

------
# Recipes
 
 - [Form and events](#form-with-events)
 - [View component with AlpineJs](#make-component)
 - [Vite build connection](#assets-vite)
 - [Custom buttons](#custom-buttons)
 - [HasOne through the Template field](#hasone-through-template)
 - [Changing breadcrumbs from a resource](#custom-breadcrumbs)
 - [Index page via CardsBuilder](#index-page-cards)
 - [Sorting for CardsBuilder](#sorting-for-cards-builder)
 - [updateOnPreview for pivot fields](#update-on-preview-pivot)
 - [Parent ID in HasMany](#hasmany-parent-id)
 - [TinyMce number of characters in preview](#tinymce-limit-preview)
 - [Changing field logic](#change-field-logic)
 - [Saving images in a linked table](#images-in-linked-table)
 - [Custom select filter](#custom-select-filter)
 - [Async metrics](#async-metrics)

<a name="form-with-events"></a>
## Form and events

Upon a successful request, the form updates the table and resets the values.

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

Let's also look at how to add your own events

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
## View component with AlpineJs

We also recommend that you familiarize yourself with AlpineJs and use the full power of this js framework.

You can use its reactivity, let's see how to conveniently create a component.

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
## Vite build connection

Let's add one compiled using Vite build.

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
## Custom buttons

Let's add custom buttons to the index table.

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
## HasOne through the Template field

An example of implementing the _HasOne_ relationship through the `Template` field.

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
## Changing breadcrumbs from a resource

You can change page breadcrumbs directly from the resource.

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
## Index page via CardsBuilder

Let's change the display of elements on the index page through the *CardsBuilder* component.

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
## Sorting for CardsBuilder

Let's create a sorting for the CardsBuilder component:

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
## updateOnPreview for pivot fields

Implementation via _asyncMethod_ of the method for changing the pivot field on the index page:

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
## Parent ID in HasMany

The _HasMany_ connection stores file data that needs to be saved in a directory by parent id.

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
## TinyMce number of characters in preview

Sometimes it is necessary to display the _TinyMce_ field in the preview with a limited number of characters. To do this, you can use the `changePreview()` method.

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
## Changing the behavior logic of the Image field to save paths to images in a separate database table

- To solve this problem, you need to block the `onApply()` method and moved the logic to `onAfterApply()`. This will get the parent model on the creation page. We will have access to the model and we will be able to work with its relationships.
- The `onAfterApply()` method stores and retrieves old and current values, also cleaning deleted files.
- After deleting the parent record, the `onAfterDestroy()` method deletes the downloaded files.

```php
use MoonShine\Fields\Image;

//...

Image::make('Images', 'images')
    ->multiple()
    ->removable()
    ->changeFill(function (Model $data, Image $field) {
        // return $data->images->pluck('file');
        // or raw
        return DB::table('images')->pluck('file');
    })
    ->onApply(function (Model $data) {
        // block onApply
        return $data;
    })
    ->onAfterApply(function (Model $data, false|array $values, Image $field) {
        // $field->getRemainingValues(); values that remained in the form taking into account deletions
        // $field->toValue(); current images
        // $field->toValue()->diff($field->getRemainingValues()) deleted images

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

        // or $field->removeExcludedFiles();

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
> The code comments out the relation option and provides an example of natively obtaining file paths from another table.

<a name="images-in-linked-table"></a>
## Saving images in a linked table

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
    // or raw
    return DB::table('images')->pluck('file');
  })
  ->onApply(function (Model $data) {
      // block onApply
      return $data;
  })
  ->onAfterApply(function (Model $data, false|array $values, Image $field) {
    // $field->getRemainingValues(); values that remained in the form taking into account deletions
    // $field->toValue(); current images
    // $field->toValue()->diff($field->getRemainingValues()) deleted images

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

    // or $field->removeExcludedFiles();

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
## Custom select filter

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
## Async metrics

Metrics with form parameters

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
                -> pluck('avg', 'date')
                ->toArray(),
        ], '#EC4176'),
])->name('metrics'),
```
