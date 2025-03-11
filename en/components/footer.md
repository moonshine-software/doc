# Footer

- [Basics](#basics)
- [Copyright](#copyright)
- [Menu](#menu)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `Footer` component is designed to create a footer block.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Footer;

Footer::make([
    // ...
]),
```
tab: Blade
```blade
<x-moonshine::layout.footer
    copyright="Your brand"
    :menu="['https://moonshine-laravel.com/docs' => 'Documentation']"
>
Any content
</x-moonshine::layout.footer>
```
~~~

<a name="copyright"></a>
## Copyright

The method `copyright()` allows you to create a copyright block in the footer.

```php
copyright(string|Closure $text)
```

```php
Footer::make()
    ->copyright(fn (): string => 'Your brand')
```

<a name="menu"></a>
## Menu

The `menu()` method allows you to create a menu block in the footer.

```php
/**
 * @param  array<string, string>  $data
 */
menu(array $data)
```

- `$data` - array of items where the key is the URL, and the value is the name of the menu item.

```php
Footer::make()
    ->menu([
        'https://moonshine-laravel.com/docs' => 'Documentation',
    ])
```
