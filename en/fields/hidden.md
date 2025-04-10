# Hidden

- [Basics](#basics)
- [Show Value](#show-value)

---

<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

The `Hidden` field is a hidden field that by default sets `type=hidden`.

> [!NOTE]
> The field will be hidden during form building, but will be displayed in the preview, as will its wrapper.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Hidden;

Hidden::make('category_id')
```
tab: Blade
```blade
<x-moonshine::form.input
    type="hidden"
    name="hidden_id"
/>
```
~~~

<a name="show-value"></a>
## Show Value

The field is completely hidden in the form, but if you need to maintain the field's behavior while displaying its value, you can use the `showValue()` method.

```php
Hidden::make('category_id')->showValue()
```
