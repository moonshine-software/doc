# Hidden ID

- [Создание](#make)
- [Использование](#use)

---

Поле _HiddenIds_ используется для передачи первичного ключа выбранных элементов.

<a name="make"></a>
## Создание

Метод `make()` принимает имя компонента в качестве параметра.

```php
HiddenIds::make('index-table')
```

Таблица должна содержать поле [ID](https://moonshine-laravel.com/docs/resource/fields/fields-id).

<a name="use"></a>
## Использование

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
