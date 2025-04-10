# Form and Events

Upon a successful request, the form updates the table and resets the values.

```php
FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(events: [
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'main-table'),
        AlpineJs::event(JsEvent::FORM_RESET, 'main-form')
    ]),

TableBuilder::make()
    ->fields([
        ID::make(),
        Text::make('Title'),
        Textarea::make('Body'),
    ])
    ->name('main-table')
    ->async()
```

Let's also look at how to add your own events:

```blade
<div x-data=""
     @form_updated:my-event.window="alert()"
>
</div>
```

You can also use the convenient directive `defineEvent`, which will do the same thing as the example above:

```blade
<div
  x-data=""
  @defineEvent('form_updated', 'my-event', 'alert()')
>
</div>
```

Final example:

```blade
<div x-data="my"
     @defineEvent('form_updated', 'my-event', 'asyncRequest')
>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("my", () => ({
            init() {

            },
            asyncRequest() {
                this.$event.preventDefault()

                // this.$el
                // this.$root
            }
        }))
    })
</script>
```

```php
FormBuilder::make(route('form-table.store'))
    ->fields([
        Text::make('Title')
    ])
    ->name('main-form')
    ->async(events: ['form_updated:my-event'])
```
