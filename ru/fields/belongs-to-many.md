# BelongsToMany

- [Основы](#basics)
- [Заголовок столбца](#label-column)
- [Pivot](#pivot)
- [Создание объекта отношения](#creatable)
- [Выбор](#select)
- [Опции](#options)
- [Placeholder](#placeholder)
- [Дерево](#tree)
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

Поле *BelongsToMany* предназначено для работы с отношением того же имени в Laravel и включает все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Для создания этого поля используйте статический метод `make()`.

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
- `$resource` - ресурс модели, на которую ссылается связь.

> [!WARNING]
> Наличие ресурса модели, на которую ссылается связь, обязательно!
> Ресурс также необходимо зарегистрировать в сервис-провайдере _MoonShineServiceProvider_ в методе `resources()`. В противном случае будет ошибка 500 (Resource is required for MoonShine\Laravel\Fields\Relationships\BelongsToMany...).

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
```

![belongs_to_many](https://moonshine-laravel.com/screenshots/belongs_to_many.png)
![belongs_to_many_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_dark.png)

> [!NOTE]
> Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label`.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
```

Вы можете опустить `$resource`, если ресурс модели совпадает с названием связи.

```php
class CategoryResource extends ModelResource
{
    //...
}
//...
BelongsToMany::make('Categories', 'categories')
```

Если не указать $relationName, то имя связи будет определено автоматически на основе $label (по правилам camelCase).

```php
class CategoryResource extends ModelResource
{
    //...
}
//...
BelongsToMany::make('Categories')
```

> [!NOTE]
> По умолчанию для отображения значения используется поле в связанной таблице, которое указано свойством `$column` в ресурсе модели.
> Аргумент `$formatted` позволяет переопределить это.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CategoryResource extends ModelResource
{
    public string $column = 'title';
}
//..
BelongsToMany::make(
    'Categories',
    'Categories',
    formatted: 'name'
)
```

Если вам нужно указать более сложное значение для отображения, тогда в аргумент `$formatted` можно передать функцию обратного вызова.

```php
BelongsToMany::make(
    'Categories',
    'categories',
    fn($item) => "$item->id. $item->title"
)
```

<a name="label-column"></a>
## Заголовок столбца

По умолчанию заголовок столбца таблицы использует свойство `$title` ресурса модели отношения.
Метод `columnLabel()` позволяет переопределить заголовок.

```php
columnLabel(string $label)
```

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->columnLabel('Title')
```

<a name="pivot"></a>
## Pivot

Метод `fields()` используется для реализации полей *pivot* в отношении BelongsToMany.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Text;

BelongsToMany::make('Contacts', resource: ContactResource::class)
    ->fields([
        Text::make('Contact', 'text'),
    ])
```

![belongs_to_many_pivot](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot.png)

![belongs_to_many_pivot_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot_dark.png)

> [!WARNING]
> В отношении необходимо указать, какие поля *pivot* используются в промежуточной таблице!
> Подробнее в официальной документации [Laravel](https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns).

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
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable()
```

![belongs_to_many_creatable](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable.png)

![belongs_to_many_creatable_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable_dark.png)

Вы можете настроить кнопку создания, передав параметр *button* в метод.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable(
        button: ActionButton::make('Custom button', '')
    )
```

<a name="select"></a>
## Выбор

Поле *BelongsToMany* может быть отображено в виде выпадающего списка. Для этого необходимо использовать метод `selectMode()`.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->selectMode()
```

![belongs_to_many_select](https://moonshine-laravel.com/screenshots/belongs_to_many_select.png)

![belongs_to_many_select_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_select_dark.png)

<a name="options"></a>
## Опции

Все опции выбора доступны для изменения через *атрибуты data*:

```php
BelongsToMany::make('Countries', resource: ContactResource::class)
    ->selectMode()
    ->customAttributes([
        'data-max-item-count' => 2
    ])
```

> [!NOTE]
> Для получения более подробной информации, пожалуйста, обратитесь к [Choices](https://choices-js.github.io/Choices/).

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

Метод `tree()` позволяет отображать значения в виде дерева с чекбоксами, например, для категорий, которые имеют вложенность. В метод необходимо передать столбец в базе данных, по которому будет строиться дерево.

```php
tree(string $parentColumn)
```

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->tree('parent_id')
```

![belongs_to_many_tree](https://moonshine-laravel.com/screenshots/belongs_to_many_tree.png)

![belongs_to_many_tree_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_tree_dark.png)

<a name="preview"></a>
## Предпросмотр

По умолчанию в *preview* поле будет отображаться в виде таблицы.

![belongs_to_many_preview](https://moonshine-laravel.com/screenshots/belongs_to_many_preview.png)

![belongs_to_many_preview_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_dark.png)

Для изменения отображения в *preview* можно использовать следующие методы.

### onlyCount

Метод `onlyCount()` позволяет отображать только количество выбранных значений в *preview*.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->onlyCount()
```

![belongs_to_many_preview_count](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count.png)

![belongs_to_many_preview_count_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count_dark.png)

### inLine

Метод `inLine()` позволяет отображать значения поля в виде строки.

```php
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
```

Вы можете передать в метод необязательные параметры:

- `separator` - разделитель между элементами,
- `badge` - замыкание или булево значение, отвечающее за отображение элементов в виде бейджа,
- `$link` - замыкание, которое должно возвращать ссылки url или компоненты.

При передаче булевого значения true в параметр `badge` будет использоваться цвет Primary. Для изменения цвета отображаемого `badge` используйте замыкание и возвращайте компонент `Badge::make()`.

```php
use MoonShine\UI\Components\Link;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->inLine(
        separator: ' ',
        badge: fn($model, $value) => Badge::make((string) $value, 'primary'),
        link: fn(Property $property, $value, $field) => (string) Link::make(
            app(CategoryResource::class)->getDetailPageUrl($property->id),
            $value
        )
    )
```

![belongs_to_many_preview_in_line](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line.png)

![belongs_to_many_preview_in_line_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line_dark.png)

<a name="only-link"></a>
## Только ссылка

Метод `relatedLink()` позволит отобразить отношение в виде ссылки с количеством элементов. Ссылка будет вести на IndexPage дочернего ресурса из отношения HasMany, в котором буду показаны только данные элементы.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

Вы можете передать в метод необязательные параметры:
- `linkRelation` - ссылка на отношение,
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->relatedLink('category')
```

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
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
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Countries', 'countries', resource: ContactResource::class)
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
BelongsToMany::make('Countries', 'countries', resource: ContactResource::class)
    ->asyncSearch() 
```

> [!TIP]
> Поиск будет осуществляться по полю отношения ресурса `column`. По умолчанию `column=id`

Вы можете передать параметры в метод `asyncSearch()`:
- `$column` - поле, по которому осуществляется поиск,
- `$searchQuery` - функция обратного вызова для фильтрации значений,
- `$formatted` - функция обратного вызова для настройки вывода,
- `$associatedWith` - поле, с которым установить связь,
- `$limit` - количество элементов в результатах поиска,
- `$url` - url для обработки асинхронного запроса,

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Countries', 'countries', resource: ContactResource::class)
    ->asyncSearch(
        'title',
        10,
        searchQuery: function (Builder $query, Request $request, Field $field) {
            return $query->where('id', '!=', 2);
        },
        formatted: function ($country, Field $field) {
            return $country->id . ' | ' . $country->title;
        },
        'https://moonshine-laravel.com/async'
    )
```

> [!TIP]
> При построении запроса в `searchQuery()` вы можете использовать текущие значения формы. Для этого нужно передать `Request` в функцию обратного вызова.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id'),
BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->asyncSearch(
        'title',
        searchQuery: function (Builder $query, Request $request, Field $field): Builder {
            return $query->where('country_id', $request->get('country_id'));
        }
    )
```

> [!TIP]
> Запросы должны быть настроены с использованием метода `asyncSearch()`. Не используйте `valuesQuery()`!

<a name="associated"></a>
## Связанные поля

Для установления связи значений выбора между полями можно использовать метод `associatedWith()`.

```php
associatedWith(string $column, ?Closure $searchQuery = null)
```

- `$column` - поле, с которым устанавливается связь,
- `searchQuery` - функция обратного вызова для фильтрации значений.

```php
BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->associatedWith('country_id')
```

> [TIP]
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
BelongsToMany::make(Countries, resource: ContactResource::class)
    ->withImage('thumb', 'public', 'countries')->selectMode()
```

![with_image](https://moonshine-laravel.com/screenshots/belongs_to_image.png)

![belongs_to_image_dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="buttons"></a>
## Кнопки

Метод `buttons()` позволяет добавить дополнительные кнопки к полю *BelongsToMany*.

```php
buttons(array $buttons)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->buttons([
        ActionButton::make('Check all', '')
            ->onClick(fn() => 'checkAll', 'prevent'),

        ActionButton::make('Uncheck all', '')
            ->onClick(fn() => 'uncheckAll', 'prevent')
    ])
```

### withCheckAll

Метод `withCheckAll()` позволяет добавить кнопку checkAll к полю *BelongsToMany*, аналогично предыдущему примеру.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->withCheckAll()
```
