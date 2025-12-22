# Базовые методы

- [Описание](#description)
- [Создание](#create)
- [Отображение поля](#view)
  - [Label](#label)
  - [Подсказка](#hint)
  - [Ссылка](#link)
  - [Badge](#badge)
  - [Горизонтально отображение](#horizontal)
  - [Обертка](#wrapper)
  - [Text wrap](#text-wrap)
  - [Сортировка](#sortable)
  - [Режимы отображения](#view-modes)
- [Атрибуты](#attributes)
  - [Required](#required-link)
  - [Disabled](#disabled-link)
  - [Readonly](#readonly-link)
  - [Другие атрибуты](#custom-attributes)
  - [Атрибуты для wrapper поля](#custom-wrapper-attributes)
  - [Модифицирование атрибута "name"](#name-attribute)
- [Модифицирование значения поля](#field-value)
  - [Значение по умолчанию](#default)
  - [Nullable](#nullable)
  - [Изменение отображения](#custom-view)
  - [Хук до рендера](#on-before-render)
  - [Получение значения из запроса](#request-value-resolver)
  - [До и после рендеринга](#before-and-after-render)
  - [Условные методы](#conditional-methods)
  - [Apply](#apply)
  - [Заполнение](#fill)
  - [Методы onChange](#on-change)
  - [Изменение render поля](#change-render)
  - [Методы для значений](#for-value)
- [Редактирование в режиме preview](#preview-edit)
- [Ассеты](#assets)
- [Трейт Macroable](#macroable)
- [Реактивность](#reactive)
- [Динамическое отображение](#dynamic-display)
  - [showWhen](#show-when)
  - [showWhenDate](#show-when-date)
  - [showWhenRow](#show-when-row)
  - [Вложенные поля](#nested-fields)
  - [Множественные условия](#multiple-conditions)
  - [Поддерживаемые операторы](#supported-operators)
- [Кастомное поле](#custom)

---

<a name="description"></a>
## Описание

Все поля наследуют базовый класс `Field`, который предоставляет базовые методы работы с полями.

<a name="create"></a>
## Создание поля

Для создания экземпляра поля используется статический метод `make()`.

```php
make(
    Closure|string|null $label = null,
    ?string $column = null,
    ?Closure $formatted = null
)
```

- `$label` - заголовок поля,
- `$column` - связь столбца в базе и атрибута `name` у поля ввода (например: `description` > `<input name="description">`).
Если это поле отношения, то используется название отношения (например: countries),
- `$formatted` - замыкание для форматирования значения поля в режиме preview (для `BelongsTo` и `BelongsToMany` форматирует значения для выбора).

> [!NOTE]
> В `$label` можно добавлять html теги, они не будут экранироваться.

> [!NOTE]
> Если не указать `$column`, то поле в базе данных будет определено автоматически на основе `$label` (только для английского языка).

Пример замыкания `$formatted` для форматирования значения:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

Text::make(
    'Name',
    'first_name',
    fn($item) => $item->first_name . ' ' . $item->last_name
)
```

> [!NOTE]
> Поля не поддерживающие `$formatted`: `Json`, `File`, `Range`, `RangeSlider`, `DateRange`, `Select`, `Enum`, `HasOne`, `HasMany`.

<a name="view"></a>
## Отображение поля

<a name="label"></a>
### Label

Если необходимо изменить label после создания экземпляра поля, можно воспользоваться методом `setLabel()`.

```php
setLabel(Closure|string $label)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Slug;

Slug::make('Slug')
    ->setLabel(
        fn(Field $field) => $field->getData()?->exists
            ? 'Slug (do not change)'
            : 'Slug'
    )
```

Для перевода label необходимо в качестве названия передать ключ перевода и добавить метод `translatable()`.

```php
translatable(string $key = '')
```

```php
Text::make('ui.Title')->translatable()

Text::make('Title')->translatable('ui')
```

```php
Text::make(fn() => __('Title'))
```

#### insideLabel()

Для оборачивания поля в тег `<label>` можно использовать метод `insideLabel()`.

```php
Text::make('Name')->insideLabel()
```

#### beforeLabel()

Для отображения label после поля ввода можно использовать метод `beforeLabel()`.

```php
Text::make('Name')->beforeLabel()
```

<a name="hint"></a>
### Подсказка

Подсказка с описанием можно создать с помощью метода `hint()`.

```php
hint(string $hint)
```

```php
Number::make('Rating')
    ->hint('From 0 to 5')
    ->min(0)
    ->max(5)
    ->stars()
```

<a name="link"></a>
### Ссылка

Полю можно добавить ссылку (например с инструкциями) `link()`.

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
Text::make('Link')
    ->link('https://cutcode.dev', 'CutCode', blank: true)
```

<a name="badge"></a>
### Badge

Для отображения поля в режиме preview в виде badge, необходимо воспользоваться методом `badge()`.

```php
badge(string|Color|Closure|null $color = null)
```

Доступные цвета:

<p class="colors">
<span class="color color-primary">primary</span>
<span class="color color-secondary">secondary</span>
<span class="color color-success">success</span>
<span class="color color-warning">warning</span>
<span class="color color-error">error</span>
<span class="color color-info">info</span>
<span class="color color-purple">purple</span>
<span class="color color-pink">pink</span>
<span class="color color-blue">blue</span>
<span class="color color-green">green</span>
<span class="color color-yellow">yellow</span>
<span class="color color-red">red</span>
<span class="color color-gray">gray</span>
</p>

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\Color;

Text::make('Title')
    ->badge(Color::PRIMARY)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Field;

Text::make('Title')
    ->badge(fn($status, Field $field) => 'green')
```

<a name="horizontal"></a>
### Горизонтально отображение

Метод `horizontal()` позволяет отображать название и поле горизонтально.

```php
horizontal()
```

```php
Text::make('Title')
    ->horizontal()
```

<a name="wrapper"></a>
### Обертка

Поля при отображении в формах используют специальную обертку для заголовков, подсказок, ссылок и тд.
Иногда может возникнуть ситуация, когда требуется отобразить поле без дополнительных элементов.
Метод `withoutWrapper()` позволяет отключить создание обертки.

```php
withoutWrapper(mixed $condition = null)
```

```php
Text::make('Title')->withoutWrapper()
```

<a name="text-wrap"></a>
### Text wrap

Если поля в режиме предварительного просмотра не помещаются в область, выделенную им по ширине, они выходят за ее пределы.
Но этим поведением можно управлять с помощью метода `textWrap()`, определяющего, как именно обрезать текст.

Clamp:

```php
Text::make('Field')->textWrap(TextWrap::CLAMP)
```

Ellipsis:

```php
Text::make('Field')->textWrap(TextWrap::ELLIPSIS)
```

Disable:

```php
Text::make('Field')->withoutTextWrap()
```

> [!NOTE]
> По умолчанию поле `Text` имеет Elipsis, а `Textarea` имеет Clamp.

<a name="sortable"></a>
### Сортировка

Для возможности сортировки поля в таблицах (на главной странице) необходимо добавить метод `sortable()`.

```php
sortable(Closure|string|null $callback = null)
```

```php
Text::make('Title')->sortable()
```

Метод `sortable()` в качестве параметра может принимать название поля в базе данных или замыкание.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Text;

BelongsTo::make('Author')
    ->sortable('author_id'),

Text::make('Title')
    ->sortable(function (Builder $query, string $column, string $direction) {
        $query->orderBy($column, $direction);
    })
```

<a name="view-modes"></a>
### Режимы отображения

Подробнее о режимах отображения поля можно прочитать в разделе [Основы > Смена режима отображения](/docs/{{version}}/fields/index#change-mode).

#### Режим "Default"
Чтобы поле вне зависимости от контекста всегда работало в режиме "Default" (отображение "input" поля), необходимо использовать метод `defaultMode()`.

```php
Text::make('Title')->defaultMode()
```

#### Режим "Preview"

Чтобы поле вне зависимости от контекста всегда работало в режиме "Preview", необходимо использовать метод `previewMode()`.

```php
Text::make('Title')->previewMode()
```

#### Режим "RawMode"

Чтобы поле вне зависимости от контекста всегда работало в режиме "RawMode" (отображение исходного состояния), необходимо использовать метод `rawMode()`.

```php
Text::make('Title')->rawMode()
```

<a name="attributes"></a>
## Атрибуты

Основные html атрибуты, такие как `required`, `disabled` и `readonly`, у поля необходимо задавать через соответствующие методы.

<a name="required-link"></a>
### Required

```php
required(Closure|bool|null $condition = null)
```

```php
Text::make('Title')->required()
```

<a name="disabled-link"></a>
### Disabled

```php
disabled(Closure|bool|null $condition = null)
```

```php
Text::make('Title')->disabled()
```

<a name="readonly-link"></a>
### Readonly

```php
readonly(Closure|bool|null $condition = null)
```

```php
Text::make('Title')->readonly()
```

<a name="custom-attributes"></a>
### Другие атрибуты
Чтобы указать любые другие атрибуты, используется метод `customAttributes()`.

> [!NOTE]
> Поля являются компонентами, подробнее об атрибутах читайте в разделе [Атрибуты компонентов](/docs/{{version}}/components/attributes).

```php
customAttributes(
    array $attributes,
    bool $override = false
)
```

- `$attributes` - массив атрибутов,
- `$override` - для добавления атрибутов к полю, используется `merge`.
Если атрибут, который вы хотите добавить к полю, уже присутствует, то он добавлен не будет.
`$override = true` позволяет изменить данное поведение и перезаписать уже добавленный атрибут.

```php
Password::make('Title')
    ->customAttributes(['autocomplete' => 'off'])
```

<a name="custom-wrapper-attributes"></a>
### Атрибуты для wrapper поля

Метод `wrapperClass()` добавляет обёртке класс или несколько, если передать массив.

```php
wrapperClass(string|array $classes);
```

```php
Text::make('name')
    ->wrapperClass('my-input');
```

Метод `removeWrapperClass()` удаляет класс обёртки. Можно передать паттерн для удаления нескольких классов (через функцию `preg_replace`).

```php
removeWrapperClass(string $pattern);
```

```php
Text::make('name')
    ->removeWrapperClass('my-input');
```

```php
Text::make('name')
    ->removeWrapperClass('text-(success|primary)');
```

Метод `wrapperStyle()` добавляет CSS-стили.

```php
wrapperStyle(string|array $styles);
```

```php
Text::make('name')
    ->wrapperStyle('width: 100px');
```

Метод `customWrapperAttributes()` позволяет добавить любые атрибуты для обертки поля.

```php
customWrapperAttributes(array $attributes);
```

```php
Text::make('Name')
    ->customWrapperAttributes(['data-handle' => 'handle']);
```

Метод `removeWrapperAttribute()` удаляет атрибут у обёртки.

```php
removeWrapperAttribute(string $name);
```

```php
Text::make('Name')
    ->removeWrapperAttribute('data-handle');
```

<a name="name-attribute"></a>
### Модифицирование атрибута "name"

Так как атрибут `name` генерируется на основе вложенности и имеет сложную логику формирования,
то для его изменения требуется воспользоваться методом `setNameAttribute()`.

```php
Text::make('Name')
    ->setNameAttribute('custom_name')
```

#### wrapName
Для того чтобы добавить wrapper для значения атрибута `name`, используется метод `wrapName()`.

```php
Text::make('Name')
    ->wrapName('options')
```

В результате атрибут name примет вид `<input name="options[name]>`. Это особенно полезно для настройки фильтров.

#### virtualName

Иногда необходимо хранить по одному полю ввода два значения Field.
Например, по условию отображение одно из полей может становиться невидимым, но присутствовать в DOM и отправляться вместе с запросом.

```php
// это поле отображается в DOM на одном условии
File::make('image')

// это поле отображается в DOM на другом условии
File::make('image')
```

Для того чтобы изменить атрибут name у этих полей, используется метод `virtualName()`.

```php
File::make('image')
    ->virtualColumn('image_1')

// ...

File::make('image')
    ->virtualColumn('image_2')
```

Далее, например в `onApply()` методе, мы обрабатываем эти поля по своему усмотрению.

<a name="field-value"></a>
## Модифицирование значения поля

<a name="default"></a>
### Значение по умолчанию

Для указания значения по умолчанию используется метод `default()`.

```php
default(mixed $default)
```

```php
Text::make('Name')
    ->default('Default value')
```

```php
Enum::make('Status')
    ->attach(ColorEnum::class)
    ->default(ColorEnum::from('B')->value)
```

<a name="nullable"></a>
### Nullable

Если необходимо у поля по умолчанию сохранять NULL, то необходимо использовать метод `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```

```php
Password::make('Title')->nullable()
```

<a name="custom-view"></a>
### Изменение отображения

Когда необходимо изменить view с помощью _fluent interface_ можно воспользоваться методом `customView()`.

```php
customView(string $view, array $data = [])
```

```php
Text::make('Title')
    ->customView('fields.my-custom-input')
```

Метод `changePreview()` позволяет переопределить view для превью (везде кроме формы).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Thumbnails;
use MoonShine\UI\Fields\Text;

Text::make('Thumbnail')
    ->changePreview(function (?string $value, Text $field) {
        return Thumbnails::make($value);
    })
```

<a name="on-before-render"></a>
### Хук до рендера

Если вам необходимо получить доступ к полю непосредственно перед рендером, для этого можно воспользоваться методом `onBeforeRender()`.

```php
/**
 * @param  Closure(static $ctx): void  $onBeforeRender
 */
onBeforeRender(Closure $onBeforeRender)
```

```php
Text::make('Thumbnail')
    ->onBeforeRender(function(Text $ctx) {
        // ...
    })
```

<a name="request-value-resolver"></a>
### Получение значения из запроса

Метод `onRequestValue()` позволяет переопределить логику получения значения из Request.

```php
/**
* @param  Closure(mixed $value, string $name, mixed $default, static $ctx): mixed  $callback
*/
onRequestValue(Closure $callback)
```

- `$value` - значение полученное по умолчанию,
- `$name` - наименование параметра запроса,
- `$default` - значение поля по умолчанию, при отсутствии в запросе,
- `$ctx` - текущее поле,

Статический метод `requestValueResolver()` позволяет глобально переопределить логику получения значения из Request для всех полей.

```php
/**
* @param  Closure(string|int|null $index, mixed $default, static $ctx): mixed  $resolver
*/
requestValueResolver(Closure $resolver)
```

```php
FormElement::requestValueResolver(function (string|int|null $index, mixed $default, static $ctx): mixed {
    return request()->input($ctx->getRequestNameDot($index), $default);
})
```

<a name="before-and-after-render"></a>
### До и после рендеринга

Методы `beforeRender()` и `afterRender()` позволяют вывести какую-то информацию перед и после поля соответственно.

```php
beforeRender(Closure $closure)
afterRender(Closure $closure)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Field;

Text::make('Title')
    ->beforeRender(function(Field $field) {
        return $field->preview();
    })
```

<a name="conditional-methods"></a>
### Условные методы

Отображать компонент можно по условию, воспользовавшись методом `canSee()`.

```php
Text::make('Name')
    ->canSee(function (Text $field) {
        return $field->toValue() !== 'hide';
    })
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

// или для полей отношений
BelongsTo::make('Item', 'item', resource: ItemResource::class)
    ->canSee(function (Comment $comment, BelongsTo $field) {
        // ваше условие
    })
```

Метод `when()` реализует _fluent interface_ и выполнит callback, когда первый аргумент, переданный методу, имеет значение true.

```php
when(
    $value = null,
    ?callable $callback = null,
    ?callable $default = null
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Field;

Text::make('Slug')
    ->when(
        fn() => true,
        fn(Field $field) => $field->locked()
    )
```

Метод `unless()` обратный методу `when()`.

```php
unless(
    $value = null,
    ?callable $callback = null,
    ?callable $default = null
)
```

<a name="apply"></a>
### Apply

У каждого поля реализован метод `apply()`, который трансформирует данные.
Чтобы переопределить стандартный `apply` у поля, можно воспользоваться методом `onApply()`.
Подробнее *о цикле жизни применения поля* можно прочитать в разделе [Основы > Процесс применения полей](/docs/{{version}}/fields/index#apply).

```php
/**
 * @param  Closure(mixed, mixed, FieldContract): mixed  $onApply
 */
onApply(Closure $onApply)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Fields\Text;

Text::make('Thumbnail by link', 'thumbnail')
    ->onApply(function(Model $item, $value, Field $field) {
        $path = 'thumbnail.jpg';

        if ($value) {
            $item->thumbnail = Storage::put($path, file_get_contents($value));
        }

        return $item;
    })
```

Пример `onApply` для фильтров:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Text;
use Illuminate\Contracts\Database\Eloquent\Builder;

Text::make('Title')
    ->onApply(function (Builder $query, mixed $value, Text $field) {
        $query->where('title', $value);
    })
```

Для того чтобы выполнить какие-либо действия до "apply", можно воспользоваться методом `onBeforeApply()`.

```php
/**
 * @param  Closure(mixed, mixed, FieldContract): static  $onBeforeApply
 */
onBeforeApply(Closure $onBeforeApply)
```

Для того чтобы выполнить какие-либо действия после "apply", можно воспользоваться методом `onAfterApply()`.

```php
/**
 * @param  Closure(mixed, mixed, FieldContract): static  $onBeforeApply
 */
onAfterApply(Closure $onBeforeApply)
```

Выполнять метод `apply()` можно по условию, воспользовавшись методом `canApply()`.

```php
canApply(Closure $canApply)
```

```php
Text::make('Title')
    ->canApply(fn() => false)
```

Метод `refreshAfterApply()` инициирует ререндер поля после "применения".
Так же можно влиять на этот процесс через колбэк.

```php
refreshAfterApply(?Closure $callback = null)
```

```php
Text::make('Title')
    ->refreshAfterApply(fn(Text $ctx) => $ctx)
```

У полей `File` эта функция включена по умолчанию для обновления "preview".
Это поведение можно отключить с помощью метода `disableRefreshAfterApply()` или переопределить в соответствии со своей логикой.

```php
Image::make('Avatar')
    ->disableRefreshAfterApply()
```

```php
Image::make('Avatar')
    ->refreshAfterApply(fn(Image $ctx) => $ctx)
```

#### Глобальное определение apply логики

Если вы хотите глобально для определенного поля изменить логику `apply`, то вы можете создать `apply` класс и привязать его к необходимому полю.

Для начала создайте `apply` класс:

```shell
php artisan moonshine:apply FileModelApply
```

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#apply).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ApplyContract;
use MoonShine\Contracts\UI\FieldContract;

/**
 * @implements ApplyContract<File>
 */
final class FileModelApply implements ApplyContract
{
    /**
     * @param  File  $field
     */
    public function apply(FieldContract $field): Closure
    {
        return function (mixed $item) use ($field): mixed {
            $requestValue = $field->getRequestValue();

            $newValue = // ...

            return data_set($item, $field->getColumn(), $newValue);
        };
    }
}
```

Далее зарегистрируйте его для поля:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use App\MoonShine\Applies\FileModelApply;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\AppliesRegisterContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Applies\AppliesRegister;
use MoonShine\UI\Fields\File; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     * @param  AppliesRegister  $applies
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
        AppliesRegisterContract $applies,
    ): void
    {
        $applies
            // resource group, default ModelResource
            ->for(ModelResource::class)
            // type fields or filters
            ->fields()
            ->add(File::class, FileModelApply::class);
    }
}
```

<a name="fill"></a>
### Заполнение

Поля можно заполнить значениями, используя метод `fill()`.
Более подробно о процессе заполнения поля можно прочитать в разделе [Основы > Изменить наполнение](/docs/{{version}}/fields/index#change-fill).

```php
fill(
    mixed $value = null,
    ?DataWrapperContract $casted = null,
    int $index = 0
)
```

```php
Text::make('Title')
    ->fill('Some title')
```

#### Изменение логики наполнения поля

Для того чтобы изменить логику заполнения поля, можно использовать метод `changeFill()`.

```php
Select::make('Images')->options([
    '/images/1.png' => 'Picture 1',
    '/images/2.png' => 'Picture 2',
])
    ->multiple()
    ->changeFill(
        fn(Article $article, Select $ctx) => $article->images
            ->map(fn($value) => "https://cutcode.dev$value")
            ->toArray()
    );
```

В данном примере к путям изображений будет добавлено `https://cutcode.dev`.

#### Действия после наполнения поля

Для применения логики к уже наполненному полю можно использовать метод `afterFill()`.

> [!NOTE]
> Похожий по логике метод [when](#conditional-methods) срабатывает в момент создания экземпляра поля, когда оно еще не наполнено.
> Метод `afterFill()` работает уже с наполненным полем.

```php
Select::make('Links')->options([
    '/images/1.png' => 'Picture 1',
    '/images/2.png' => 'Picture 2',
])
    ->multiple()
    ->afterFill(
        function(Select $ctx) {
            if(collect($ctx->toValue())->every(fn($value) => str_contains($value, 'cutcode.dev'))) {
                return $ctx->customWrapperAttributes(['class' => 'full-url']);
            }

            return $ctx;
        }
    )
```

<a name="on-change"></a>
### Методы onChange

С помощью методов `onChangeMethod()` и `onChangeUrl()` можно добавить логику при изменении значений полей.

> [!NOTE]
> Методы `onChangeUrl()` или `onChangeMethod()` присутствуют у всех полей, кроме полей отношений `HasOne` и `HasMany`.

#### onChangeUrl()

```php
onChangeUrl(
    Closure $url,
    HttpMethod $method = HttpMethod::GET,
    array $events = [],
    ?string $selector = null,
    ?AsyncCallback $callback = null
)
```

- `$url` - url запроса,
- `$method` - метод асинхронного запроса,
- `$events` - вызываемые [AlpineJS события](/docs/{{version}}/frontend/js#events) после успешного запроса,
- `$selector` - selector элемента у которого будет изменяться контент,
- `$callback` - js callback функция после получения ответа.

```php
Switcher::make('Active')
    ->onChangeUrl(fn() => '/endpoint')
```

Если требуется заменить область с html после успешного запроса, вы можете в ответе вернуть HTML контент или json с ключом html.

```php
Switcher::make('Active')
    ->onChangeUrl(fn() => '/endpoint', selector: '#my-selector')
```

#### onChangeMethod()

Метод `onChangeMethod()` позволяет асинхронно вызывать метод ресурса или страницы при изменении поля без необходимости создавать дополнительные контроллеры.

```php
onChangeMethod(
  string $method,
  array|Closure $params = [],
  ?string $message = null,
  ?string $selector = null,
  array $events = [],
  ?AsyncCallback $callback = null,
  ?PageContract $page = null,
  ?ResourceContract $resource = null
)
```

- `$method` - наименование метода,
- `$params` - параметры для запроса,
- `$message` - сообщения,
- `$selector` - selector элемента у которого будет изменяться контент,
- `$events` - вызываемые [AlpineJS события](/docs/{{version}}/frontend/js#events) после успешного запроса,
- `$callback` - js callback функция после получения ответа,
- `$page` - страница содержащая метод,
- `$resource` - ресурс содержащий метод.

```php
Switcher::make('Active')
    ->onChangeMethod('someMethod')
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;

#[AsyncMethod]
public function someMethod(CrudRequestContract $request): void
{
    // Logic
}
```

<a name="change-render"></a>
### Изменение render поля

Чтобы полностью изменить render поля, можно воспользоваться методом `changeRender()`.

```php
changeRender(Closure $callback)
```

В данном поле `Select` трансформируется в текст:

```php
Select::make('Links')->options([
    '/images/1.png' => 'Picture 1',
    '/images/2.png' => 'Picture 2',
])
    ->multiple()
    ->changeRender(
        fn(?array $values, Select $ctx) => Text::make($ctx->getLabel())->fill(implode(',', $values))
    )
```

<a name="for-value"></a>
### Методы для значений

#### Получение значение из исходного

Метод `fromRaw()` позволяет добавить замыкание для получения итоговое значение из исходного.

```php
/**
 * @param  Closure(mixed $raw, static): mixed  $callback
 * @return $this
 */
fromRaw(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\Enums\StatusEnum;
use MoonShine\UI\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->fromRaw(fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw))
```

#### Получения необработанного значения

Метод `modifyRawValue()` позволяет добавить замыкание для получения необработанного значения.

```php
/**
 * @param  Closure(mixed $raw, mixed $data, static): mixed  $callback
 * @return $this
 */
modifyRawValue(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\Enums\StatusEnum;
use MoonShine\UI\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->modifyRawValue(fn(StatusEnum $raw, Order $data, Enum $ctx) => $raw->value))
```

<a name="preview-edit"></a>
## Редактирование в режиме preview

> [!NOTE]
> Редактирование в режиме preview доступно для полей `Text`, `Number`, `Checkbox`, `Select` и `Date`.

Для редактирования полей в режиме preview, например в таблице или в любом другом `IterableComponent`, существуют следующие методы.

<a name="update-on-preview"></a>
### updateOnPreview

Метод `updateOnPreview()` позволяет редактировать поле в режиме предварительного просмотра.
После внесения изменений (по событию onChange), значение поля будет сохранено для конкретного элемента.

```php
updateOnPreview(
    ?Closure $url = null,
    ?ResourceContract $resource = null,
    mixed $condition = null,
    array $events = []
)
```

 - `$url` - (опционально) url запроса,
 - `$resource` - (опционально) ресурс содержащий updateOnPreview,
 - `$condition` - (опционально) условие установки поля в режим updateOnPreview,
 - `$events` - (опционально) вызываемые [AlpineJS события](/docs/{{version}}/frontend/js#events) после успешного запроса.

> [!NOTE]
> Параметры не являются обязательными, но должны быть заданы, если поле находится вне ресурса
> или же вы хотите указать полностью свой endpoint (тогда и ресурс не нужен).

```php
Text::make('Name')->updateOnPreview()
```

<a name="with-update-row"></a>
### withUpdateRow

`withUpdateRow()` работает по аналогии с `updateOnPreview()`, но при этом может полностью обновить строку в таблице без перезагрузки страницы.

```php
withUpdateRow(string $component)
```

- `$component` - имя компонента, в котором присутствует данная строка.

```php
Text::make('Name')
    ->withUpdateRow('index-table-post-resource')
```

`withUpdateRow()` может использовать все параметры `updateOnPreview()`, например для изменения url запроса, для этого их необходимо вызвать вместе.

```php
Text::make('Name')
    ->updateOnPreview(url: '/my/url')
    ->withUpdateRow()
```

### updateInPopover

Метод `updateInPopover()` работает аналогично методу `withUpdateRow()`, но теперь все значения для редактирования появляются в отдельном окне.

```php
updateInPopover(string $component)
```

- `$component` - имя компонента, в котором присутствует данная строка.

```php
Text::make('Name')
    ->updateInPopover('index-table-post-resource')
```

> [!NOTE]
> Методы `updateOnPreview()`, `withUpdateRow()` и `updateInPopover()` формируют нужные endpoints и передают методу `setUpdateOnPreviewUrl()`,
> который работает с [onChangeUrl()](#on-change).

<a name="assets"></a>
## Ассеты

Для добавления ассетов к полю можно использовать метод `addAssets()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Css;

Text::make('Name')
    ->addAssets([
        new Css(Vite::asset('resources/css/text-field.css'))
    ])
```

Если вы реализуете собственное поле, то объявить набор ассетов в нем можно двумя способами.

1. Через метод `assets()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

/**
 * @return list<AssetElementContract>
 */
protected function assets(): array
{
    return [
        Js::make('/js/custom.js'),
        Css::make('/css/styles.css')
    ];
}
```

2. Через метод `booted()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

protected function booted(): void
{
    parent::booted();

    $this->getAssetManager()
        ->add(Css::make('/css/app.css'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="macroable"></a>
## Трейт Macroable

Всем полям доступен трейт `Illuminate\Support\Traits\Macroable` с методами `mixin()` и `macro()`.
С помощью этого трейта вы можете расширять возможности полей, добавляя в них новый функционал без использования наследования.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Field;

Field::macro('myMethod', fn() => /*реализация*/)

Text::make()->myMethod()
```

```php
Field::mixin(new MyNewMethods())
```

<a name="reactive"></a>
## Реактивность

Метод `reactive()` позволяет реактивно изменять поля.

```php
reactive(
    ?Closure $callback = null,
    bool $lazy = false,
    int $debounce = 0,
    int $throttle = 0,
    bool|Closure $silent = false,
    bool|Closure $silentSelf = false,
)
```

- `$callback` - callback функция,
- `$lazy` - отложенный вызов функции,
- `$debounce` - время между вызовами функций (ms.),
- `$throttle` - интервал вызова функций (ms.),
- `$silent` - пропустить перерендеринг поля при изменениях,
- `$silentSelf` - пропустить перерендеринг поля, если оно в данный момент редактируется.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Collections\Fields;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Text;

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

В данном пример реализовано формирование slug-поля на основе заголовка.
Slug будет генерироваться в процессе ввода текста.

> [!WARNING]
> Реактивное поле может менять состояние других полей, но не изменяет свое состояние!

Для изменения состояния поля инициирующего реактивность удобно воспользоваться параметрами callback-функции.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Collections\Fields;

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

### Пропуск перерендеринга поля

Параметр `silentSelf` позволяет пропустить перерендеринг поля, если оно в данный момент редактируется.
Это полезно, когда вы не хотите, чтобы редактируемое поле теряло фокус или сбрасывало введённые данные.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Select 1')->reactive(silentSelf: true),
```

Параметр `silent` позволяет полностью пропустить перерендеринг поля при любых изменениях.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

Select::make('Select 2')->reactive(silent: true),
```

Оба параметра также могут принимать callback-функцию для условного управления:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Select;

// Пропустить перерендеринг себя при определённом значении
Select::make('Select 1')->reactive(
    silentSelf: fn(string $value, array $values, Select $ctx): bool => $value === 'Option 2'
),

// Пропустить перерендеринг при определённом значении другого поля
Select::make('Select 2')->reactive(
    silent: fn(string $value, array $values, Select $ctx): bool => $values['select1'] === 'Option 2'
),
```

<a name="dynamic-display"></a>
## Динамическое отображение

Поля можно скрывать или показывать динамически, в зависимости от значений других полей в реальном времени без перезагрузки страницы и запросов к серверу.
Для этого используются методы `showWhen()` и `showWhenDate()`.

<a name="show-when"></a>
### Метод showWhen

Метод `showWhen()` позволяет задать условие отображения поля в зависимости от значения другого поля.

```php
showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
```

- `$column` - имя поля, от которого зависит отображение,
- `$operator` - оператор сравнения (необязательный),
- `$value` - значение для сравнения.

```php
Text::make('Name')
    ->showWhen('category_id', 1)
```

В этом примере поле "Name" будет отображаться только если значение поля "category_id" равно 1.

> [!NOTE]
> Если в функции `showWhen` передается только два параметра, то по умолчанию используется оператор `'='`.

```php
Text::make('Name')
    ->showWhen('category_id', 'in', [1, 2, 3])
```

В этом примере поле "Name" будет отображаться только если значение поля "category_id" равно 1, 2 или 3.

Когда на поле присутствует условие `showWhen`, то при скрытии этого поля, на его DOM элемент устанавливается значение `display: none`
и удаляется атрибут name, чтобы значение этого скрытого поля не попадало в итоговый запрос.
Если вы не хотите, чтобы атрибут `name` удалялся, необходимо в вашем ресурсе установить флаг `$submitShowWhen` в значение `true`.

```php
class ArticleResource extends ModelResource
{
    protected bool $submitShowWhen = true;

    // ...
}
```

<a name="show-when-date"></a>
### Метод showWhenDate

Метод `showWhenDate()` позволяет задать условие отображения поля в зависимости от значения поля типа date.
Логика для работы с датами была вынесена в отдельный метод из-за специфики конвертации и сравнения
типа date и datetime на backend и frontent.

```php
showWhenDate(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
```

- `$column` - имя поля с датой, от которого зависит отображение,
- `$operator` - оператор сравнения (необязательный),
- `$value` - значение даты для сравнения.

```php
Text::make('Content')
    ->showWhenDate('created_at', '>', '2024-09-15 10:00')
```

В этом примере поле "Content" будет отображаться только если значение поля "created_at" больше '2024-09-15 10:00'.

> [!NOTE]
> Если в функции `showWhenDate` передается только два параметра, то по умолчанию используется оператор `'='`.

> [!NOTE]
> Вы можете использовать любой формат даты, который может быть распознан функцией `strtotime()`.

<a name="show-when-row"></a>
### Метод showWhenRow

> [!WARNING]
> Экспериментальная функция.

Метод `showWhenRow()` позволяет задать условие отображения поля внутри `Json` (табличный режим) в зависимости от значения другого поля в той же строке таблицы.

```php
showWhenRow(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
```

- `$column` - имя поля в той же строке, от которого зависит отображение,
- `$operator` - оператор сравнения (необязательный),
- `$value` - значение для сравнения.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

Json::make('Options')->fields([
    Select::make('Type')->options([
        1 => 'First',
        2 => 'Second',
    ]),
    Text::make('Value')->showWhenRow('type', 1),
])
```

В этом примере поле "Value" будет отображаться только в тех строках, где значение поля "Type" равно 1.

> [!NOTE]
> Если в функции `showWhenRow` передается только два параметра, то по умолчанию используется оператор `'='`.

> [!NOTE]
> Метод `showWhenRow()` работает только внутри поля `Json` в табличном режиме.

<a name="nested-fields"></a>
### Вложенные поля

Методы `showWhen()` и `showWhenDate()` поддерживают работу с вложенными полями, например для работы с полем `Json`.
Для обращения к вложенным полям используется точечная нотация.

```php
Text::make('Parts')
    ->showWhen('attributes.1.size', '!=', 2)
```

В этом примере поле "Parts" будет отображаться только если значение вложенного поля "size" во втором элементе массива "attributes" не равно 2.

`showWhen()` работает и для вложенных полей типа `Json`:

```php
Json::make('Attributes', 'attributes')->fields([
    Text::make('Size'),
    Text::make('Parts')
        ->showWhen('category_id', 3),
    Json::make('Settings', 'settings')->fields([
        Text::make('Width')
            ->showWhen('category_id', 3),
        Text::make('Height'),
    ])
]),
```
В данном примере весь столбец `Parts` внутри `attributes` и весь столбец `Width` внутри `attributes.[n].settings`
будет отображаться только если значение поля `category_id` равно 3.

<a name="multiple-conditions"></a>
### Множественные условия

Методы `showWhen()` и `showWhenDate()` могут быть вызваны несколько раз для одного поля, что позволяет задать несколько условий отображения.

```php
BelongsTo::make('Category', 'category', resource: CategoryResource::class)
    ->showWhenDate('created_at', '>', '2024-08-05 10:00')
    ->showWhenDate('created_at', '<', '2024-08-05 19:00')
```

В этом примере поле `category` будет отображаться только если значение поля `created_at` находится
в диапазоне между '2024-08-05 10:00' и '2024-08-05 19:00'.

> [!NOTE]
> При использовании нескольких условий они объединяются логическим "И" (AND).
> Поле будет отображаться только если выполняются все заданные условия.

<a name="supported-operators"></a>
### Поддерживаемые операторы

- `=`
- `!=`
- `>`
- `<`
- `>=`
- `<=`
- `in`
- `not in`

> [!NOTE]
> Оператор `in` проверяет, содержится ли значение в массиве.
> Оператор `not in` проверяет, не содержится ли значение в массиве.

<a name="custom"></a>
## Кастомное поле

Вы можете создать собственное поле, со своим view и логикой и использовать его в административной панели **MoonShine**.
Для этого воспользуйтесь командой:

```shell
php artisan moonshine:field
```

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#field).
