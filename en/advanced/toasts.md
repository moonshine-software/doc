# Toasts

- [Flash](#flash)
- [JsonResponse](#response)
- [Events](#events)
- [Duration](#duration)

---

<a name="flash"></a>
## Flash

Toast notifications use the session mechanism (`session()->flash()`) and can be easily triggered directly from controllers.

```php
use MoonShine\Support\Enums\ToastType;

MoonShineUI::toast(message: 'Hello');
```

You can also specify the notification type and duration:

```php
MoonShineUI::toast(
    message: 'Success',
    type: ToastType::SUCCESS,
    duration: 3000
);
```

- `$type` - sets the color of the notification.
- `$duration` - sets the duration for which the notification is displayed (milliseconds). By default, notifications are displayed for 2 seconds.

If you want the toast to remain visible until manually clicked:

```php
MoonShineUI::toast(message: 'Success', duration: false);
```

<a name="response"></a>
## JsonResponse

```php
JsonResponse::make()
    ->toast('Test', type: ToastType::SUCCESS, duration: 1000);
```

> [!TIP]
> If you need to change toast notifications in ModelResource, see [ModelResource > Response modifiers](/docs/{{version}}/model-resource/index#response-modifiers) section.

> [!NOTE]
> The parameters used are the same as described above.

<a name="events"></a>
## Events

```php
ActionButton::make('Toast')->dispatchEvent(
    AlpineJs::event(
        JsEvent::TOAST, params: ToastEventParams::make(ToastType::SUCCESS, 'Hello', duration: 2000)
    )
);
```

> [!NOTE]
> The parameters used are the same as described above.

<a name="duration"></a>
## Duration

You can include a JavaScript snippet to globally override the toast display duration:

```js
MoonShine.config().setToastDuration(5000);
```
