# Checkbox

- [Основы](#basics)
- [Создание](#make)
- [Значения вкл/выкл](#on-off)
- [Редактирование в режиме preview](#preview-edit)

---

<a name="basics"></a>
## Основы

Содержит все [базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Checkbox` - это поле для выбора значения типа да/нет.

<a name="make"></a>
## Создание

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Checkbox;

Checkbox::make('Publish', 'is_publish')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Publish">
    <x-moonshine::form.input
        type="checkbox"
        name="is_publish"
    />
</x-moonshine::field-container>
```
~~~

<a name="on-off"></a>
## Значения вкл/выкл

По умолчанию поле имеет значения `1` и `0` для выбранного и невыбранного состояний соответственно.
Методы `onValue()` и `offValue()` позволяют переопределить эти значения.

```php
onValue(int|string $onValue)
```

```php
offValue(int|string $offValue)
```

```php
Checkbox::make('Publish', 'is_publish')
    ->onValue('yes')
    ->offValue('no')
```

<a name="preview-edit"></a>
## Редактирование в режиме preview

Данному полю доступно [редактирование в режиме preview](/docs/{{version}}/fields/basic-methods#preview-edit).
