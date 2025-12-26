# Box

- [Basics](#basics)
- [Heading](#heading)
- [Dark Style](#dark)
- [Icon](#icon)

---

<a name="basics"></a>
## Basics

To highlight content, you can use the `Box` component. The component is perfect for highlighting areas.

```php
make(
    Closure|string|iterable $labelOrComponents = [],
    iterable $components = []
)
```

- `$labelOrComponents` - contains components to display in the block or text for the heading. If the first parameter is a string, then it is the heading,
- `$components` - contains components to display in the block. Used when the first parameter specifies the heading.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Alert;

Box::make([
    Alert::make()->content('Text')
]);
```
tab: Blade
```blade
<x-moonshine::layout.box>
    {{ 'Hello!' }}
</x-moonshine::layout.box>
```
~~~

@preview('box')

<a name="heading"></a>
## Heading

If you need to display a heading, simply pass it as the first parameter and a list of components as the second.

~~~tabs
tab: Class
```php
Box::make('Title box', ['Hello!']);
```
tab: Blade
```blade
<x-moonshine::layout.box title="Title box">
    {{ 'Hello!' }}
</x-moonshine::layout.box>
```
~~~

<a name="dark"></a>
## Dark Style

You can set a dark style for the box using the `dark()` method in the class.

~~~tabs
tab: Class
```php
Box::make(['Hello!'])->dark();
```
tab: Blade
```blade
<x-moonshine::layout.box dark>
    {{ 'Hello!' }}
</x-moonshine::layout.box>
```
~~~

<a name="icon"></a>
## Icon

To display an icon in the box, use the `icon()` method.

~~~tabs
tab: Class
```php
Box::make('Title box', ['Hello!'])->icon('users');
```
tab: Blade
```blade
<x-moonshine::layout.box title="Title box">
    <x-moonshine::icon name="users"></x-moonshine::icon>
    {{ 'Hello!' }}
</x-moonshine::layout.box>
```
~~~
