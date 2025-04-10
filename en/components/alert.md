# Alert

- [Basics](#basics)
- [Notification type](#type)
- [Icon](#icon)
- [Removing notifications](#removable)

---

<a name="basics"></a>
## Basics

If you need a notification on the page, you can use the component `moonshine::alert` or the class `Alert`.

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
## Notification type

You can change the type of the notification by specifying the `type` parameter for the component.

Available types:

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
## Icon

There is an option to change the icon of the notification; for this, you need to pass it in the `icon` parameter.

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

For more detailed information, refer to the [Icons](/docs/{{version}}/appearance/icons) section.

<a name="removable"></a>
## Removing notifications

So that notifications are deleted after some time, you need to pass the `removable` parameter with the value `true`.

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
