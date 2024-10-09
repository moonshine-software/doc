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
### Основы

Поле *BelongsToMany* предназначено для работы с отношением того же имени в Laravel и включает все базовые методы.

Для создания этого поля используйте статический метод `make()`.

```php
BelongsToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
```

- `$label` - метка, заголовок поля,
- `$relationName` - имя отношения,
- `$formatted` - замыкание или поле в связанной таблице для отображения значений,
- `$resource` - ресурс модели, на который ссылается отношение.

> [!WARNING]
> Наличие ресурса модели, на который ссылается отношение, обязательно! Ресурс также необходимо [зарегистрировать](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) в сервис-провайдере *MoonShineServiceProvider* в методе `menu()` или `resources()`. В противном случае будет ошибка 404.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', resource: new CategoryResource())
    ];
}
```

![belongs_to_many](https://moonshine-laravel.com/screenshots/belongs_to_many.png)
![belongs_to_many_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_dark.png)

> [!NOTE]
> Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label`.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
    ];
}

//...
```

> [!NOTE]
> Вы можете опустить `$resource`, если ресурс модели соответствует имени отношения.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories')
    ];
}

//...
```

> [!NOTE]
> По умолчанию для отображения значения используется поле в связанной таблице, которое указано свойством `$column` в ресурсе модели.
> Аргумент `$formatted` позволяет переопределить это.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CategoryResource extends ModelResource
{
    //...

    public string $column = 'title';

    //...
}
```

Если вам нужно указать более сложное значение для отображения, тогда в аргумент `$formatted` можно передать функцию обратного вызова.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make(
            'Categories',
            'categories',
            fn($item) => "$item->id. $item->title"
        )
    ];
}

//...
```

<a name="label-column"></a>
### Заголовок столбца

По умолчанию заголовок столбца таблицы использует свойство `$title` ресурса модели отношения.
Метод `columnLabel()` позволяет переопределить заголовок.

```php
columnLabel(string $label)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->columnLabel('Title')
    ];
}

//...
```

<a name="pivot"></a>
### Pivot

Метод `fields()` используется для реализации полей *pivot* в отношении BelongsToMany.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', resource: new ContactResource())
            ->fields([
                Text::make('Contact', 'text'),
            ])
    ];
}

//...
```

![belongs_to_many_pivot](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot.png)
![belongs_to_many_pivot_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot_dark.png)

> [!WARNING]
> В отношении необходимо указать, какие поля *pivot* используются в промежуточной таблице!
> Подробнее в официальной документации [Laravel](https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns).

<a name="creatable"></a>
### Создание объекта отношения

Метод `creatable()` позволяет создать новый объект отношения через модальное окно.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->creatable()
    ];
}

//...
```

![belongs_to_many_creatable](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable.png)
![belongs_to_many_creatable_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable_dark.png)

Вы можете настроить кнопку создания, передав параметр *button* в метод.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            )
    ];
}

//...
```

<a name="select"></a>
### Выбор

Поле *BelongsToMany* может быть отображено в виде выпадающего списка. Для этого необходимо использовать метод `selectMode()`.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->selectMode()
    ];
}

//...
```

![belongs_to_many_select](https://moonshine-laravel.com/screenshots/belongs_to_many_select.png)
![belongs_to_many_select_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_select_dark.png)

<a name="options"></a>
### Опции

Все опции выбора доступны для изменения через *атрибуты data*:

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', resource: new CountryResource())
            ->selectMode()
            ->customAttributes([
                'data-max-item-count' => 2
            ])
    ];
}
```

> [!NOTE]
> Для получения более подробной информации, пожалуйста, обратитесь к [Choices](https://choices-js.github.io/Choices/).

<a name="placeholder"></a>
### Placeholder

Метод `placeholder()` позволяет установить атрибут *placeholder* на поле.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries')
            ->nullable()
            ->placeholder('Countries')
    ];
}

//...
```

> [!NOTE]
> Метод `placeholder()` используется только если поле отображается в виде выпадающего списка `selectMode()`!

<a name="tree"></a>
### Дерево

Метод `tree()` позволяет отображать значения в виде дерева с чекбоксами, например, для категорий, которые имеют вложенность. В метод необходимо передать столбец в базе данных, по которому будет строиться дерево.

```php
tree(string $parentColumn)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->tree('parent_id')
    ];
}

//...
```

![belongs_to_many_tree](https://moonshine-laravel.com/screenshots/belongs_to_many_tree.png)
![belongs_to_many_tree_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_tree_dark.png)

<a name="preview"></a>
### Предпросмотр

По умолчанию в *preview* поле будет отображаться в виде таблицы.

![belongs_to_many_preview](https://moonshine-laravel.com/screenshots/belongs_to_many_preview.png)
![belongs_to_many_preview_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_dark.png)

Для изменения отображения в *preview* можно использовать следующие методы.

### onlyCount

Метод `onlyCount()` позволяет отображать только количество выбранных значений в *preview*.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyCount()
    ];
}

//...
```

![belongs_to_many_preview_count](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count.png)
![belongs_to_many_preview_count_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count_dark.png)

### inLine

Метод `inLine()` позволяет отображать значения поля в виде строки.

```php
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
```

Вы можете передать в метод необязательные параметры:

- `separator` - разделитель между элементами;
- `badge` - замыкание или булево значение, отвечающее за отображение элементов в виде бейджа;
- `$link` - замыкание, которое должно возвращать ссылки url или компоненты.

При передаче булевого значения true в параметр `badge` будет использоваться цвет Primary. Для изменения цвета отображаемого `badge` используйте замыкание и возвращайте компонент `Badge::make()`.

```php
use MoonShine\Components\Link;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->inLine(
                separator: ' ',
                badge: fn($model, $value) => Badge::make($value, 'color'),
                link: fn(Category $category, $value, $field) => Link::make(
                    (new CategoryResource())->detailPageUrl($category),
                    $value
                )
            )
    ];
}

//...
```

![belongs_to_many_preview_in_line](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line.png)
![belongs_to_many_preview_in_line_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line_dark.png)

<a name="only-link"></a>
### Только ссылка

Метод `onlyLink()` позволит отобразить отношение в виде ссылки с количеством элементов.

```php
onlyLink(?string $linkRelation = null, Closure|bool $condition = null)
```

Вы можете передать в метод необязательные параметры:
- `linkRelation` - ссылка на отношение;
- `condition` - замыкание или булево значение, отвечающее за отображение отношения в виде ссылки.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink('category')
    ];
}
```

### linkRelation

Параметр `linkRelation` позволяет создать ссылку на отношение с привязкой родительского ресурса.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink('category')
    ];
}

//...
```

### condition

Параметр `condition` через замыкание позволит изменить метод отображения в зависимости от условий.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            })
    ];
}

//...
```

<a name="values-query"></a>
### Запрос для значений

Метод `valuesQuery()` позволяет изменить запрос для получения значений.

```php
valuesQuery(Closure $callback)
```

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
            ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
    ];
}
```

<a name="async-search"></a>
### Асинхронный поиск

Для реализации асинхронного поиска значений используйте метод `asyncSearch()`.

```php
asyncSearch(
    string $asyncSearchColumn = null,
    int $asyncSearchCount = 15,
    ?Closure $asyncSearchQuery = null,
    ?Closure $asyncSearchValueCallback = null,
    ?string $associatedWith = null,
    ?string $url = null,
    bool $replaceQuery = false,
)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;
 
//...
 
public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
            ->asyncSearch() 
    ];
}
 
//...
```

> [!TIP]
> Поиск будет осуществляться по полю отношения ресурса `column`. По умолчанию `column=id`

Вы можете передать параметры в метод `asyncSearch()`:

- `$asyncSearchColumn` - поле, по которому осуществляется поиск,
- `$asyncSearchCount` - количество элементов в результатах поиска,
- `$asyncSearchQuery` - функция обратного вызова для фильтрации значений,
- `$asyncSearchValueCallback` - функция обратного вызова для настройки вывода,
- `$associatedWith` - поле, с которым устанавливается связь,
- `$url` - url для обработки асинхронного запроса,
- `$replaceQuery` - заменить запрос.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
            ->asyncSearch(
                'title',
                10,
                asyncSearchQuery: function (Builder $query, Request $request, Field $field) {
                    return $query->where('id', '!=', 2);
                },
                asyncSearchValueCallback: function ($country, Field $field) {
                    return $country->id . ' | ' . $country->title;
                },
                'https://moonshine-laravel.com/async'
            )
    ];
}

//...
```

> [!TIP]
> При построении запроса в `asyncSearchQuery()` вы можете использовать текущие значения формы. Для этого нужно передать `Request` в функцию обратного вызова.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsToMany::make('Cities', 'cities',  resource: new CityResource())
            ->asyncSearch(
                'title',
                asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                    return $query->where('country_id', $request->get('country_id'));
                }
            )
    ];
}

//...
```

> [!TIP]
> При построении запроса в `asyncSearchQuery()` сохраняется исходное состояние построителя запросов.
> Если вам нужно заменить его своим построителем, тогда используйте флаг `replaceQuery`.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsToMany::make('Cities', 'cities',  resource: new CityResource())
            ->asyncSearch(
                'title',
                asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                    return $query->where('country_id', $request->get('country_id'));
                },
                replaceQuery: true
            )
    ];
}

//...
```

> [!TIP]
> Запросы должны быть настроены с использованием метода `asyncSearch()`. Не используйте `valuesQuery()`!

<a name="associated"></a>
### Связанные поля

Для установления связи значений выбора между полями можно использовать метод `associatedWith()`.

```php
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
```

- `$column` - поле, с которым устанавливается связь,
- `$asyncSearchQuery` - функция обратного вызова для фильтрации значений.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Cities', 'cities', resource: new CityResource())
            ->associatedWith('country_id')
    ];
}
```

> [TIP]
> Для более сложной настройки вы можете использовать `asyncSearch()`.

<a name="with-image"></a>
### Значения с изображением

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
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make(Countries, resource: new CountryResource())
            ->withImage('thumb', 'public', 'countries')->selectMode()
    ];
}

//...
```

![with_image](https://moonshine-laravel.com/screenshots/belongs_to_image.png)
![belongs_to_image_dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="buttons"></a>
### Кнопки

Метод `buttons()` позволяет добавить дополнительные кнопки к полю *BelongsToMany*.

```php
buttons(array $buttons)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->buttons([
                ActionButton::make('Check all', '')
                    ->onClick(fn() => 'checkAll', 'prevent'),

                ActionButton::make('Uncheck all', '')
                    ->onClick(fn() => 'uncheckAll', 'prevent')
            ])
    ];
}
```

### withCheckAll

Метод `withCheckAll()` позволяет добавить кнопки checkAll/uncheckAll к полю *BelongsToMany*, аналогично предыдущему примеру.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->withCheckAll()
    ];
}

//...
```
