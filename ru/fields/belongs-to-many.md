# BelongsToMany

- [Основы](#basics)
- [Заголовок столбца](#label-column)
- [Pivot](#pivot)
- [Дедупликация](#deduplication)
- [Создание объекта отношения](#creatable)
- [Выбор](#select)
- [Опции](#options)
- [Placeholder](#placeholder)
- [Дерево](#tree)
- [Горизонтальный режим](#horizontal)
- [Предпросмотр](#preview)
- [Только ссылка](#only-link)
- [Запрос для значений](#values-query)
- [Асинхронный поиск](#async-search)
- [Связанные поля](#associated)
- [Значения с изображением](#with-image)
- [Кнопки](#buttons)

---

<a name="basics"></a>
## Основы

Поле `BelongsToMany` предназначено для работы с одноименной связью в **Laravel** и включает все [Базовые методы](/docs/{{version}}/fields/basic-methods).

```php
BelongsToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - метка, заголовок поля,
- `$relationName` - название связи,
- `$formatted` - замыкание или поле в связанной таблице для отображения значений,
- `$resource` - `ModelResource`, на которую ссылается связь.

> [!WARNING]
> Наличие `ModelResource`, на который ссылается отношение, обязательно.
> Ресурс также необходимо [зарегистрировать](/docs/{{version}}/model-resource/index#declaring-in-the-system) в сервис-провайдере `MoonShineServiceProvider` в методе `$core->resources()`.
> В противном случае будет ошибка 500.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    resource: CategoryResource::class
)
```

![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png#light)
![belongs_to_many_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_dark.png#dark)

Вы можете опустить `$resource`, если `ModelResource` совпадает с названием связи.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', 'categories')
```

Если не указать `$relationName`, то имя связи будет определено автоматически на основе `$label` (по правилам camelCase).

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories')
```

> [!NOTE]
> По умолчанию для отображения значения используется поле в связанной таблице, которое указано свойством `$column` в ресурсе модели.
> Аргумент `$formatted` позволяет переопределить это.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    formatted: 'name'
)
```

Если вам нужно указать более сложное значение для отображения, тогда в аргумент `$formatted` можно передать функцию обратного вызова.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    fn($item) => "$item->id. $item->title"
)
```

<a name="label-column"></a>
## Заголовок столбца

По умолчанию заголовок столбца таблицы использует свойство `$title`, указанное в `ModelResource` отношения.
Метод `columnLabel()` позволяет переопределить заголовок.

```php
columnLabel(string $label)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->columnLabel('Title')
```

<a name="pivot"></a>
## Pivot

Метод `fields()` используется для реализации полей *pivot* в отношении `BelongsToMany`.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\ContactResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Text;

BelongsToMany::make(
    'Contacts',
    resource: ContactResource::class
)
->fields([
    Text::make('Contact', 'text'),
])
```

![belongs_to_many_pivot](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_pivot.png#light)
![belongs_to_many_pivot_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_pivot_dark.png#dark)

> [!WARNING]
> В отношении необходимо указать, какие поля *pivot* используются в промежуточной таблице!
> Подробнее в официальной документации [Laravel](https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns).

<a name="deduplication"></a>
## Дедупликация

По умолчанию `BelongsToMany` исключает дубли по ключу модели, чтобы один и тот же объект связи нельзя было выбрать несколько раз, даже если у него разные значения *pivot*.
Для сценариев, когда требуется сохранить несколько строк с одинаковым ключом (например, одинаковая категория, но разные данные в промежуточной таблице), отключите проверку:

```php
deduplication(
    Closure|bool|null $condition = null
)
```

```php
BelongsToMany::make('Categories')
    ->fields([
        Text::make('pivot_field'),
    ])
    ->deduplication(false)
```

- Метод принимает `bool` или `Closure`, что позволяет включать/выключать проверку динамически.
- При отключенной дедупликации каждая строка сохраняется отдельно, а данные *pivot* добавляются в порядке их заполнения.

<a name="creatable"></a>
## Создание объекта отношения

Метод `creatable()` позволяет создать новый объект отношения через модальное окно.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable()
```

![belongs_to_many_creatable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_creatable.png#light)
![belongs_to_many_creatable_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_creatable_dark.png#dark)

Вы можете настроить кнопку создания, передав параметр *button* в метод.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\ActionButton;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable(
        button: ActionButton::make('Custom button', '')
    )
```

<a name="select"></a>
## Выбор

Поле `BelongsToMany` может быть отображено в виде выпадающего списка.
Для этого необходимо использовать метод `selectMode()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->selectMode()
```

![belongs_to_many_select](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_select.png#light)
![belongs_to_many_select_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_select_dark.png#dark)

<a name="options"></a>
## Опции

Все опции выбора доступны для изменения через *атрибуты data*:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->selectMode()
    ->customAttributes([
        'data-search-enabled' => true,
    ])
```

> [!NOTE]
> Для получения более подробной информации, пожалуйста, обратитесь к [документации Tom Select](https://tom-select.js.org/docs/).

<a name="placeholder"></a>
## Placeholder

Метод `placeholder()` позволяет установить атрибут *placeholder* на поле.

```php
placeholder(string $value)
```

```php
BelongsToMany::make('Countries', 'countries')
    ->nullable()
    ->placeholder('Countries')
```

> [!NOTE]
> Метод `placeholder()` используется только если поле отображается в виде выпадающего списка `selectMode()`!

<a name="tree"></a>
## Дерево

Метод `tree()` позволяет отображать значения в виде дерева с чекбоксами, например, для категорий, которые имеют вложенность.
В метод необходимо передать столбец в базе данных, по которому будет строиться дерево.

```php
tree(string $parentColumn)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->tree('parent_id')
```

![belongs_to_many_tree](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_tree.png#light)
![belongs_to_many_tree_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_tree_dark.png#dark)

<a name="horizontal"></a>
## Горизонтальный режим

Метод `horizontalMode()` позволяет отображать значения в виде горизонтального списка.

```php
horizontalMode(
    Closure|bool|null $condition = null,
    string $minColWidth = '200px',
    string $maxColWidth = '1fr'
)
```

- `$condition` - (опционально) условие для отображения поля в горизонтальном режиме,
- `$minColWidth` - (опционально) минимальная ширина колонки,
- `$maxColWidth` - (опционально) максимальная ширина колонки.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->horizontalMode(true, minColWidth: '100px', maxColWidth: '33%')
```

![belongs_to_many_horizontal](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_horizontal.png#light)
![belongs_to_many_horizontal_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_horizontal_dark.png#dark)

<a name="preview"></a>
## Предпросмотр

По умолчанию в *preview* поле будет отображаться в виде таблицы.

![belongs_to_many_preview](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview.png#light)
![belongs_to_many_preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_dark.png#dark)

Для изменения отображения в *preview* можно использовать следующие методы.

### onlyCount

Метод `onlyCount()` позволяет отображать только количество выбранных значений в *preview*.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->onlyCount()
```

![belongs_to_many_preview_count](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_count.png#light)
![belongs_to_many_preview_count_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_count_dark.png#dark)

### inLine

Метод `inLine()` позволяет отображать значения поля в виде строки.

```php
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
```

Вы можете передать в метод необязательные параметры:

- `separator` - разделитель между элементами,
- `badge` - замыкание или булево значение, отвечающее за отображение элементов в виде бейджа,
- `$link` - замыкание, которое должно возвращать ссылки url или компонент Link.

При передаче булевого значения true в параметр `badge` будет использоваться цвет Primary.
Для изменения цвета отображаемого `badge` используйте замыкание и возвращайте компонент `Badge::make()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Link;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->inLine(
        separator: ' ',
        badge: fn($model, $value) => Badge::make((string) $value, 'primary'),
        link: fn(Property $property, $value, $field): string|Link => Link::make(
            app(CategoryResource::class)->getDetailPageUrl($property->id),
            $value
        )
    )
```

![belongs_to_many_preview_in_line](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_in_line.png#light)
![belongs_to_many_preview_in_line_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_in_line_dark.png#dark)

<a name="only-link"></a>
## Только ссылка

Метод `relatedLink()` позволит отобразить отношение в виде ссылки с количеством элементов.
Ссылка будет вести на IndexPage дочернего ресурса из отношения HasMany, в котором буду показаны только данные элементы.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

Вы можете передать в метод необязательные параметры:

- `linkRelation` - ссылка на отношение,
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->relatedLink('category')
```

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->relatedLink(condition: function (int $count, Field $field): bool {
        return $count > 10;
    })
```

<a name="values-query"></a>
## Запрос для значений

Метод `valuesQuery()` позволяет изменить запрос для получения значений.

```php
valuesQuery(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CategoryResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
    ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
```

<a name="async-search"></a>
## Асинхронный поиск

Для реализации асинхронного поиска значений используйте метод `asyncSearch()`.

```php
asyncSearch(
    string $column = null,
    ?Closure $searchQuery = null,
    ?Closure $formatted = null,
    ?string $associatedWith = null,
    int $limit = 15,
    ?string $url = null,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
    ->asyncSearch()
```

> [!NOTE]
> Поиск будет осуществляться по полю отношения ресурса `column`.
> По умолчанию `column=id`.

Вы можете передать параметры в метод `asyncSearch()`:

- `$column` - поле, по которому осуществляется поиск,
- `$searchQuery` - функция обратного вызова для фильтрации значений,
- `$formatted` - функция обратного вызова для настройки вывода,
- `$associatedWith` - поле, с которым установить связь,
- `$limit` - количество элементов в результатах поиска,
- `$url` - url для обработки асинхронного запроса.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use App\MoonShine\Resources\CountryResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Countries', 'countries', resource: CountryResource::class)
    ->asyncSearch(
        'title',
        10,
        searchQuery: function (Builder $query, string $term, Request $request, Field $field) {
            return $query->where('id', '!=', 2);
        },
        formatted: function ($country, Field $field) {
            return $country->id . ' | ' . $country->title;
        },
        'https://moonshine-laravel.com/async'
    )
```

> [!TIP]
> При построении запроса в `searchQuery()` вы можете использовать текущие значения формы.
> Для этого нужно передать `Request` в функцию обратного вызова.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
use App\MoonShine\Resources\CityResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id'),

BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->asyncSearch(
        'title',
        searchQuery: function (Builder $query, string $term, Request $request, Field $field): Builder {
            return $query->where('country_id', $request->get('country_id'));
        }
    )
```

> [!TIP]
> Запросы должны быть настроены с использованием метода `asyncSearch()`.
> Не используйте `valuesQuery()`!

<a name="associated"></a>
## Связанные поля

Для установления связи значений выбора между полями можно использовать метод `associatedWith()`.

```php
associatedWith(string $column, ?Closure $searchQuery = null)
```

- `$column` - поле, с которым устанавливается связь,
- `searchQuery` - функция обратного вызова для фильтрации значений.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CityResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->associatedWith('country_id')
```

> [!TIP]
> Для более сложной настройки вы можете использовать `asyncSearch()`.

<a name="with-image"></a>
## Значения с изображением

Метод `withImage()` позволяет добавить изображение к значению.

```php
withImage(
    string $column,
    string $disk = 'public',
    string $dir = ''
)
```

- `$column` - поле с изображением,
- `$disk` - диск файловой системы,
- `$dir` - директория относительно корня диска.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CityResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

BelongsToMany::make('Cities', resource: CityResource::class)
    ->withImage('thumb', 'public', 'countries')
    ->selectMode()
```

![with_image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image.png#light)
![belongs_to_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image_dark.png#dark)

<a name="buttons"></a>
## Кнопки

Метод `buttons()` позволяет добавить дополнительные кнопки к полю `BelongsToMany`.

```php
buttons(array $buttons)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\ActionButton;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->buttons([
        ActionButton::make('Check all', '')
            ->onClick(fn() => 'checkAll', 'prevent'),

        ActionButton::make('Uncheck all', '')
            ->onClick(fn() => 'uncheckAll', 'prevent')
    ])
```

### withCheckAll

Метод `withCheckAll()` позволяет добавить кнопку checkAll к полю `BelongsToMany`, аналогично предыдущему примеру.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->withCheckAll()
```
