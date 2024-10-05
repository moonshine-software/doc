# Select
  - [Make](#make)
  - [Значение по умолчанию](#default)
  - [Nullable](#nullable)
  - [Placeholder](#placeholder)
  - [Группы](#groups)
  - [Выбор нескольких значений](#multiple)
  - [Поиск](#search)
  - [Асинхронный поиск](#async)
  - [Редактирование в режиме preview](#update-on-preview)
  - [Значения с изображением](#with-image)
  - [Опции](#options)
  - [Нативный режим отображения](#native)
---

<a name="make"></a>
## Make
Поле _Select_ включает в себя все [базовые методы создания поля](/docs/{{version}}/fields/basic-methods).

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
```
![select](https://moonshine-laravel.com/screenshots/select_dark.png)

<a name="default"></a>
### Значение по умолчанию
Можно воспользоваться методом `default()`, если необходимо указать для поля значение по умолчанию.

```php
default(mixed $default)
```

```php
use MoonShine\UI\Fields\Select;


Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->default('value 2')
```
<a name="nullable"></a>  
## Nullable
Как и у всех полей, если необходимо сохранять NULL, то нужно добавить метод `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->nullable()
```
![select nullabledark](https://moonshine-laravel.com/screenshots/select_nullable_dark.png)

<a name="placeholder"></a>
## Placeholder
Метод `placeholder()` позволяет задать у поля атрибут *placeholder*.

```php
placeholder(string $value)
```
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country')
    ->nullable()
    ->placeholder('Country')
```

<a name="groups"></a>
## Группы
Можно объединять значения в группы.

```php
use MoonShine\UI\Fields\Select;

Select::make('City', 'city_id')
    ->options([
        'Italy' => [
            1 => 'Rome',
            2 => 'Milan'
        ],
        'France' => [
            3 => 'Paris',
            4 => 'Marseille'
        ]
    ])
```
![select group dark](https://moonshine-laravel.com/screenshots/select_group_dark.png)

<a name="multiple"></a>
## Выбор нескольких значений
Для выбора нескольких значений используйте метод `multiple()`.

```php
multiple(Closure|bool|null $condition = null)
```

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->multiple()
    ];
}

//...
```
> [!TIP]
> При использовании `multiple()` для Eloquent модели требуется использовать в базе данных тип text или json.
Также необходимо добавить *cast* - json, array, collection.

![select multiple dark.](https://moonshine-laravel.com/screenshots/select_multiple_dark.png)

<a name="search"></a>
## Поиск
Если необходимо добавить поиск среди значений, то нужно добавить метод `searchable()`.

```php
searchable()
```

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->searchable()
```
![searchable](https://moonshine-laravel.com/screenshots/select_searchable_dark.png)

<a name="async"></a>
## Асинхронный поиск
У поля *Select* так же можно организовать асинхронный поиск. Для это необходимо методу `async()` передать *url*, на который будет отправляться запрос с *query* параметром для поиска.
 
```php
async(Closure|string|null $url = null, string|array|null $events = null, ?AsyncCallback $callback = null)
```
- `$url` - url или функция для обработки асинхронного запроса.
- `$events` - список событий после выполнения запроса _(нужна ссылка на раздел с событиями)_.
- `$callback` - Callback после выполнения запроса.

> [!TIP]
> Параметры `$events` и `$callback` не являются обязательными.

Возвращаемый ответ с результатами поиска должен быть в формате *json*.

```php
[
    {
        "value": 1,
        "label": "Option 1"
    },
    {
        "value": 2,
        "label": "Option 2"
    }
]
```
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->searchable()
    ->async('/search')
```

<a name="update-on-preview"></a>
## Редактирование в режиме preview
Метод `updateOnPreview()` позволяет редактировать поле *Select* в режиме *preview*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null, array $events = [])
```

- `$url` - url для обработки асинхронного запроса.
- `$resource` - ресурс модели на которую ссылается отношение.
- `$condition` - условие выполнения метода.
- `$events` - список событий _когда выполняются?_ _(нужна ссылка на раздел с событиями)_.

> [!TIP]
> Параметры не являются обязательными и их необходимо передавать, если поле работает вне ресурса.

```php
use MoonShine\UI\Fields\Select;

Select::make(Country)
    ->updateOnPreview()
```

<a name="with-image"></a>
## Значения с изображением
Метод `optionProperties()` позволяет добавить изображение к значению.

```php
optionProperties(Closure|array $data)
```

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
        //...
    ])->optionProperties(fn() => [
        1 => ['image' => 'https://moonshine-laravel.com/images/ad.png'],
        2 => ['image' => 'https://moonshine-laravel.com/images/ae.png'],
        //...
    ])

```
![belongs to image dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="options"></a>
## Опции
Все опции *Сhoices.js* доступны для изменения через *data attributes*:

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
        //...
    ])->customAttributes([
        'data-max-item-count' => 2
    ])

```

> [!TIP]
> За более подробной информацией обратитесь к [Choices.js](https://choices-js.github.io/Choices/).

<a name="native"></a>
## Нативный режим отображения
Метод `native()` отключает библиотеку *Choices.js* и выводит *select* в нативном режиме.

```php
use MoonShine\UI\Fields\Select;

Select::make('Type')->native()
```
