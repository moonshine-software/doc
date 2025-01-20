# Асинхронный ActionButton с параметрами и событиями

> [!NOTE]
> Для простоты принято, что:
> - в запросе надо передать один параметр — `model_id`,
> - после запроса надо вызвать одно событие — обновить [фрагмент](/docs/{{version}}/components/fragment) `fragment-id`.

## Передача заранее известного параметра
Достаточно указать параметры в роуте.
Запрос к [своему роуту](/docs/{{version}}/advanced/routes):
```php
ActionButton::make('Метод контроллера', route('moonshine.my.endpoint', ['model_id' => $modelId]))
  ->async(events: [AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-name')]);
```
Если запрашивается [метод ресурса](/docs/{{version}}/components/action-button#method):
``` php
ActionButton::make('Метод ресурса')
  ->method(
    method: 'asyncMethodName',
    params: ['model_id' => $modelId],
    events: [AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id')]
  );
```

## Передача параметра от пользователя
Потребуется создать форму и отобразить её в модальном окне.
Кнопка теперь не отправляет запрос, а лишь показывает модальное окно, внутри которого надо асинхронно отправить форму. Все параметры запроса и последующих событий должны быть указаны у формы:
```php
ActionButton::make('Метод контроллера с формой')
  ->inModal(
    name: 'modal-async-1',
    builder: fn (Modal $modal, ActionButtonContract $ctx) => $modal->setComponents([
      FormBuilder::make(
        action: route('moonshine.my.endpoint'),
        fields: [
          Text::make('model_id')
            ->required(),
        ]
      )
        ->name('form-async-1')
        ->async(events: [AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id')]),
    ])
  );
```
Если надо обратиться к асинхронному методу ресурса:
```php
FormBuilder::make(action: $resource->getAsyncMethodUrl('asyncMethodName'));
```
> [!TIP]
> Чтобы очистить форму после завершения запроса, можно добавить событие очистки формы:
> ```php
> $formBuilder->async(
>   events: [
>     AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id'),
>     AlpineJs::event(JsEvent::FORM_RESET, 'form-async-1)
>   ]
> );
> ```
> Либо вызывать событие очистки формы при каждом закрытии модального окна:
> ```php
> $modal->toggleEvents([AlpineJs::event(JsEvent::FORM_RESET, 'form-async-1')], onlyClosing: true);
> ```

> [!TIP]
>  Можно не настраивать каждый раз события в методе `async()`, а вернуть их с ответом из контроллера/метода:
> ```php
> return MoonShineJsonResponse::make()
>   ->events([AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id']);
> ```

> [!WARNING]
> Не получится одновременно задать события и в ответе и в форме — в таком случае будут взваны только события, переданные с ответом.
> Указанное поведение справедливо для **MoonShine** версии 3.3.2 

## Хэлпер `withConfirm()`
[`withConfirm()`](docs/{{version}}/components/action-button#confirm) создаёт модальное окно-подтверждение с формой внутри, перенимая заданный кнопке url.
Используя его, можно сократить предыдущий пример — лишь задать поля и события:
```php
ActionButton::make('Метод контроллера с Confirm', route('moonshine.async.endpoint'))
  ->withConfirm(
    fields: [Text::make('model_id')->required()],
    formBuilder: fn (FormBuilder $formBuilder) => $formBuilder
      ->async(events: [AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id']),
  );
```
Если надо обратиться к методу ресурса, то можно применить `method()` к кнопке, а `withConfirm()` перенимет url:
```php
ActionButton::make('Ресурс с Confirm')
  ->method('asyncMethod')
  ->withConfirm(
    fields: [Text::make('model_id')->required()],
    formBuilder: fn (FormBuilder $formBuilder) => $formBuilder
      ->async(events: [AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'fragment-id'])
  );
```
> [!NOTE]
> `inModal()` — «каноничный» и более гибкий способ настройки модального окна и его содержимого.
> Однако, `withConfirm()` также предоставляет замыкания для настройки формы и окна.


## Бонус: только JavaScript
Технически можно реализовать запрос без модальных окон на [событии клика](/docs/{{version}}/components/action-button#onclick):
```php
ActionButton::make('Контроллер с JS')
  ->onClick(
    fn () => "MoonShine.request(\$data, '/admin/async/endpoint', 'post', {model_id: prompt('ID модели?')});",
    'prevent'
  );
```
[`MoonShine.request()`](/docs/{{version}}/frontend/js#js-core) отправит запрос и примет ответ, вызвав переданные с ответом события.
> [!WARNING]
> Разумеется, `prompt()` здесь только для примера, разумнее вызывать свою функцию или Alpine-компонент.

Этим способом можно сделать быстрое подтверждения действия средствами браузера:
```php
$actionButton->onClick(fn () => "confirm('Точно сделать?') && MoonShine.request();",
```
