# Link

- [Основы](#basics)
- [Подсказка](#tooltip)
- [Заливка](#fill)
- [Иконка](#icon)

---

<a name="basics"></a>
## Основы

Для создания стилизованной ссылки можно использовать компонент `Link`.

```php
make(
    Closure|string $href,
    Closure|string $label = ''
)
```

- `$href` - ссылка на ресурс,
- `$value` - название ссылки.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Link;

Link::make('https://moonshine-laravel.com', 'Moonshine')
```
tab: Blade
```blade
<x-moonshine::link-button href="#">
    Link
</x-moonshine::link-button>

<x-moonshine::link-native href="#">
    Link
</x-moonshine::link-native>
```
~~~

<a name="tooltip"></a>
## Подсказка

Для отображения подсказки при наведении используется метод `tooltip()`.

```php
Link::make('https://moonshine-laravel.com', 'Moonshine')
    ->tooltip('Tooltip')
```

<a name="fill"></a>
## Заливка

За заливку отвечает метод `filled()`.

~~~tabs
tab: Class
```php
Link::make('https://moonshine-laravel.com', 'Moonshine')
    ->filled()
```
tab: Blade
```blade
<x-moonshine::link-button
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-button>

<x-moonshine::link-native
    href="#"
    :filled="true"
>
    Link
</x-moonshine::link-native>
```
~~~

<a name="icon"></a>
## Иконка

Для добавления иконки используйте метод `icon()`.

```php
Link::make('https://moonshine-laravel.com', 'Moonshine')
    ->icon('arrow-top-right-on-square')
```
