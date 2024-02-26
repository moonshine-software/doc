<x-page
    title="Основы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#formatted', 'label' => 'Форматирование значения'],
            ['url' => '#label', 'label' => 'Label'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
            ['url' => '#hint', 'label' => 'Подсказка'],
            ['url' => '#link', 'label' => 'Ссылка'],
            ['url' => '#nullable', 'label' => 'Nullable'],
            ['url' => '#sortable', 'label' => 'Сортировка'],
            ['url' => '#badge', 'label' => 'Badge'],
            ['url' => '#hide-show', 'label' => 'Отображение'],
            ['url' => '#show-when', 'label' => 'Динамическое отображение'],
            ['url' => '#custom-view', 'label' => 'Изменение отображения'],
            ['url' => '#when-unless', 'label' => 'Методы по условию'],
            ['url' => '#fill', 'label' => 'Заполнение'],
            ['url' => '#apply', 'label' => 'Apply'],
            ['url' => '#events', 'label' => 'События'],
            ['url' => '#assets', 'label' => 'Assets'],
            ['url' => '#wrapper', 'label' => 'Wrapper'],
            ['url' => '#reactive', 'label' => 'Реактивность'],
            ['url' => '#on-change', 'label' => 'Методы onChange'],
            ['url' => '#scheme', 'label' => 'Схема работы поля'],
        ]
    ]"
>

<x-p>
    Полям отводится важнейшая роль в админ-панели <strong>MoonShine</strong>.<br />
    Они используются в <code>FormBuilder</code> для построения форм, в <code>TableBuilder</code> для создания таблиц,
    а также в формировании фильтра для <code>ModelResource</code>.
    Их можно использовать в ваших кастомных страницах и даже вне админ-панели.<br />
    Поля в <strong>MoonShine</strong> не привязаны к модели (за исключением поля Slug, ModelRelationFields, Json в режиме asRelation),
    поэтому спектр их применения ограничивается только вашей фантазией.<br />
</x-p>
<x-p>
    Для удобства у полей реализован <em>fluent интерфейс</em>.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Для создании экземпляра поля используется статический метод <code>make()</code>.
</x-p>

<x-code language="php">
    Text::make(Closure|string|null $label = null, ?string $column = null, ?Closure $formatted = null)
</x-code>

<x-ul>
    <li><code>$label</code> - лейбл, заголовок поля,</li>
    <li><code>$column</code> - поле в базе (например name) или отношение (например countries),</li>
    <li><code>$formatted</code> - замыкание для форматирования значения поля при превью (везде кроме формы).</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если не указать <code>$column</code>,
    то поле в базе данных будет определено автоматически на основе <code>$label</code>.
</x-moonshine::alert>

<x-sub-title id="formatted">Форматирование значения</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make(
            'Name',
            'first_name',
            fn($item) => $item->first_name . ' ' . $item->last_name // [tl! focus]
        )
    ];
}

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Поля не поддерживающие <em>formatted</em>: <code>Json</code>, <code>File</code>, <code>Range</code>,
    <code>RangeSlider</code>, <code>DateRange</code>, <code>Select</code>, <code>Enum</code>, <code>HasOne</code>,
    <code>HasMany</code>.
</x-moonshine::alert>

<x-sub-title id="label">Label</x-sub-title>

<x-p>
    Если необходимо изменить <em>Label</em>, можно воспользоваться методом <code>setLabel()</code>
</x-p>

<x-code language="php">
setLabel(Closure|string $label)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->setLabel(
                fn(Field $field) => $field->getData()?->exists
                    ? 'Slug (do not change)'
                    : 'Slug'
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    Для перевода <em>Label</em> необходимо в качестве названия передать ключ перевода и
    добавить метод <code>translatable()</code>
</x-p>

<x-code language="php">
translatable(string $key = '')
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')->translatable('ui') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>или</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('ui.Title')->translatable() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Основные html атрибуты, такие как <code>required</code>,
    <code>disabled</code> и <code>readonly</code>, у поля необходимо задавать через соответствующие методы.
</x-p>

<x-code language="php">
disabled(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hidden(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
required(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->disabled() // [tl! focus]
            ->hidden() // [tl! focus]
            ->readonly() // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Возможность указать и любые другие атрибуты используя метод <code>customAttributes()</code>.
</x-p>

<x-code language="php">
customAttributes(array $attributes)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customAttributes(['autocomplete' => 'off']) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>customWrapperAttributes()</code> позволяет добавить атрибуты для <em>wrapper</em> поля.
</x-p>

<x-code language="php">
customWrapperAttributes(array $attributes)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customWrapperAttributes(['class' => 'mt-8']) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="hint">Подсказка</x-sub-title>

<x-p>
    Полю можно добавить подсказку с описанием вызвав метод <code>hint()</code>
</x-p>

<x-code language="php">
hint(string $hint)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->hint('From 0 to 5') // [tl! focus]
            ->min(0)
            ->max(5)
            ->stars()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/hint.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/hint_dark.png') }}"></x-image>

<x-sub-title id="link">Ссылка</x-sub-title>

<x-p>
    Полю можно добавить ссылку (например с инструкциями)
    <code>link()</code>.
</x-p>

<x-code language="php">
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false
)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Link')
            ->link('https://cutcode.dev', 'CutCode', blank: true) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/link_dark.png') }}"></x-image>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    Если необходимо у поля по умолчанию сохранять NULL, то необходимо использовать метод <code>nullable()</code>.
</x-p>

<x-code language="php">
nullable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="sortable">Сортировка</x-sub-title>

<x-p>
    Для возможности сортировки поля на главной странице ресурса необходимо добавить метод <code>sortable()</code>.
</x-p>

<x-code language="php">
sortable(Closure|string|null $callback = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->sortable() // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>sortable()</code> в качестве параметра может принимать название поля в базе данных или замыкание.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        BelongsTo::make('Author')->sortable('author_id'), // [tl! focus]

        Text::make('Title')->sortable(function (Builder $query, string $column, string $direction) {
            $query->orderBy($column, $direction);
        }) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    Для отображения поля в режиме preview в виде <em>badge</em>,
    необходимо воспользоваться методом <code>badge()</code>.
</x-p>

<x-code language="php">
badge(string|Closure|null $color = null)
</x-code>

@include('pages.ru.ui.shared.colors')

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->badge(fn($status, Field $field) => 'green') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="hide-show">Отображение</x-sub-title>

<x-p>
    В ресурсе модели поля отображаются на странице со списком (главная страница)
    и на страницах создания/редактирования/просмотра.<br />
    Чтобы исключить вывод поля на какой-либо странице, можно воспользоваться соответствующими методами
    <code>hideOnIndex()</code>, <code>hideOnForm()</code>, <code>hideOnDetail()</code> или
    обратные методы <code>showOnIndex()</code>, <code>showOnForm()</code>, <code>showOnDetail()</code>.<br />
    Чтобы исключить только со страницы редактирования или добавления -
    <code>hideOnCreate()</code>, <code>hideOnUpdate()</code>,
    а также обратные <code>showOnCreate()</code>, <code>showOnUpdate</code>
</x-p>

<x-code language="php">
hideOnIndex(Closure|bool|null $condition = null)
showOnIndex(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hideOnForm(Closure|bool|null $condition = null)
showOnForm(Closure|bool|null $condition = null)

hideOnCreate(Closure|bool|null $condition = null)
showOnCreate(Closure|bool|null $condition = null)

hideOnUpdate(Closure|bool|null $condition = null)
showOnUpdate(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
hideOnDetail(Closure|bool|null $condition = null)
showOnDetail(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title') // [tl! focus:start]
            ->hideOnIndex()
            ->hideOnForm(), // [tl! focus:end]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Если вам необходимо просто указать какие поля отображать на страницах или изменить очередность вывода,
    то можно воспользоваться удобным способом
    <x-link :link="to_page('resources-fields') . '#override'" >
        переопределения полей
    </x-link>.
</x-moonshine::alert>

<x-sub-title id="show-when">Динамическое отображение</x-sub-title>

<x-p>
    Может возникнуть потребность отображать поле только в том случае, если значение у другого поля
    в форме имеет определенное значение (Например: отображать телефон, только если стоит галочка, что телефон есть).<br />
    Для этих целей используется метод <code>showWhen()</code>.
</x-p>

<x-code language="php">
showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
</x-code>

<x-p>
    Доступные операторы:
</x-p>

<x-p>
    <x-moonshine::badge color="gray">=</x-moonshine::badge>
    <x-moonshine::badge color="gray"><</x-moonshine::badge>
    <x-moonshine::badge color="gray">></x-moonshine::badge>
    <x-moonshine::badge color="gray"><=</x-moonshine::badge>
    <x-moonshine::badge color="gray">>=</x-moonshine::badge>
    <x-moonshine::badge color="gray">!=</x-moonshine::badge>
    <x-moonshine::badge color="gray">in</x-moonshine::badge>
    <x-moonshine::badge color="gray">not in</x-moonshine::badge>
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Если оператор не указан, то будет использоваться <code>=</code>
</x-moonshine::alert>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Checkbox::make('Has phone', 'has_phone'),
        Phone::make('Phone')
            ->showWhen('has_phone','=', 1) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если оператор имеет значение <code>in</code> или <code>not in</code>,
    то в <code>$value</code> необходимо передать массив
</x-moonshine::alert>

<x-code language="php">
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
            ->showWhen('list', 'not in', ['value 1', 'value 3']), // [tl! focus]

        Textarea::make('Content')
            ->showWhen('list', 'in', ['value 2', 'value 3']) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    В методе <code>showWhen()</code> для полей <em>Json</em> и <em>BelongsToMany</em>
    получить доступ к вложенным значениям можно через <code>.</code>:
</x-p>

<x-code language="php">
    ->showWhen('data.content.active', '=', 1)
</x-code>

<x-sub-title id="custom-view">Изменение отображения</x-sub-title>

<x-p>
    Когда необходимо изменить view с помощью <em>fluent interface</em>
    можно воспользоваться методом <code>customView()</code>.
</x-p>

<x-code language="php">
customView(string $customView)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->customView('fields.my-custom-input') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>changePreview()</code> позволяет переопределить view для превью (везде кроме формы).
</x-p>

<x-code language="php">
changePreview(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->changePreview(function ($value, Field $field) {
                return view('moonshine::ui.image', [
                    'value' => Storage::url($value)
                ]);
            }) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>forcePreview()</code> укажет что поле должно быть всегда в режиме preview
</x-p>

<x-code language="php">
    Text::make('Label')->forcePreview()
</x-code>

<x-p>
    Метод <code>requestValueResolver()</code> позволяет переопределить логику получения значения из Request
</x-p>

<x-code language="php">
requestValueResolver(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->requestValueResolver(function (string $nameDot, mixed $default, Field $field) {
                return request($nameDot, $default);
            }) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    Методы <code>beforeRender()</code> и <code>afterRender()</code>
    позволяют вывести какую-то информацию перед и после поля соответственно.
</x-p>

<x-code language="php">
beforeRender(Closure $closure)
</x-code>

<x-code language="php">
afterRender(Closure $closure)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Image::make('Thumbnail')
            ->beforeRender(function (Field $field) {
                return $field->preview();
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="when-unless">Методы по условию</x-sub-title>

<x-p>
    Метод <code>when()</code> реализует <em>fluent interface</em>
    и выполнит callback, когда первый аргумент, переданный методу, имеет значение true.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(fn($field) => $field->getData()?->exists, fn(Field $field) => $field->locked()) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Экземпляр поля, будет передан в функции callback.
</x-moonshine::alert>

<x-p>
    Методу <code>when()</code> может быть передан второй callback, он будет выполнен,
    когда первый аргумент, переданный методу, имеет значение false.
</x-p>

<x-code language="php">
when($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(
                fn($field) => $field->getData()?->exists,
                fn(Field $field) => $field->locked(),
                fn(Field $field) => $field->hidden()
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>unless()</code> обратный методу <code>when()</code> и выполнит первый callback,
    когда первый аргумент имеет значение false, иначе будет выполнен второй callback, если он передан методу.
</x-p>

<x-code language="php">
unless($value = null, callable $callback = null, callable $default = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->unless(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->readonly()->hideOnCreate(),
                fn(Field $field) => $field->locked()
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-sub-title id="fill">Заполнение</x-sub-title>

<x-p>
    Поля можно заполнить значениями использую метод <code>fill()</code>.
</x-p>

<x-code language="php">
fill(mixed $value, mixed $casted = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->fill('Some title') // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Метод <code>changeFill()</code> позволяет изменить логику наполнения поля значениями.
</x-p>

<x-code language="php">
fill(mixed $value, mixed $casted = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Categories')
            ->changeFill(
                fn(Article $data, Field $field) => $data->categories->implode('title', ',')
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Поля отношений не поддерживают метод <code>changeFill</code>
</x-moonshine::alert>

<x-sub-title id="apply">Apply</x-sub-title>

<x-p>
    У каждого поля реализован метод <code>apply()</code>,
    который трансформирует данные с учетом <em>request</em> и <em>resolve</em> методов.
    Например, трансформирует данные модели для сохранения в базе данных или формирует запрос для фильтрации.
</x-p>

<x-p>
    Существует возможность переопределить действия при выполнении метода <code>apply()</code>,
    для этого необходимо воспользоваться методом <code>onApply()</code> который принимает замыкание.
</x-p>

<x-code language="php">
onApply(Closure $onApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail by link', 'thumbnail')
            ->onApply(function(Model $item, $value, Field $field) {
                $path = 'thumbnail.jpg';

                if ($value) {
                    $item->thumbnail = Storage::put($path, file_get_content($value));
                }

                return $item;
            }) // [tl! focus:-8]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Если поле используется для построения фильтра, то в замыкание будет передан <em>Query Builder</em>.
</x-moonshine::alert>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]

//...

public function filters(): array
{
    return [
        Switcher::make('Active')
            ->onApply(fn(Builder $query, $value, Field $field) => $query->where('active', $value)) // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    Если вы не хотите чтобы поле выполняло какие-то действия,
    то можно воспользоваться методом <code>canApply()</code>.
</x-p>

<x-code language="php">
canApply(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->canApply() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="events">События</x-sub-title>

<x-p>
    Иногда может возникнуть потребность переопределить <em>resolve</em> методы, которые выполняются до и после <code>apply()</code>,
    для этого необходимо воспользоваться соответствующими методами.
</x-p>

<x-code language="php">
onBeforeApply(Closure $onBeforeApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onBeforeApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-code language="php">
onAfterApply(Closure $onAfterApply)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-code language="php">
onAfterDestroy(Closure $onAfterDestroy)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterDestroy(function(Model $item, $value, Field $field) {
                //
                return $item;
            }) // [tl! focus:-3]
    ];
}
</x-code>

<x-sub-title id="assets">Assets</x-sub-title>

<x-p>
    Для поля есть возможность загрузить дополнительные css стили и js скрипты, используя метод <code>addAssets()</code>.
</x-p>

<x-code language="php">
addAssets(array $assets)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->addAssets(['custom.css', 'custom.js']) // [tl! focus]
    ];
}
</x-code>

<x-sub-title id="wrapper">Wrapper</x-sub-title>

<x-p>
    Поля при отображении в формах используют специальную обертку <em>wrapper</em> для заголовков, подсказок, ссылок и тд.
    Иногда может возникнуть ситуация, когда требуется отобразить поле без дополнительных элементов.<br />
    Метод <code>withoutWrapper()</code> позволяет отключить создание <em>wrapper</em>.
</x-p>

<x-code language="php">
withoutWrapper(mixed $condition = null)
</x-code>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->withoutWrapper() // [tl! focus]
    ];
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/without_wrapper.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/without_wrapper_dark.png') }}"></x-image>

<x-sub-title id="reactive">Реактивность</x-sub-title>

<x-p>
    Метод <code>reactive()</code> позволяет реактивно изменять поля.
</x-p>

<x-code language="php">
reactive(
    ?Closure $callback = null,
    bool $lazy = false,
    int $debounce = 0,
    int $throttle = 0,
)
</x-code>

<x-ul>
    <li><code>$callback</code> - <em>callback</em> функция,</li>
    <li><code>$lazy</code> - отложенный вызов функции,</li>
    <li><code>$debounce</code> - время между вызовами функций (ms.),</li>
    <li><code>$throttle</code> - интервал вызова функций (ms.).</li>
</x-ul>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поля поддерживающие реактивность: <code>Text</code>, <code>Checkbox</code>, <code>Select</code>
    и их наследующие.
</x-moonshine::alert>

<x-code language="php">
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

        Text::make('Slug')->reactive(),
    ])
</x-code>

<x-p>
    В данном пример реализовано формирование slug-поля на основе заголовка.<br/>
    Slug будет генерироваться в процессе ввода текста.
</x-p>

<x-sub-title id="on-change">Методы onChange</x-sub-title>

<x-p>
    C помощью методов <code>onChangeMethod()</code> и <code>onChangeUrl()</code>
    можно добавить логику при изменении значений полей.
</x-p>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Методы <code>onChangeUrl()</code> или <code>onChangeMethod()</code> присутствуют у всех полей,
    кроме полей отношений <em>HasOne</em> и <em>HasMany</em>.
</x-moonshine::alert>

<x-moonshine::divider label="onChangeUrl()" />

<x-p>
    Метод <code>onChangeUrl()</code> позволяет асинхронно отправить запрос при изменении поля.
</x-p>

<x-code language="php">
onChangeUrl(
    Closure $url,
    string $method = 'PUT',
    array $events = [],
    ?string $selector = null,
    ?string $callback = null,
)
</x-code>

<x-ul>
    <li><code>$url</code> - url запроса,</li>
    <li><code>$method</code> - метод асинхронного запроса,</li>
    <li><code>$events</code> - вызываемые события после успешного запроса,</li>
    <li><code>$selector</code> - selector элемента у которого будет изменяться контент,</li>
    <li><code>$callback</code> - js callback функция после получения ответа.</li>
</x-ul>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint') // [tl! focus]
    ];
}
</x-code>

<x-p>
    Если требуется заменить область с html после успешного запроса,
    вы можете в ответе вернуть HTML контент или json с ключом html.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint', selector: '#my-selector') // [tl! focus]
    ];
}
</x-code>

<x-moonshine::divider label="onChangeMethod()" />

<x-p>
    Метод <code>onChangeMethod()</code> позволяет асинхронно вызывать метод ресурса или страницы при изменении поля
    без необходимости создавать дополнительные контроллеры.
</x-p>

<x-code language="php">
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
</x-code>

<x-ul>
    <li><code>$method</code> - наименование метода,</li>
    <li><code>$params</code> - параметры для запроса,</li>
    <li><code>$message</code> - сообщения,</li>
    <li><code>$selector</code> - selector элемента у которого будет изменяться контент,</li>
    <li><code>$events</code> - вызываемые события после успешного запроса,</li>
    <li><code>$callback</code> - js callback функция после получения ответа,</li>
    <li><code>$page</code> - страница содержащая метод,</li>
    <li><code>$resource</code> - ресурс содержащий метод.</li>
</x-ul>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeMethod('someMethod') // [tl! focus]
    ];
}
</x-code>

<x-code language="php">
public function someMethod(MoonShineRequest $request): void
{
    // Logic
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Пример сортировки компонента <em>CardsBuilder</em> в разделе
    <x-link link="{{ to_page('recipes') }}#sorting-for-cards-builder">Recipes</x-link>
</x-moonshine::alert>

<x-sub-title id="scheme">Схема работы поля</x-sub-title>

<x-link link="{{ asset('files/field_scheme.pdf') }}" target="_blank">
    <x-image src="{{ asset('screenshots/field_scheme.png') }}"></x-image>
</x-link>

</x-page>
