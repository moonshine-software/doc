# Основы

- [Создание](#make)
- [Форматирование значения](#formatted)
- [Метка](#label)
- [Атрибуты](#attributes)
- [Alpine.js](#alpinejs)
- [Подсказка](#hint)
- [Ссылка](#link)
- [Nullable](#nullable)
- [Сортировка](#sortable)
- [Значок](#badge)
- [Горизонтальное отображение](#horizontal)
- [Отображение](#hide-show)
- [Динамическое отображение](#show-when)
- [Изменение отображения](#custom-view)
- [Методы по условию](#when-unless)
- [Заполнение](#fill)
- [Применение](#apply)
- [События](#events)
- [Ресурсы](#assets)
- [Обертка](#wrapper)
- [Реактивность](#reactive)
- [Методы onChange](#on-change)
- [Методы для значений](#for-value)
- [Схема работы поля](#scheme)

---

Поля играют жизненно важную роль в админ-панели **MoonShine**.
Они используются в `FormBuilder` для построения форм, в `TableBuilder` для создания таблиц, а также для формирования фильтра для `ModelResource`. Их можно использовать на ваших пользовательских страницах и даже за пределами админ-панели.
Поля в **MoonShine** не привязаны к модели (кроме поля Slug, ModelRelationFields, Json в режиме asRelation), поэтому диапазон их применения ограничен только вашим воображением.

Для удобства поля имеют *Lazy loading*.

<a name="make"></a>
## Создание

Для создания экземпляра поля используется статический метод `make()`.

```php
Text::make(Closure|string|null $label = null, ?string $column = null, ?Closure $formatted = null)
```

- `$label` - метка, заголовок поля,
- `$column` - поле в базе данных (например, name) или отношение (например, countries),
- `$formatted` - замыкание для форматирования значения поля при предпросмотре (везде, кроме формы).

> [!NOTE]
> Если вы не укажете `$column`, то поле в базе данных будет определено автоматически на основе `$label`.

<a name="formatted"></a>
## Форматирование значения

```php
//...

public function fields(): array
{
    return [
        Text::make(
            'Name',
            'first_name',
            fn($item) => $item->first_name . ' ' . $item->last_name
        )
    ];
}

//...
```

> [!WARNING]
> Поля, которые не поддерживают _formatted_: `Json`, `File`, `Range`, `RangeSlider`, `DateRange`, `Select`, `Enum`, `HasOne`, `HasMany`.

<a name="label"></a>
## Метка

Если вам нужно изменить _Label_, вы можете использовать метод `setLabel()`.

```php
setLabel(Closure|string $label)
```

```php
//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->setLabel(
                fn(Field $field) => $field->getData()?->exists
                    ? 'Slug (не изменять)'
                    : 'Slug'
            )
    ];
}

//...
```

Для перевода *Label* нужно передать ключ перевода в качестве имени и добавить метод `translatable()`.

```php
translatable(string $key = '')
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')->translatable('ui')
    ];
}

//...
```

или

```php
//...

public function fields(): array
{
    return [
        Text::make('ui.Title')->translatable()
    ];
}

//...
```

<a name="attributes"></a>
## Атрибуты

Базовые html-атрибуты, такие как `required`, `disabled` и `readonly`, должны быть указаны соответствующими методами на поле.

```php
disabled(Closure|bool|null $condition = null)
```

```php
hidden(Closure|bool|null $condition = null)
```

```php
required(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->disabled()
            ->hidden()
            ->readonly()
    ];
}

//...
```

Возможность указать любые другие атрибуты с помощью метода `customAttributes()`.

```php
customAttributes(array $attributes)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customAttributes(['autocomplete' => 'off'])
    ];
}

//...
```

Метод `customWrapperAttributes()` позволяет добавить атрибуты для _обертки_ поля.

```php
customWrapperAttributes(array $attributes)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customWrapperAttributes(['class' => 'mt-8'])
    ];
}

//...
```

<a name="alpinejs"></a>
## Alpine.js

Методы, позволяющие удобно взаимодействовать с Alpine.js.

```php
xData(null|array|string $data = null)
```

Все в Alpine начинается с директивы `x-data`. Метод `xData` определяет HTML-фрагмент как компонент Alpine и предоставляет реактивные данные для ссылки на этот компонент.

```php
Block::make([])->xData(['title' = 'Hello world']) // title - это реактивная переменная внутри
```

```php
xDataMethod(string $method, ...$parameters)
```

`x-data` с указанием компонента и его параметров.

```php
Block::make([])->xDataMethod('some-component', 'var', ['foo' => 'bar'])
```

```php
xModel(?string $column = null)
```

`x-model` привязка поля к реактивной переменной.

```php
Block::make([
    Text::make('Title')->xModel()
])->xData(['title' = 'Hello world'])

// или

Block::make([
    Text::make('Name')->xModel('title')
])->xData(['title' = 'Hello world'])
```

```php
xIf(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-if` скрывает поле, удаляя его из DOM.

```php
Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', 1)
])->xData(['title' = 'Hello world', 'type' => 1])

// или

Block::make([
    Select::make('Type')->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf(fn() => 'type==2||type.value==2')
])->xData(['title' = 'Hello world', 'type' => 1])

// если нужно скрыть поле без контейнера

Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', '=', 2, wrapper: false)
])->xData(['title' = 'Hello world', 'type' => 1])
```

```php
xShow(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-show` то же самое, что и x-if, но не удаляет элемент из DOM, а только скрывает его.

```php
xDisplay(string $value, bool $html = true)
```

`x-html` вывод значения.

```php
Block::make([
    Select::make('Type')
        ->native()
        ->options([
            1 => 'Paid',
            2 => 'Free',
        ])
        ->xModel(),

    Number::make('Cost', 'price')
        ->xModel()
        ->xIf('type', '1'),

    Number::make('Rate', 'rate')
        ->xModel()
        ->xIf('type', '1')
        ->setValue(90),

    LineBreak::make(),

    Div::make()
        ->xShow('type', '1')
        ->xDisplay('"Result:" + (price * rate)')
    ,
])->xData([
    'price' => 0,
    'rate' => 90,
    'type' => '2',
]),
```

<a name="hint"></a>
## Подсказка

Вы можете добавить подсказку с описанием к полю, вызвав метод `hint()`.

```php
hint(string $hint)
```

```php
//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->hint('От 0 до 5')
            ->min(0)
            ->max(5)
            ->stars()
    ];
}

//...
```

![hint](https://moonshine-laravel.com/screenshots/hint.png) ![hint_dark](https://moonshine-laravel.com/screenshots/hint_dark.png)

<a name="link"></a>
## Ссылка

Вы можете добавить ссылку к полю (например, с инструкциями) с помощью `link()`.

```php
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false
)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Link')
            ->link('https://cutcode.dev', 'CutCode', blank: true)
    ];
}

//...
```

![link](https://moonshine-laravel.com/screenshots/link.png) ![link_dark](https://moonshine-laravel.com/screenshots/link_dark.png)

<a name="nullable"></a>
## Nullable

Если вам нужно сохранить NULL для поля по умолчанию, вы должны использовать метод `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->nullable()
    ];
}

//...
```

<a name="sortable"></a>
## Сортировка

Чтобы иметь возможность сортировать поле на главной странице ресурса, вам нужно добавить метод `sortable()`.

```php
sortable(Closure|string|null $callback = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->sortable()
    ];
}

//...
```

Метод `sortable()` может принимать имя поля в базе данных или замыкание в качестве параметра.

```php
//...

public function fields(): array
{
    return [
        BelongsTo::make('Author')->sortable('author_id'),

        Text::make('Title')->sortable(function (Builder $query, string $column, string $direction) {
            $query->orderBy($column, $direction);
        })
    ];
}

//...
```

<a name="badge"></a>
## Значок

Чтобы отобразить поле в режиме предпросмотра как *значок*, нужно использовать метод `badge()`.

```php
badge(string|Closure|null $color = null)
```

Доступные цвета:

- primary 
- secondary 
- success 
- warning 
- error 
- info

- purple 
- pink 
- blue 
- green 
- yellow 
- red 
- gray

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->badge(fn($status, Field $field) => 'green')
    ];
}

//...
```

<a name="horizontal"></a>
## Горизонтальное отображение

Метод `horizontal()` позволяет отображать заголовок и поле горизонтально.

```php
horizontal()
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->horizontal(),
    ];
}

//...
```

![horizontal](https://moonshine-laravel.com/screenshots/horizontal.png) ![horizontal_dark](https://moonshine-laravel.com/screenshots/horizontal_dark.png)

<a name="hide-show"></a>
## Отображение

В ресурсе модели поля отображаются на странице списка (главной странице) и на страницах создания/редактирования/просмотра.

Чтобы исключить отображение поля на любой странице, вы можете использовать соответствующие методы `hideOnIndex()`, `hideOnForm()`, `hideOnDetail()` или обратные методы `showOnIndex()`, `showOnForm()`, `showOnDetail()`.

Чтобы исключить только со страницы редактирования или добавления - `hideOnCreate()`, `hideOnUpdate()`, а также обратные `showOnCreate()`, `showOnUpdate`.

Чтобы исключить поле на всех страницах, вы можете использовать метод `hideOnAll()`.

```php
hideOnIndex(Closure|bool|null $condition = null)
showOnIndex(Closure|bool|null $condition = null)
```

```php
hideOnForm(Closure|bool|null $condition = null)
showOnForm(Closure|bool|null $condition = null)

hideOnCreate(Closure|bool|null $condition = null)
showOnCreate(Closure|bool|null $condition = null)

hideOnUpdate(Closure|bool|null $condition = null)
showOnUpdate(Closure|bool|null $condition = null)
```

```php
hideOnDetail(Closure|bool|null $condition = null)
showOnDetail(Closure|bool|null $condition = null)
```

```php
hideOnAll(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->hideOnIndex()
            ->hideOnForm(),

        Switcher::make('Active')
            ->hideOnAll()
            ->showOnIndex(static fn() => true)
    ];
}

//...
```

> [!NOTE]
> Если вам просто нужно указать, какие поля отображать на страницах или изменить порядок отображения, то вы можете использовать удобный метод [переопределения полей](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#override).

<a name="show-when"></a>
## Динамическое отображение

Может возникнуть необходимость отображать поле только в том случае, если значение другого поля в форме имеет определенное значение (например: отображать телефон только в том случае, если есть отметка о наличии телефона).
Для этого используется метод `showWhen()`.

```php
showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
```

Доступные операторы:

`=` `<` `>` `<=` `>=` `!=` `in` `not` `in`

> [!NOTE]
> Если оператор не указан, будет использоваться `=`

```php
//...

public function fields(): array
{
    return [
        Checkbox::make('Has phone', 'has_phone'),
        Phone::make('Phone')
            ->showWhen('has_phone','=', 1)
    ];
}

//...
```
> [!NOTE]
> Если оператор `in` или `not in`, то в `$value` нужно передать массив, а значения в виде строки.

```php
//...

public function fields(): array
{
    return [
        Select::make('List', 'list')->multiple()->options([
            'value 1' => 'Option Label 1',
            'value 2' => 'Option Label 2',
            'value 3' => 'Option Label 3',
        ]),

        Text::make('Name')
            ->showWhen('list', 'not in', ['value 1', 'value 3']),

        Textarea::make('Content')
            ->showWhen('list', 'in', ['value 2', 'value 3'])
    ];
}

//...
```

В методе `showWhen()` для полей *Json* и *BelongsToMany* вы можете обращаться к вложенным значениям через `.`:

```php
->showWhen('data.content.active', '=', 1)
```

<a name="custom-view"></a>
## Изменение отображения

Когда вам нужно изменить представление, используя *текучий интерфейс*, вы можете использовать метод `customView()`.

```php
customView(string $customView)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->customView('fields.my-custom-input')
    ];
}

//...
```

Метод `changePreview()` позволяет переопределить представление для предпросмотра (везде, кроме формы).

```php
changePreview(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->changePreview(function ($value, Field $field) {
                return view('moonshine::ui.image', [
                    'value' => Storage::url($value)
                ]);
            })
    ];
}

//...
```

Метод `forcePreview()` указывает, что поле всегда должно быть в режиме предпросмотра

```php
Text::make('Label')->forcePreview()
```

Метод `requestValueResolver()` позволяет переопределить логику получения значения из Request

```php
requestValueResolver(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->requestValueResolver(function (string $nameDot, mixed $default, Field $field) {
                return request($nameDot, $default);
            })
    ];
}

//...
```

Методы `beforeRender()` и `afterRender()` позволяют отображать некоторую информацию до и после поля соответственно.

```php
beforeRender(Closure $closure)
```

```php
afterRender(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Image::make('Thumbnail')
            ->beforeRender(function (Field $field) {
                return $field->preview();
            })
    ];
}

//...
```

<a name="when-unless"></a>
## Методы по условию

Метод `when()` реализует *текучий интерфейс* и выполняет обратный вызов, когда первый аргумент, переданный методу, истинен.

```php
when($value = null, callable $callback = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(fn() => true, fn(Field $field) => $field->locked())
    ];
}

//...
```
> [!NOTE]
> В функцию обратного вызова будет передан экземпляр поля.

Второй обратный вызов может быть передан методу `when()`, он будет выполнен, когда первый аргумент, переданный методу, ложен.

```php
when($value = null, callable $callback = null, callable $default = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->locked(),
                fn(Field $field) => $field->readonly()
            )
    ];
}

//...
```

Метод `unless()` является обратным методу `when()` и выполнит первый обратный вызов, когда первый аргумент ложен, в противном случае будет выполнен второй обратный вызов, если он передан методу.

```php
unless($value = null, callable $callback = null, callable $default = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->unless(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->readonly()->hideOnCreate(),
                fn(Field $field) => $field->locked()
            )
    ];
}

//...
```

<a name="fill"></a>
## Заполнение

Поля могут быть заполнены значениями с помощью метода `fill()`.

```php
fill(mixed $value, mixed $casted = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->fill('Some title')
    ];
}

//...
```

Метод `changeFill()` позволяет изменить логику заполнения поля значениями.

```php
changeFill(mixed $value, mixed $casted = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Categories')
            ->changeFill(
                fn(Article $data, Field $field) => $data->categories->implode('title', ',')
            )
    ];
}

//...
```

> [!NOTE]
> Поля отношений не поддерживают метод `changeFill`

<a name="apply"></a>
## Применение

Каждое поле имеет метод `apply()`, который преобразует данные с учетом методов *request* и *resolve*. Например, он преобразует данные модели для сохранения в базе данных или генерирует запрос для фильтрации.

Возможно переопределить действия при выполнении метода `apply()`. Для этого нужно использовать метод `onApply()`, который принимает замыкание.

```php
onApply(Closure $onApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail by link', 'thumbnail')
            ->onApply(function(Model $item, $value, Field $field) {
                $path = 'thumbnail.jpg';

                if ($value) {
                    $item->thumbnail = Storage::put($path, file_get_contents($value));
                }

                return $item;
            })
    ];
}

//...
```

> [!NOTE]
> Если поле используется для построения фильтра, то в замыкание будет передан *Query Builder*.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;

//...

public function filters(): array
{
    return [
        Switcher::make('Active')
            ->onApply(fn(Builder $query, $value, Field $field) => $query->where('active', $value))
    ];
}

//...
```

Если вы не хотите, чтобы поле выполняло какие-либо действия, то вы можете использовать метод `canApply()`.

```php
canApply(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->canApply()
    ];
}

//...
```

<a name="events"></a>
## События

Иногда может потребоваться переопределить методы *resolve*, которые выполняются до и после `apply()`, для этого необходимо использовать соответствующие методы.

```php
onBeforeApply(Closure $onBeforeApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onBeforeApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

```php
onAfterApply(Closure $onAfterApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

```php
onAfterDestroy(Closure $onAfterDestroy)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterDestroy(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

<a name="assets"></a>
## Ресурсы

Для поля возможна загрузка дополнительных CSS-стилей и JS-скриптов с помощью метода `addAssets()`.

```php
addAssets(array $assets)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->addAssets(['custom.css', 'custom.js'])
    ];
}
```

[Предыдущее содержимое остается без изменений]

<a name="wrapper"></a>
## Обертка

При отображении на формах поля используют специальную *обертку* для заголовков, подсказок, ссылок и т.д. Иногда может возникнуть ситуация, когда вы хотите отобразить поле без дополнительных элементов.
Метод `withoutWrapper()` позволяет отключить создание *обертки*.

```php
withoutWrapper(mixed $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->withoutWrapper()
    ];
}
```

![without_wrapper](https://moonshine-laravel.com/screenshots/without_wrapper.png) ![without_wrapper_dark](https://moonshine-laravel.com/screenshots/without_wrapper_dark.png)

<a name="reactive"></a>
## Реактивность

Метод `reactive()` позволяет реактивно изменять поля.

```php
reactive(
    ?Closure $callback = null,
    bool $lazy = false,
    int $debounce = 0,
    int $throttle = 0,
)
```

- `$callback` - функция _обратного вызова_,
- `$lazy` - отложенный вызов функции,
- `$debounce` - время между вызовами функции (мс.),
- `$throttle` - интервал вызова функции (мс.).

#### Обратный вызов

Функция *обратного вызова* в методе `reactive()` принимает параметры, которые вы можете использовать для построения своей логики.

```php
function(Fields $fields, ?string $value, Field $field, array $values)
```

- `$fields` - реактивные поля,
- `$value` - значение поля, которое запускает реактивность,
- `$field` - поле, инициирующее реактивность,
- `$values` - значения реактивных полей.

> [!NOTE]
> Поля, поддерживающие реактивность: `Text`, `Number`, `Checkbox`, `Select` и их наследники.

```php
FormBuilder::make()
    ->name('my-form')
    ->fields([
        Text::make('Title')
            ->reactive(function(Fields $fields, ?string $value): Fields {
                return tap($fields, static fn ($fields) => $fields
                    ->findByColumn('slug')
                    ?->setValue(str($value ?? '')->slug()->value())
                );
            }),

        Text::make('Slug')
            ->reactive()
    ])
```

Этот пример реализует формирование поля slug на основе заголовка.
Slug будет генерироваться по мере ввода текста.

> [!NOTE]
> Реактивное поле может изменять состояние других полей, но не изменяет свое собственное состояние!

Чтобы изменить состояние поля, инициирующего реактивность, удобно использовать параметры функции *обратного вызова*.

```php
Select::make('Category', 'category_id')
    ->reactive(function(Fields $fields, ?string $value, Field $field, array $values): Fields {
        $field->setValue($value);

        return tap($fields, static fn ($fields) =>
            $fields
                ->findByColumn('article_id')
                ?->options(
                    Article::where('category_id', $value)
                        ->get()
                        ->pluck('title', 'id')
                        ->toArray()
                );
        );
    })
```

<a name="on-change"></a>
## Методы onChange

Используя методы `onChangeMethod()` и `onChangeUrl()`, вы можете добавить логику при изменении значений поля.

Методы `onChangeUrl()` или `onChangeMethod()` присутствуют для всех полей, кроме полей отношений *HasOne* и *HasMany*.

#### onChangeUrl()

Метод `onChangeUrl()` позволяет асинхронно отправлять запрос при изменении поля.

```php
onChangeUrl(
    Closure $url,
    string $method = 'PUT',
    array $events = [],
    ?string $selector = null,
    ?string $callback = null,
)
```

- `$url` - URL запроса,
- `$method` - метод асинхронного запроса,
- `$events` - события, которые будут вызваны после успешного запроса,
- `$selector` - селектор элемента, содержимое которого будет изменено,
- `$callback` - js-функция обратного вызова после получения ответа.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint')
    ];
}
```

Если вам нужно заменить область HTML после успешного запроса, вы можете вернуть HTML-содержимое или json с ключом html в ответе.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint', selector: '#my-selector')
    ];
}
```

#### onChangeMethod()

Метод `onChangeMethod()` позволяет асинхронно вызывать метод ресурса или страницы при изменении поля без необходимости создания дополнительных контроллеров.

```php
onChangeMethod(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    ?string $callback = null,
    ?Page $page = null,
    ?ResourceContract $resource = null,
)
```

- `$method` - имя метода,
- `$params` - параметры для запроса,
- `$message` - сообщения,
- `$selector` - селектор элемента, содержимое которого будет изменено,
- `$events` - события, которые будут вызваны после успешного запроса,
- `$callback` - js-функция обратного вызова после получения ответа,
- `$page` - страница, содержащая метод,
- `$resource` - ресурс, содержащий метод.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeMethod('someMethod')
    ];
}
```

```php
public function someMethod(MoonShineRequest $request): void
{
    // Логика
}
```

> [!NOTE]
> Пример сортировки компонента *CardsBuilder* в разделе [Рецепты](https://moonshine-laravel.com/docs/resource/recipes/recipes#sorting-for-cards-builder)

<a name="for-value"></a>
## Методы для значений

#### Получение значения из источника

Метод `fromRaw()` позволяет добавить замыкание для получения конечного значения из исходного.
Это замыкание используется при импорте данных.

```php
/**
 * @param  Closure(mixed $raw, static): mixed  $callback
 * @return $this
 */
fromRaw(Closure $callback)
```

```php
use App\Enums\StatusEnum;
use MoonShine\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->fromRaw(fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw))
```

#### Получение сырого значения

Метод `modifyRawValue()` позволяет добавить замыкание для получения сырого значения.
Это замыкание используется при экспорте данных.

```php
/**
 * @param  Closure(mixed $raw, static): mixed  $callback
 * @return $this
 */
modifyRawValue(Closure $callback)
```

```php
use App\Enums\StatusEnum;
use MoonShine\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->modifyRawValue(fn(StatusEnum $raw, Enum $ctx) => $raw->value))
```

<a name="scheme"></a>
## Схема работы поля

![field_scheme](https://moonshine-laravel.com/screenshots/field_scheme.png)]