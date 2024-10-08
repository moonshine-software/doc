# FormBuilder

- [Основы](#basics)
- [Поля](#fields)
- [Заполнение полей](#fill-fields)
- [Приведение типов](#casting)
- [FillCast](#fillcast)
- [Кнопки](#buttons)
- [Атрибуты](#attributes)
- [Имя формы](#form-name)
- [Асинхронный режим](#asynchronous-mode)
- [Отображение ошибок валидации](#displaying-validation-errors)
- [Прекогнитивная валидация](#precognitive)
- [Применение](#apply)
- [Вызов методов](#calling-methods)
- [Отправка событий](#dispatch-events)
- [Событие "Submit"](#submit-event)

---

<a name="basics"></a>
## Основы

Поля и декорации в *FormBuilder* используются внутри форм, которые обрабатываются FormBuilder. Благодаря *FormBuilder* поля отображаются и заполняются данными. Вы также можете использовать *FormBuilder* на своих собственных страницах или даже за пределами **MoonShine**.

```php
make(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
```

- `action` - обработчик
- `method` - тип запроса,
- `fields` - поля и декорации.
- `values` - значения полей.

```php
FormBuilder::make(
    action:'/crud/update',
    method: 'PUT',
    fields: [
        Text::make('Text')
    ],
    values: ['text' => 'Value']
)
```

То же самое через методы:

```php
FormBuilder::make()
    ->action('/crud/update')
    ->method('PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
```

Также доступен хелпер:

```php
{!! form(request()->url(), 'GET')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
!!}
```

<a name="fields"></a>
## Поля

Метод `fields()` для объявления полей формы и декораций:

```php
fields(Fields|Closure|array $fields)
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
```

<a name="fill-fields"></a>
## Заполнение полей

Метод `fill()` для заполнения полей значениями:

```php
fill(mixed $values = [])
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value'])
```

<a name="casting"></a>
## Приведение типов

Метод `cast()` для приведения значений формы к определенному типу. Поскольку по умолчанию поля работают с примитивными типами:

```php
cast(MoonShineDataCast $cast)
```

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    )
```

В этом примере мы приводим данные к формату модели `User`, используя `ModelCast`.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts)

<a name="fillcast"></a>
## FillCast

Метод `fillCast()` позволяет привести данные к определенному типу и сразу заполнить их значениями:

```php
fillCast(mixed $values, MoonShineDataCast $cast)
```

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    )
```

или

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        User::query()->first(),
        ModelCast::make(User::class)
    )
```

<a name="buttons"></a>
## Кнопки

Кнопки формы можно модифицировать и добавлять.

Для настройки кнопки "submit" используйте метод `submit()`.

```php
submit(string $label, array $attributes = [])
```

- `label` - название кнопки,
- `attributes` - дополнительные атрибуты

```php
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Нажми меня', attributes: ['class' => 'btn-primary'])
```

Метод `hideSubmit()` позволяет скрыть кнопку **"submit"**.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->hideSubmit()
```

Для добавления новых кнопок на основе `ActionButton` используйте метод `buttons()`

```php
buttons(array $buttons = [])
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Удалить', route('name.delete'))
    ])
```

<a name="attributes"></a>
## Атрибуты

Вы можете установить любые html атрибуты для формы с помощью метода `customAttributes()`.

```php
FormBuilder::make()
    ->customAttributes(['class' => 'custom-form'])
```

<a name="form-name"></a>
## Имя формы

Метод `name()` позволяет установить уникальное имя для формы, через которое можно поднимать события.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form')
```

<a name="asynchronous-mode"></a>
## Асинхронный режим

Если необходимо отправить форму асинхронно, используйте метод `async()`.

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```

- `asyncUrl` - url запроса (по умолчанию запрос отправляется по url action),
- `asyncEvents` - события, поднимаемые после успешного запроса,
- `asyncCallback` - js callback функция после получения ответа.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->async()
```

После успешного запроса можно поднимать события, добавив параметр `asyncEvents`.

```php
FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
```

В **MoonShine** уже есть набор готовых событий:
- `table-updated-{name}` - обновление асинхронной таблицы по ее имени,
- `form-reset-{name}` - сброс значений формы по ее имени,
- `fragment-updated-{name}` - обновляет blade фрагмент по его имени.

> [!NOTE]
> Рецепт [При успешном запросе форма обновляет таблицу и сбрасывает значения](https://moonshine-laravel.com/docs/resource/recipes/recipes#form-with-events)

>[!WARNING]
>Метод `async()` должен идти после метода `name()`!

<a name="displaying-validation-errors"></a>
## Отображение ошибок валидации

По умолчанию ошибки валидации отображаются в верхней части формы.

Метод `errorsAbove(bool $enable = true)` используется для управления отображением ошибок валидации в верхней части формы. Он позволяет включить или отключить эту функцию.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->errorsAbove(false)
```

<a name="precognitive"></a>
## Прекогнитивная валидация

Если необходимо сначала выполнить прекогнитивную валидацию, вам нужен метод `precognitive()`.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive()
```

<a name="apply"></a>
## Применение

Метод `apply()` в *FormBuilder* итерирует все поля формы и вызывает их методы apply.

```php
apply(
    Closure $apply,
    ?Closure $default = null,
    ?Closure $before = null,
    ?Closure $after = null,
    bool $throw = false,
)
```
- `$apply` - функция обратного вызова;
- `$default` - применение для поля по умолчанию;
- `$before` - функция обратного вызова перед применением;
- `$after` - функция обратного вызова после применения;
- `$throw` - выбрасывать исключения.

#### Примеры

Необходимо сохранить данные всех полей *FormBuilder* в контроллере:

```php
$form->apply(fn(Model $item) => $item->save());
```

Более сложный вариант, с указанием событий до и после сохранения:

```php
$form->apply(
    static fn(Model $item) => $item->save(),
    before: function (Model $item) {
        if (! $item->exists) {
            $item = $this->beforeCreating($item);
        }

        if ($item->exists) {
            $item = $this->beforeUpdating($item);
        }

        return $item;
    },
    after: function (Model $item) {
        $wasRecentlyCreated = $item->wasRecentlyCreated;

        $item->save();

        if ($wasRecentlyCreated) {
            $item = $this->afterCreated($item);
        }

        if (! $wasRecentlyCreated) {
            $item = $this->afterUpdated($item);
        }

        return $item;
    },
    throw: true
);
```

<a name="calling-methods"></a>
## Вызов методов

`asyncMethod()` позволяет указать имя метода в ресурсе и вызвать его асинхронно при отправке *FormBuilder* без необходимости создания дополнительных контроллеров.

```php
public function components(): array
{
    return [
        FormBuilder::make()
            ->asyncMethod('updateSomething'),
    ];
}
```

```php
// С уведомлением
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('Мое сообщение', 'success');

    return back();
}

// Исключение
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('Мое сообщение');
}

// Пользовательский json ответ
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('Мое сообщение', ToastType::SUCCESS);
}
```

<a name="dispatch-events"></a>
## Отправка событий

Для отправки javascript событий можно использовать метод `dispatchEvent()`.

```php
dispatchEvent(array|string $events)
```

```php
FormBuilder::make()
    ->dispatchEvent(JsEvent::OFF_CANVAS_TOGGLED, 'default'),
```

<a name="submit-event"></a>
## Событие "Submit"

Для отправки формы можно вызвать событие *Submit*.

```php
AlpineJs::event(JsEvent::FORM_SUBMIT, 'componentName')
```

#### Пример вызова события на странице формы

```php
public function formButtons(): array
{
    return [
       ActionButton::make('Сохранить')->dispatchEvent(AlpineJs::event(JsEvent::FORM_SUBMIT, $this->uriKey()))
    ];
}
```

> [!NOTE]
> Для получения дополнительной информации о помощниках AlpineJs обратитесь к разделу [Js events](https://moonshine-laravel.com/docs/resource/advanced/advanced-js_events#helper).

