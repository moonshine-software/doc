# Head

- [Basics](#basics)
- [Page Title](#title)
- [Theme Color](#theme)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `Head` component is designed to place document information: metadata (such as the window title or encoding), links to scripts, and stylesheets.

> [!NOTE]
> The `Head` component contains some standard metadata by default.

```php
make(array|iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Head;

Head::make([
    Meta::make('csrf-token')->customAttributes([
        'content' => 'token',
    ]),
]);
```
tab: Blade
```blade
<x-moonshine::layout.head>
    <meta name="csrf-token" content="token" />
</x-moonshine::layout.head>
```
~~~

> [!NOTE]
> Parent component: [Html](/docs/{{version}}/components/html). \
> Child components: [Meta](/docs/{{version}}/components/meta), [Assets](/docs/{{version}}/components/assets), [Favicon](/docs/{{version}}/components/favicon).

<a name="title"></a>
## Page Title

To set the page title, you can use the `title()` method or specify the corresponding parameter in the Blade component.

~~~tabs
tab: Class
```php
title(string $title);
```
```php
Head::make([
    // ...
])
    ->title('Page Title');
```
tab: Blade
```blade
<x-moonshine::layout.head title='Page Title'>
    // ...
</x-moonshine::layout.head>
```
~~~

<a name="theme"></a>
## Theme Color

Some browsers allow you to suggest a theme color based on your site's palette.
The browser's interface will adapt to the suggested color.

To add a color, you need to use the `bodyColor()` method or specify the corresponding parameter in the Blade component.

~~~tabs
tab: Class
```php
bodyColor(string $color);
```
```php
Head::make([
    // ...
])
    ->bodyColor('#7843e9')
```
tab: Blade
```blade
<x-moonshine::layout.head bodyColor='#7843e9'>
    // ...
</x-moonshine::layout.head>
```
~~~
