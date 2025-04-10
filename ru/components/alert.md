# Alert

- [Основы](#basics)
- [Тип уведомления](#type)
- [Иконка](#icon)
- [Удаление уведомлений](#removable)

---

<a name="basics"></a>
## Основы

Если вам необходимо уведомление на странице, можно воспользоваться компонентом `moonshine::alert` или классом `Alert`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Alert;

Alert::make()->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert>Alert</x-moonshine::alert>
```
~~~

<a name="type"></a>
## Тип уведомления

Изменить тип уведомления можно указав у компонента параметр `type`.

Доступные типы:

- primary,
- secondary,
- success,
- warning,
- error,
- info.

~~~tabs
tab: Class
```php
Alert::make(type: 'primary')->content('Primary'),
Alert::make(type: 'secondary')->content('Secondary'),
Alert::make(type: 'success')->content('Success'),
Alert::make(type: 'warning')->content('Warning'),
Alert::make(type: 'error')->content('Error'),
Alert::make(type: 'info')->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert type="primary">Primary</x-moonshine::alert>
<x-moonshine::alert type="secondary">Secondary</x-moonshine::alert>
<x-moonshine::alert type="success">Success</x-moonshine::alert>
<x-moonshine::alert type="info">Info</x-moonshine::alert>
<x-moonshine::alert type="warning">Warning</x-moonshine::alert>
<x-moonshine::alert type="error">Error</x-moonshine::alert>
```
~~~

<a name="icon"></a>
## Иконка

Есть возможность изменить иконку уведомления, для этого необходимо передать её в параметр `icon`.

~~~tabs
tab: Class
```php
Alert::make(icon: "academic-cap")
    ->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert icon="academic-cap">
    Alert
</x-moonshine::alert>
```
~~~

За более подробной информацией обратитесь к разделу [Icons](/docs/{{version}}/appearance/icons).

<a name="removable"></a>
## Удаление уведомлений

Чтобы уведомления удалялись через некоторое время, необходимо передать параметр `removable` со значением `true`.

~~~tabs
tab: Class
```php
Alert::make(removable: true)
    ->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert removable="true">
    Alert
</x-moonshine::alert>
```
~~~
