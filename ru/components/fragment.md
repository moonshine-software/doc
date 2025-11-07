# Fragment

- [Основы](#basics)
- [Асинхронное взаимодействие](#async)

---

<a name="basics"></a>
## Основы

С помощью `Fragment` вы можете обернуть определенную область вашей страницы и обновлять только её, вызывая события.
Для этого вы можете использовать [Blade Fragments](https://laravel.com/docs/blade#rendering-blade-fragments).
`Fragment` позволяет реализовать эту возможность.

```php
make(iterable $components = [])
```

```php
use MoonShine\Crud\Components\Fragment;
use MoonShine\UI\Fields\Text;

// ...

protected function components(): iterable
{
    return [
        Fragment::make([
            Text::make('Имя', 'first_name')
        ])->name('fragment-name')
    ];
}

// ...
```

<a name="async"></a>
## Асинхронное взаимодействие

### Обновление через события

```php
Fragment::make($components)->name('fragment-name'),
```

И в качестве примера давайте вызовем событие при успешной отправке формы:

```php
FormBuilder::make()->async(events: AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-name'))
```

Вы также можете передать дополнительные параметры с запросом через массив:

```php
Fragment::make($components)
    ->name('fragment-name')
    ->updateWith(params: ['resourceItem' => request('resourceItem')]),
```

### Передача параметров

Метод `withSelectorsParams()` позволяет передавать значения полей с запросом, используя селекторы элементов.

```php
Fragment::make($components)
    ->withSelectorsParams([
        'start_date' => '#start_date',
        'end_date' => '#end_date'
    ])
    ->name('fragment-name'),
```

### Вызов событий

При успешном обновлении `Fragment` может также вызвать дополнительные события.
Давайте рассмотрим пример обновления фрагментов друг за другом при клике на кнопку:

```php
Fragment::make([
    FlexibleRender::make('<p> Step 1: ' . time() . '</p>')
])
    ->updateWith(
        events: [
            AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fg-step-2'),
        ],
    )
    ->name('fg-step-1')
,

Fragment::make([
    FlexibleRender::make('<p> Step 2: ' . time() . '</p>')
])
    ->name('fg-step-2')
,
// ...
ActionButton::make('Start')->dispatchEvent([AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fg-step-1')])
,
```

### Обработка ответа

> [!NOTE]
> Подробности в разделе [Js](/docs/{{version}}/frontend/js#response-calback)

```php
Fragment::make($components)
    ->updateWith(
        callback: AsyncCallback::with(afterResponse: 'afterResponseFunction')
    )
    ->name('fragment-name')
,
```

### Параметры запроса URL

Вы можете включить параметры текущего запроса URL (например, `?param=value`) в запрос фрагмента:

Это позволит сохранить все параметры из URL строки текущего запроса при загрузке фрагмента.

```php
Fragment::make($components)
    ->name('fragment-name')
    ->withQueryParams()
,
```
