# Select

- [Основы](#basics)
- [Значение по умолчанию](#default)
- [Nullable](#nullable)
- [Placeholder](#placeholder)
- [Группы](#groups)
- [Выбор нескольких значений](#multiple)
- [Поиск](#search)
- [Асинхронный поиск](#async)
- [События при изменении](#on-change-event)
- [Редактирование в режиме preview](#update-on-preview)
- [Значения с изображением](#with-image)
- [Опции](#options)
- [Нативный режим отображения](#native)
- [Использование в blade](#blade)
- [Реактивность](#reactive)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Country">
    <<x-moonshine::form.select>
        <x-slot:options>
            <option value="1">Option 1</option>
            <option selected value="2">Option 2</option>
        </x-slot:options>
    </x-moonshine::form.select>
</x-moonshine::form.wrapper>
```
~~~

![select](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select.png#light)
![select](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_dark.png#dark)

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

Также вы можете указывать опции через объект `Options`:

```php
Select::make('Select')->options(
    new Options([
        new Option(label: 'Option 1', value: '1', selected: true, properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
        new Option(label: 'Option 2', value: '2', properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
    ]
)
)
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

![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_nullable.png#light)
![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_nullable_dark.png#dark)

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

```php
Select::make('City')->options(
    new Options([
        new OptionGroup('Italy', new Options([
            new Option('Rome', '1'),
            new Option('Milan', '2'))
        ])),

        new OptionGroup('France', new Options([
            new Option('Paris', '3'),
            new Option('Marseille', '4')
        ]))
    ])
),
```

![select group](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_group.png#light)
![select group](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_group_dark.png#dark)

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
}

// ...
```
> [!TIP]
> При использовании `multiple()` для Eloquent модели требуется использовать в базе данных тип text или json.
Также необходимо добавить *cast* - json, array, collection.

![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_multiple.png#light)
![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_multiple_dark.png#dark)

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

![searchable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_searchable.png#light)
![searchable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/select_searchable_dark.png#dark)

<a name="async"></a>
## Асинхронный поиск

У поля `Select` так же можно организовать асинхронный поиск.
Для это необходимо методу `async()` передать *url*, на который будет отправляться запрос с *query* параметром для поиска.

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

Также можно воспользоваться объектом `Options`:

```php
public function selectOptions(): MoonShineJsonResponse
{
    $options = new Options([
        new Option(label: 'Option 1', value: '1', selected: true, properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png')),
        new Option(label: 'Option 2', value: '2', properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png')),
    ]);

    return MoonShineJsonResponse::make(data: $options->toArray());
}
```

Ответ будет:

```php
[{
    "value": "1",
    "label": "Option 1",
    "selected": true,
    "properties": {
        "image": "https:\/\/cutcode.dev\/images\/platforms\/youtube.png"
    }
}, {
    "value": "2",
    "label": "Option 2",
    "selected": false,
    "properties": {
        "image": "https:\/\/cutcode.dev\/images\/platforms\/youtube.png"
    }
}]
```

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->async('/search')
```

Если необходимо сразу же после отображения страницы отправить запрос на значения, тогда необходимо добавить метод `asyncOnInit(whenOpen: false)`

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->async('/search')
    ->asyncOnInit(whenOpen: false)
```

При пустом `asyncOnInit()` или `asyncOnInit(whenOpen: true)` запрос будет отправляться после клика на `Select`.

> [!NOTE]
> Не забудьте обработать `query` при использовании `async`, иначе поиск всегда будет выдавать одинаковые значения

<a name="n-change-event"></a>
## События при изменении

При изменении значения `Select`, через метод `onChangeEvent`, вы можете вызвать события:

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2'
    ])
    ->onChangeEvent(
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects')
    ),
```

Если `Select` находится в форме, то по умолчанию при вызове события с запросом будут отправлены все данные формы.
Если форма большая, то может потребоваться исключить набор полей.
Исключить можно через параметр `exclude`:

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    exclude: ['text', 'description']
)
```

Также можно полностью исключить отправку данных через параметр `withoutPayload`:

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    withoutPayload: true
)
```

<a name="update-on-preview"></a>
## Редактирование в режиме preview
Метод `updateOnPreview()` позволяет редактировать поле `Select` в режиме *preview*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null, array $events = [])
```

- `$url` - url для обработки асинхронного запроса.
- `$resource` - `ModelResource`, на которую ссылается отношение.
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
        // ...
    ])->optionProperties(fn() => [
        1 => ['image' => 'https://moonshine-laravel.com/images/ad.png'],
        2 => ['image' => 'https://moonshine-laravel.com/images/ae.png'],
        // ...
    ])
```

Или через объект `Options`:

```php
Select::make('Select')->options(
    new Options([
        new Option(label: 'Option 1', value: '1', selected: true, properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
        new Option(label: 'Option 2', value: '2', properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
    ]
)
)
```

![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/belongs_to_image.png#light)
![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/belongs_to_image_dark.png#dark)

<a name="options"></a>
## Опции
Все опции *Сhoices.js* доступны для изменения через *data attributes*:

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
        // ...
    ])->customAttributes([
        'data-max-item-count' => 2
    ])

```

> [!TIP]
> За более подробной информацией обратитесь к [Choices.js](https://choices-js.github.io/Choices/).

<a name="native"></a>
## Нативный режим отображения
Метод `native()` отключает библиотеку *Choices.js* и выводит `Select` в нативном режиме.

```php
use MoonShine\UI\Fields\Select;

Select::make('Type')->native()
```

<a name="blade"></a>
## Использование в blade

<a name="blade-basics"></a>
### Основы

```php
<x-moonshine::form.select>
    <x-slot:options>
        <option value="1">Option 1</option>
        <option selected value="2">Option 2</option>
    </x-slot:options>
</x-moonshine::form.select>
```

Вы можете объединять значения в группы.

```php
<x-moonshine::form.select
    :searchable="true"
/>
```

Вы можете передать дополнительные параметры компоненту:

- `searchable` - поиск по значениям
- `nullable` - может иметь значение `NULL`

Для асинхронной загрузки значений необходимо атрибуту asyncRoute указать url, который вернет данные в формате json.

```blade
<x-moonshine::form.select asyncRoute='url' />
```

> [!TIP]
> Смотрите также рецепты по использованию [Select](/docs/{{version}}/recipes/select).

<a name="reactive"></a>
## Реактивность

Данному полю доступна [реактивность](/docs/{{version}}/fields/basic-methods#reactive).
