# Форма и события

При успешном запросе форма обновляет таблицу и сбрасывает значения.

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

Давайте также рассмотрим, как добавить свои собственные события:

```blade
<div x-data=""
     @form_updated:my-event.window="alert()"
>
</div>
```

Вы также можете воспользоваться удобной директивой `defineEvent`, которая сделает то же самое что и пример выше:

```blade
<div
  x-data=""
  @defineEvent('form_updated', 'my-event', 'alert()')
>
</div>
```

Итоговый пример:

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
