# HiddenIds

- [Make](#make)
- [Use](#use)

---

The _HiddenIds_ field is used to pass the primary key of the selected elements.

<a name="make"></a>
## Make

The `make()` method takes the name of the component as a parameter.

```php
HiddenIds::make('index-table')
```

The table must contain the [ID](https://moonshine-laravel.com/docs/resource/fields/fields-id) field.

<a name="use"></a>
## Use

```php
use MoonShine\Components\FlexibleRender;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\HiddenIds;

//...

public function buttons(): array
{
    return [
        ActionButton::make('Active', route('moonshine.posts.mass-active', $this->uriKey()))
            ->inModal(fn () => 'Active', fn (): string => (string) form(
                route('moonshine.posts.mass-active', $this->uriKey()),
                fields: [
                    HiddenIds::make($this->listComponentName()),
                    FlexibleRender::make(__('moonshine::ui.confirm_message')),
                ]
            )
                ->async()
                ->submit('Active', ['class' => 'btn-secondary']))
            ->bulk(),
    ];
}

//...
```