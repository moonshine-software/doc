# Fragment

- [Основы](#basics)
- [Асинхронное взаимодействие](#async)
- [Автообновление](#auto-update)

---

<a name="basics"></a>
## Основы

`Fragment` позволяет обернуть определённую область страницы и обновлять только её при вызове событий.
Компонент использует для этого Laravel Blade директиву [`@fragment`](https://laravel.com/docs/blade#rendering-blade-fragments).

```php
make(iterable $components = [])
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Components\Fragment;
use MoonShine\UI\Fields\Text;

protected function components(): iterable
{
    return [
        Fragment::make([
            Text::make('Name', 'first_name')
        ])->name('fragment-name')
    ];
}
```

<a name="async"></a>
## Асинхронное взаимодействие

### Обновление через события

```php
Fragment::make($components)->name('fragment-name'),
```

Например, вызовем событие при успешной отправке формы:

```php
FormBuilder::make()
    ->async(events: AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-name'))
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
Рассмотрим пример обновления фрагментов поочередно при нажатии на кнопку:

```php
Fragment::make([
    FlexibleRender::make('<p> Step 1: ' . time() . '</p>')
])
    ->updateWith(
        events: [
            AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fg-step-2'),
        ],
    )
    ->name('fg-step-1'),

Fragment::make([
    FlexibleRender::make('<p> Step 2: ' . time() . '</p>')
])
    ->name('fg-step-2'),

// ...

ActionButton::make('Start')
    ->dispatchEvent([AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fg-step-1')]),
```

### Обработка ответа

> [!NOTE]
> Подробности в разделе [Js](/docs/{{version}}/frontend/js#response-calback)

```php
Fragment::make($components)
    ->updateWith(
        callback: AsyncCallback::with(afterResponse: 'afterResponseFunction')
    )
    ->name('fragment-name'),
```

### Параметры запроса URL

Вы можете включить параметры текущего URL запроса (например, `?param=value`) в запрос фрагмента.

Это позволит сохранить все параметры из URL строки текущего запроса при загрузке фрагмента.

```php
Fragment::make($components)
    ->name('fragment-name')
    ->withQueryParams(),
```

<a name="auto-update"></a>
## Автообновление

Метод `autoUpdate()` позволяет автоматически обновлять содержимое фрагмента с заданным интервалом.

```php
autoUpdate(int $ms)
```

- `$ms` — интервал обновления в миллисекундах (должен быть больше 0).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Components\Fragment;
use MoonShine\UI\Components\Metrics\ValueMetric;

Fragment::make([
    ValueMetric::make('Metric')
        ->value(random_int(1, 1000))
        ->columnSpan(6),
])
    ->name('fragment-metric')
    ->withQueryParams()
    ->autoUpdate(5000),
```

В данном примере фрагмент с метрикой будет автоматически обновляться каждые 5 секунд.
