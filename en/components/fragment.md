# Fragment

- [Basics](#basics)
- [Asynchronous Interaction](#async)

---

<a name="basics"></a>
## Basics

With `Fragment`, you can wrap a specific area of your page and update only that area by triggering events.
For this, you can use [Blade Fragments](https://laravel.com/docs/blade#rendering-blade-fragments).

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
## Asynchronous Interaction

### Update via Events

```php
Fragment::make($components)->name('fragment-name'),
```

As an example, let's trigger an event upon successful form submission:

```php
FormBuilder::make()->async(events: AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-name'))
```

You can also pass additional parameters with the request via an array:

```php
Fragment::make($components)
    ->name('fragment-name')
    ->updateWith(params: ['resourceItem' => request('resourceItem')]),
```

### Passing Parameters

The method `withSelectorsParams()` allows you to pass field values with the request using element selectors.

```php
Fragment::make($components)
    ->withSelectorsParams([
        'start_date' => '#start_date',
        'end_date' => '#end_date'
    ])
    ->name('fragment-name'),
```

### Triggering Events

Upon successful update, `Fragment` can also trigger additional events.
Let's consider an example of updating fragments one after another when clicking a button:

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

### Response Handling

> [!NOTE]
> Details in the [Js](/docs/{{version}}/frontend/js#response-calback) section

```php
Fragment::make($components)
    ->updateWith(
        callback: AsyncCallback::with(afterResponse: 'afterResponseFunction')
    )
    ->name('fragment-name'),
```

### URL Query Parameters

You can include parameters of the current URL request (e.g., `?param=value`) in the fragment request:

This will preserve all parameters from the current request URL when loading the fragment.

```php
Fragment::make($components)
    ->name('fragment-name')
    ->withQueryParams(),
```
