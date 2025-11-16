# Select

- [Основы](#basics)
- [Основные методы](#basic-methods)
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
- [Плагины](#plugins)
- [Пользовательские настройки](#settings)
  - [Именные настройки](#fields-names)
  - [Доп. настройки асинхронности](#async-settings)
  - [Создания новых опции](#select-creatable)
  - [Макс. выбор опции](#select-max-items)

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
        'value 2' => 'Option Label 2',
    ])
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Country">
    <x-moonshine::form.select>
        <x-slot:options>
            <option value="1">Option 1</option>
            <option selected value="2">Option 2</option>
        </x-slot:options>
    </x-moonshine::form.select>
</x-moonshine::form.wrapper>
```
~~~

![select](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select.png#light)
![select](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_dark.png#dark)

<a name="basic-methods"></a>
## Основные методы

<a name="default"></a>
### Значение по умолчанию

Если необходимо указать значение по умолчанию, вы можете воспользоваться методом `default()`.

```php
default(mixed $default)
```

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->default('value 2')
```

Также вы можете указывать опции через объект `Options`.

```php
Select::make('Select')
    ->options(
        new Options([
            new Option(
                label: 'Option 1',
                value: '1',
                selected: true,
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
            new Option(
                label: 'Option 2',
                value: '2',
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
        ])
    )
```

<a name="nullable"></a>
### Nullable

Как и у всех полей, если необходимо сохранять NULL, то нужно добавить метод `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->nullable()
```
tab: Blade
```blade
<x-moonshine::form.select
    :nullable="true"
/>
```
~~~

![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_nullable.png#light)
![select nullable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_nullable_dark.png#dark)

<a name="placeholder"></a>
### Placeholder

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

~~~tabs
tab: array
```php
use MoonShine\UI\Fields\Select;

Select::make('City', 'city_id')
    ->options([
        'Italy' => [
            1 => 'Rome',
            2 => 'Milan',
        ],
        'France' => [
            3 => 'Paris',
            4 => 'Marseille',
        ]
    ])
```
tab: OptionGroup
```php
use MoonShine\UI\Fields\Select;

Select::make('City')
    ->options(
        new Options([
            new OptionGroup('Italy', new Options([
                new Option('Rome', '1'),
                new Option('Milan', '2'),
            ])),
            new OptionGroup('France', new Options([
                new Option('Paris', '3'),
                new Option('Marseille', '4'),
            ])),
        ])
    )
```
~~~

![select group](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_group.png#light)
![select group](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_group_dark.png#dark)

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
        'value 2' => 'Option Label 2',
    ])
    ->multiple()
}
```

@include('_includes/note-about-multiple-cast')

![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_multiple.png#light)
![select multiple](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_multiple_dark.png#dark)

<a name="search"></a>
## Поиск

Если необходимо добавить поиск среди значений, то нужно добавить метод `searchable()`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->searchable()
```
tab: Blade
```blade
<x-moonshine::form.select
    :searchable="true"
/>
```
~~~

![searchable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_searchable.png#light)
![searchable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/select_searchable_dark.png#dark)

<a name="async"></a>
## Асинхронный поиск

У поля `Select` так же можно организовать асинхронный поиск.
Для это необходимо методу `async()` передать *url*, на который будет отправляться запрос с *query* параметром для поиска.

```php
async(
    Closure|string|null $url = null,
    string|array|null $events = null,
    ?AsyncCallback $callback = null,
)
```

- `$url` - url или функция для обработки асинхронного запроса,
- `$events` - список событий после выполнения запроса (нужна ссылка на раздел с событиями),
- `$callback` - Callback после выполнения запроса.

> [!NOTE]
> Параметры `$events` и `$callback` не являются обязательными.

Возвращаемый ответ с результатами поиска должен быть в формате *json*.

```json
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

Также можно воспользоваться объектом `Options`.

```php
public function selectOptions(): JsonResponse
{
    $options = new Options([
        new Option(
            label: 'Option 1',
            value: '1',
            selected: true,
            properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png'),
        ),
        new Option(
            label: 'Option 2',
            value: '2',
            properties: new OptionProperty('https://cutcode.dev/images/platforms/youtube.png'),
        ),
    ]);

    return JsonResponse::make(data: $options->toArray());
}
```

Ответ будет:

```json
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

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->async('/search')
```
tab: Blade
```blade
<x-moonshine::form.select asyncRoute='/search' />
```
~~~

Если необходимо сразу же после отображения страницы отправить запрос на значения, тогда необходимо добавить метод `asyncOnInit(whenOpen: false)`.

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->async('/search')
    ->asyncOnInit(whenOpen: false)
```

При пустом `asyncOnInit()` или `asyncOnInit(whenOpen: true)` запрос будет отправляться после клика на `Select`.
И если необходимо, чтобы показывался "Загрузчик", перед открытием `Select`, то можно добавить `asyncOnInit(withLoading: true)`.

> [!NOTE]
> Не забудьте обработать `query` при использовании `async`, иначе поиск всегда будет выдавать одинаковые значения.

<a name="n-change-event"></a>
## События при изменении

При изменении значения `Select`, вы можете вызвать события через метод `onChangeEvent()`.

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        'value 1' => 'Option Label 1',
        'value 2' => 'Option Label 2',
    ])
    ->onChangeEvent(
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects')
    ),
```

Если `Select` находится в форме, то по умолчанию при вызове события с запросом будут отправлены все данные формы.
Если форма большая, то может потребоваться исключить набор полей.
Исключить можно через параметр `exclude`.

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    exclude: ['text', 'description']
)
```

Также можно полностью исключить отправку данных через параметр `withoutPayload`.

```php
->onChangeEvent(
    AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects'),
    withoutPayload: true
)
```

<a name="update-on-preview"></a>
## Редактирование в режиме preview

Метод `updateOnPreview()` позволяет редактировать поле `Select` в режиме "preview".

```php
updateOnPreview(
    ?Closure $url = null,
    ?ResourceContract $resource = null,
    mixed $condition = null,
    array $events = [],
)
```

- `$url` - url для обработки асинхронного запроса,
- `$resource` - `ModelResource`, на который ссылается отношение,
- `$condition` - условие выполнения метода,
- `$events` - список событий _когда выполняются?_ (нужна ссылка на раздел с событиями).

> [!NOTE]
> Параметры не являются обязательными и их необходимо передавать, если поле работает вне ресурса.

```php
use MoonShine\UI\Fields\Select;

Select::make('Country')
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
    ])
    ->optionProperties(fn() => [
        1 => ['image' => 'https://moonshine-laravel.com/images/ad.png'],
        2 => ['image' => 'https://moonshine-laravel.com/images/ae.png'],
    ])
```

Или через объект `Options`:

```php
Select::make('Select')
    ->options(
        new Options([
            new Option(
                label: 'Option 1',
                value: '1',
                selected: true,
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
            new Option(
                label: 'Option 2',
                value: '2',
                properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png'),
            ),
        ])
    )
```

![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image.png#light)
![belongs to image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image_dark.png#dark)

Для кастомизации изображений передавайте в `OptionPropery` объект `OptionImage` вместо строки:

```php
new OptionProperty(
    new OptionImage(
        src: 'https://cutcode.dev/images/platforms/youtube.png',
        height: 6,
        width: 6,
        objectFit: ObjectFit::CONTAIN
    )
),
```

- `$src` - url изображения,
- `$height` - высота изображения (используется для подстановки в класс `h-{x}`, где `x` в диапазоне от 1 до 10),
- `$width` - ширина изображения (используется для подстановки в класс `w-{x}`, где `x` в диапазоне от 1 до 10),
- `$objectFit` - одно из значений перечисления ObjectFit (см. [`object-fit`](https://developer.mozilla.org/ru/docs/Web/CSS/object-fit)).

<a name="options"></a>
## Опции

Все опции *Tom Select* доступны для изменения через *data attributes*.

```php
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id')
    ->options([
        1 => 'Andorra',
        2 => 'United Arab Emirates',
    ])
    ->customAttributes([
        'data-remove-item-button' => true,
    ])

```

> [!TIP]
> За более подробной информацией обратитесь к [документации Tom Select](https://tom-select.js.org/docs/).

<a name="native"></a>
## Нативный режим отображения

Метод `native()` отключает библиотеку *Tom Select* и выводит `Select` в нативном режиме.

```php
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->native()
```

> [!TIP]
> Смотрите также рецепты по использованию [Select](/docs/{{version}}/recipes/select).

<a name="plugins"></a>
## Плагины

Метод `addPlugin(array|string $plugin, array $pluginOptions = [])` добавляет плагин в `Select`.

```php
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->addPlugin(['plugin_1', 'plugin_2'])

Select::make('Type')
    ->addPlugin('plugin_1', [
        'foo' => 'bar',
        ...
    ])
    ->addPlugin('plugin_2', [
        'foo' => 'bar',
        ...
    ])
```

> [!TIP]
> Все официальные [плагины](https://tom-select.js.org/plugins/).

Вы также можете очень легко создавать свои собственные плагины.

```html
<script>
    document.addEventListener('moonshine:select_init', function({ detail: { createPlugin } }) {
        createPlugin('myPlugin', function(pluginOptions) {
            console.log(pluginOptions, this.getValue())

            this.on('change', value => {
                //
            })
        })
    })
</script>
```
Далее, подключаем плагин, как показано выше.

> [!TIP]
> Полная документация по [созданию плагинов](https://tom-select.js.org/docs/plugins/).

<a name="settings"></a>
## Пользовательские настройки

Метод `settings()` разрешает использовать все пользовательские настройки `Tom Select`.

```php
use MoonShine\Support\DTOs\Select\Settings;
settings(array|Settings $settings)
```
```php
use MoonShine\UI\Fields\Select;
use MoonShine\Support\DTOs\Select\Settings;

Select::make('Type')
    ->settings(
        Settings::make()
            ->maxOptions(10)
            ->highlight(false)
    );
```

> [!TIP]
> Все доступные [настройки](https://tom-select.js.org/docs/#general-configuration).

<a name="fields-names"></a>
### Для всех именных настроек, есть очень удобный метод `fieldsNames()`

```php
use MoonShine\Support\DTOs\Select\FieldsNames;
fieldsNames(FieldsNames $names)
```
```php
use MoonShine\UI\Fields\Select;
use MoonShine\Support\DTOs\Select\FieldsNames;

Select::make('Type')
    ->fieldsNames(
        FieldsNames::make()
            ->value('id')
            ->label('name')
            ->children('children')
    );
```

<a name="async-settings"></a>
### Для дополнительной настройки асинхронности, можно воспользоваться методом `asyncSettings()`

```php
use MoonShine\Support\DTOs\Select\AsyncSettings;
asyncSettings(array|AsyncSettings $settings)
```
```php
use MoonShine\UI\Fields\Select;
use MoonShine\Support\DTOs\Select\AsyncSettings;

Select::make('Type')
    ->asyncSettings(
        AsyncSettings::make()
            // Можно менять название поля поиска
            ->queryKey('q')

            // Можно отправить текущие активные значения, просто указываем название
            ->selectedValuesKey('name')

            // Если результат обернуть, например, в data, то указываем этот ключ
            ->resultKey('data')

            // Если хотите, чтобы вместе с запросом, шли все поля текущей формы
            ->withAllFields()
    );
```

<a name="select-creatable"></a>
### Для переключения в режим "создания новых опции", можно воспользоваться методом `selectCreatable()`

```php
selectCreatable(
    ?string $filterRegex = null,
    bool $persist = true,
    bool $createOnBlur = false,
    bool $duplicates = false,
    bool $addPrecedence = false,
)
```
```php
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->selectCreatable(
        /^\d+$/
    );
```
> [!TIP]
> Более подробно описано [здесь](https://tom-select.js.org/examples/create-filter/).


<a name="select-max-items"></a>
### Если нужно ограничить максимальный выбор опции, можно воспользоваться методом `selectMaxItems()`

```php
selectMaxItems(
    ?int $limit = null,
    ?string $text = null // По умолчанию "Максимальное количество элементов: :count"
)
```
```php
use MoonShine\UI\Fields\Select;

Select::make('Type')
    ->selectMaxItems(5);
```
