# Выбор (Select)

  - [Создание](#make)
  - [Значение по умолчанию](#default)
  - [Nullable](#nullable)
  - [Placeholder](#placeholder)
  - [Группы](#groups)
  - [Выбор нескольких значений](#multiple)
  - [Поиск](#search)
  - [Асинхронный поиск](#async)
  - [Редактирование в предпросмотре](#update-on-preview)
  - [Значения с изображением](#with-image)
  - [Опции](#options)
  - [Нативный режим](#native)

---

<a name="make"></a>
## Создание
Поле _Select_ включает все базовые методы.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
    ];
}

//...
```
![select](https://moonshine-laravel.com/screenshots/select_dark.png)

<a name="default"></a>
## Значение по умолчанию
Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->default('value 2')
    ];
}

//...
```
<a name="nullable"></a>  
## Nullable

Как и для всех полей, если вам нужно хранить NULL, необходимо добавить метод `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```
```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->nullable()
    ];
}

//...
```
![select nullabledark](https://moonshine-laravel.com/screenshots/select_nullable_dark.png)

<a name="placeholder"></a>
## Placeholder
Метод ```placeholder()``` позволяет установить атрибут *placeholder* для поля.

```php
placeholder(string $value)
```
```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="groups"></a>
## Группы
Вы можете объединять значения в группы.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
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
    ];
}

//...
```
![select group dark](https://moonshine-laravel.com/screenshots/select_group_dark.png)

<a name="multiple"></a>
## Выбор нескольких значений
Для выбора нескольких значений нужен метод `multiple()`.

```php
multiple(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
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
> При использовании `multiple()` для модели Eloquent требуется поле в базе данных типа text или json.
Также необходимо добавить *cast* - json или array или collection.

![select multiple dark.](https://moonshine-laravel.com/screenshots/select_multiple_dark.png)

<a name="search"></a>
## Поиск
Если вам нужно добавить поиск среди значений, то необходимо добавить метод `searchable()`.

```php
searchable()
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable()
    ];
}

//...
```
![searchable](https://moonshine-laravel.com/screenshots/select_searchable_dark.png)

<a name="async"></a>
## Асинхронный поиск
Вы также можете организовать асинхронный поиск для поля *Select*. Для этого нужно передать *url* в метод `async()`, на который будет отправлен запрос с параметром поиска *query*.

```php
async(?string $asyncUrl = null)
```

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
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable()
            ->async('/search')
    ];
}

//...
```

<a name="update-on-preview"></a>
## Редактирование в предпросмотре
Метод `updateOnPreview()` позволяет редактировать поле *Select* в режиме *предпросмотра*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

-`$url` - url для обработки асинхронного запроса,
-`$resource` - ресурс модели, на который ссылается отношение,
-`$condition` - условие выполнения метода.

> [!TIP]
> Настройки не обязательны и должны быть переданы, если поле работает вне ресурса.

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make(Country)
            ->updateOnPreview()
    ];
}

//...
```

<a name="with-image"></a>
## Значения с изображением

Метод `optionProperties()` позволяет добавить изображение к значению.

```php
optionProperties(Closure|array $data)
```

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
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
    ];
}

//...
```
![belongs to image dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="options"></a>

## Опции
Все опции выбора доступны для изменения через *data-атрибуты*:

```php
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                1 => 'Andorra',
                2 => 'United Arab Emirates',
                //...
            ])->customAttributes([
                'data-max-item-count' => 2
            ])
    ];
}

//...
```

> [!TIP]
> Для более подробной информации обратитесь к [Choices](https://choices-js.github.io/Choices/).

<a name="native"></a>
## Нативный режим

Метод `native()` отключает библиотеку Choices.js и отображает select в нативном режиме.

```php
Select::make('Type')->native()
```
