# StackFields

- [Основы](#basics)
- [Изменение отображения](#edit-view)
- [Отображение по условию](#view-condition)

---

<a name="basics"></a>
## Основы

Поле `StackFields` позволяет группировать поля при отображении в предварительном просмотре.

Метод `fields()` должен принимать массив полей для группировки.

```php
use MoonShine\UI\Fields\BelongsTo;
use MoonShine\UI\Fields\StackFields;
use MoonShine\UI\Fields\Text;

StackFields::make('Title')->fields([
    Text::make('Title'),
    BelongsTo::make('Author', resource: 'name'),
])
```

<a name="edit-view"></a>
## Изменение отображения

Вы можете кастомизировать отображение для `StackFields` с помощью компонентов:

```php
StackFields::make('Title')->fields([
    Text::make('Title'),
    LineBreak::make(), // добавляет перенос строки
    BelongsTo::make('Author', resource: 'name'),
])
```

<a name="view-condition"></a>
## Отображение по условию

Чтобы при определенных условия изменялся набор компонентов у StackFields, необходимо передать условие и наборы компонентов с помощью callback функции.

```php
StackFields::make('Stack')->fields(fn(StackFields $ctx) => $ctx->getData()?->getOriginal()->id === 3 ? [
    Date::make(__('moonshine::ui.resource.created_at'), 'created_at')
        ->format("d.m.Y")
        ->sortable(),
] : [
    Date::make(__('moonshine::ui.resource.created_at'), 'created_at')
        ->format("d.m.Y")
        ->sortable(),
    LineBreak::make(),
    Email::make(__('moonshine::ui.resource.email'), 'email')
        ->sortable(),
])
```
