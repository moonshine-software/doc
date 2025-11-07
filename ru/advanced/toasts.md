# Toasts

- [Flash](#flash)
- [JsonResponse](#response)
- [Events](#events)
- [Длительность](#duration)

---

<a name="flash"></a>
## Flash

Уведомления (Toast) работают через механизм сессий (`session()->flash()`) и легко вызываются прямо из контроллера.

```php
use MoonShine\Support\Enums\ToastType;

MoonShineUI::toast(message: 'Hello');
```

Вы можете дополнительно задать тип уведомления и длительность его отображения:

```php
MoonShineUI::toast(
    message: 'Success',
    type: ToastType::SUCCESS,
    duration: 3000
);
```

- `$type` - управляет цветом уведомления,
- `$duration` - устанавливает время отображения уведомления в миллисекундах. По умолчанию уведомления отображаются 2 секунды.

Если вы хотите, чтобы уведомление не исчезало автоматически, а убиралось только после клика:

```php
MoonShineUI::toast(message: 'Success', duration: false);
```

<a name="response"></a>
## JsonResponse

```php
JsonResponse::make()
    ->toast('Test', type: ToastType::SUCCESS, duration: 1000)
```
> [!TIP]
> Если необходимо изменить уведомления в ModelResource, смотрите раздел [ModelResource > Response модификаторы](/docs/{{version}}/model-resource/index#response-modifiers).

> [!NOTE]
> Используются такие же параметры

<a name="events"></a>
## Events

```php
ActionButton::make('Toast')->dispatchEvent(
    AlpineJs::event(
        JsEvent::TOAST, params: ToastEventParams::make(ToastType::SUCCESS, 'Hello', duration: 2000)
    )
),
```

> [!NOTE]
> Используются такие же параметры

<a name="duration"></a>
## Длительность

Вы можете подключить js скрипт и глобально переопределить длительность отображения уведомлений

```js
MoonShine.config().setToastDuration(5000)
```
