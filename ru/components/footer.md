# Footer

- [Основы](#basics)
- [Авторские права](#copyright)
- [Меню](#menu)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `Footer` предназначен для создания блока подвала.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

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
## Авторские права

Метод `copyright()` позволяет оформить блок авторских прав в подвале.

```php
copyright(string|Closure $text)
```

```php
Footer::make()
    ->copyright(fn (): string => 'Your brand')
```

<a name="menu"></a>
## Меню

Метод `menu()` позволяет оформить блок меню в подвале.

```php
/**
 * @param  array<string, string>  $data
 */
menu(array $data)
```

- `$data` - массив элементов, где ключ - это url, а значение - название пункта меню.

```php
Footer::make()
    ->menu([
        'https://moonshine-laravel.com/docs' => 'Documentation',
    ])
```
