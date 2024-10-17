# BelongsTo

- [Основы](#basics)
- [Значение по умолчанию](#default)
- [Nullable](#nullable)
- [Placeholder](#placeholder)
- [Создание объекта отношения](#creatable)
- [Поиск значений](#searchable)
- [Запрос для значений](#values-query)
- [Асинхронный поиск](#async-search)
- [Связанные поля](#associated)
- [Значения с изображением](#with-image)
- [Опции](#options)
- [Нативный режим](#native)

---

<a name="basics"></a>
## Основы

Поле _BelongsTo_ предназначено для работы с отношением того же имени в Laravel и включает все базовые методы.

Для создания этого поля используйте статический метод `make()`.

```php
BelongsTo::make(
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
> Наличие ресурса модели, на который ссылается отношение, обязательно!
> Ресурс также необходимо [зарегистрировать](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) в сервис-провайдере _MoonShineServiceProvider_ в методе `menu()` или `resources()`. В противном случае будет ошибка 404.


```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
    ];
}

//...
```

![belongs_to](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to.png) ![belongs_to_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to_dark.png)

> [!NOTE]
> Если вы не указываете `$relationName`, тогда имя отношения будет определено автоматически на основе `$label`.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
    ];
}

//...
```

> [!NOTE]
> Вы можете опустить `$resource`, если ресурс модели соответствует имени отношения.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
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

class CountryResource extends ModelResource
{
    //...

    public string $column = 'title';

    //...
}
```

Если вам нужно указать более сложное значение для отображения, тогда в аргумент `$formatted` можно передать функцию обратного вызова.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make(
            'Country',
            'country',
            fn($item) => "$item->id. $item->title"
        )
    ];
}

//...
```

> [!WARNING]
> При использовании поля _BelongsTo_ для сортировки или фильтрации позиций необходимо методом `setColumn()` установить поле в таблице базы данных или переопределить метод [sorting](https://moonshine-laravel.com/docs/resource/models-resources/resources-query#order) у ресурса модели.

Если вам нужно изменить column при работе с моделями, используйте метод `onAfterFill`

```php
BelongsTo::make(
    'Category',
    resource: new CategoryResource()
)->afterFill(fn($field) => $field->setColumn('changed_category_id'))
```

<a name="default"></a>
## Значение по умолчанию

Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

Вы должны передать объект модели в качестве значения по умолчанию.

```
use App\Models\Country;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->default(Country::find(1))
    ];
}

//...
```

<a name="nullable"></a>
## Nullable

Как и для всех полей, если вам нужно сохранить NULL, необходимо добавить метод `nullable()`

```php
nullable(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->nullable()
    ];
}

//...
```

![select_nullable](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/select_nullable.png) ![select_nullable_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/select_nullable_dark.png)

> [!TIP]
> MoonShine - очень удобный и функциональный инструмент. Однако, чтобы его использовать, вам нужно быть уверенным в основах Laravel.

Не забудьте указать в таблице базы данных, что поле может принимать значение `Null`.

<a name="placeholder"></a>
## Placeholder

Метод `placeholder()` позволяет установить атрибут _placeholder_ на поле.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="searchable"></a>
## Поиск значений

Если вам нужно искать среди значений, необходимо добавить метод `searchable()`.

```php
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource())
            ->searchable()
    ];
}

//...
```

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
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Author', resource: new AuthorResource())
            ->creatable()
    ];
}

//...
```

![belongs_to_creatable](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to_creatable.png) ![belongs_to_creatable_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to_creatable_dark.png)

Вы можете настроить кнопку создания, передав параметр _button_ в метод.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Author', resource: new AuthorResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            )
    ];
}

//...
```

<a name="values-query"></a>
## Запрос для значений

Метод `valuesQuery()` позволяет изменить запрос для получения значений.

```php
valuesQuery(Closure $callback)
```

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Category', 'category', resource: new CategoryResource())
            ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
    ];
}

//...
```

<a name="async-search"></a>
## Асинхронный поиск

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
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
            ->asyncSearch()
    ];
}

//...
```

> [!TIP]
> Поиск будет осуществляться по полю отношения ресурса `column`. По умолчанию `column=id`.

Вы можете передать параметры в метод `asyncSearch()`:

*   `$asyncSearchColumn` - поле, по которому осуществляется поиск;
*   `$asyncSearchCount` - количество элементов в результатах поиска;
*   `$asyncSearchQuery` - функция обратного вызова для фильтрации значений;
*   `$asyncSearchValueCallback` - функция обратного вызова для настройки вывода;
*   `$associatedWith` - поле, с которым устанавливается связь;
*   `$url` - url для обработки асинхронного запроса,
*   `$replaceQuery` - заменить запрос.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
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

> [!NOTE]
> При построении запроса в `asyncSearchQuery()` вы можете использовать текущие значения формы. Для этого нужно передать `Request` в callback функцию.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsTo::make('City', 'city',  resource: new CityResource())
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

> [!NOTE]
> При построении запроса в `asyncSearchQuery()` сохраняется исходное состояние builder.  
Если вам нужно заменить его своим builder, тогда используйте флаг `replaceQuery`.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsTo::make('City', 'city',  resource: new CityResource())
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

<a name="associated"></a>
## Связанные поля

Для установления связи значений выбора между полями можно использовать метод `associatedWith()`.

```php
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
```

- `$column` - поле, с которым устанавливается связь;
- `$asyncSearchQuery` - функция обратного вызова для фильтрации значений.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('City', 'city', resource: new CityResource())
            ->associatedWith('country_id')
    ];
}

//...
```

> [!NOTE]
> Для более сложной настройки вы можете использовать `asyncSearch()`.

<a name="with-image"></a>
## Значения с изображением

> [!NOTE]
> Метод `withImage()` позволяет добавить изображение к значению.

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
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make(Country, resource: new CountryResource())
            ->withImage('thumb', 'public', 'countries')
    ];
}

//...
```

![belongs_to_image](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to_image.png) ![belongs_to_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/belongs_to_image_dark.png)

<a name="options"></a>
## Опции

Все опции выбора доступны для изменения через *атрибуты data*:

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->searchable()
            ->customAttributes([
                'data-search-result-limit' => 5
            ])
    ];
}

//...
```

> [!NOTE]
> Для получения более подробной информации, пожалуйста, обратитесь к [Choices](https://choices-js.github.io/Choices/).

<a name="native"></a>
## Нативный режим

Метод `native()` отключает библиотеку Choices.js и отображает выбор в нативном режиме

```php
BelongsTo::make('Type')->native()
```
