# Alert

- [Основы](#basics)
- [Тип уведомления](#type)
- [Иконка](#icon)
- [Удаление уведомлений](#removable)

---
<a name="basics"></a>
## [Основы](#basics)

Если вам необходимо уведомление на странице, можно воспользоваться компонентом `moonshine::alert` или классом `Alert`.

```php
namespace MoonShine\UI\Components;
```

~~~tabs
tab: Class
```php
Alert::make()->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert>Alert</x-moonshine::alert>
```
~~~

<a name="type"></a>
## [Тип уведомления](#type)

Изменить тип уведомления можно указав у компонента `type`.

Доступные типы:

primary secondary success warning error info

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
## [Иконка](#icon)

Есть возможность у уведомления изменить иконку, для этого необходимо передать её в параметр `icon`.

~~~tabs
tab: Class
```php
Alert::make(icon: "heroicons.academic-cap)->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert icon="heroicons.academic-cap>Alert</x-moonshine::alert>
```
~~~

За более подробной информацией обратитесь к разделу [Icons](/docs/3.x/resource/appearance/icons) .

<a name="removable"></a>
## [Удаление уведомлений](#removable)

Чтобы удалять уведомления через некоторое время, необходимо передать параметр `removable` со значением `TRUE`.

~~~tabs
tab: Class
```php
Alert::make(removable: true)->content('Text'),
```
tab: Blade
```blade
<x-moonshine::alert removable="true">Alert</x-moonshine::alert>
```
~~~
