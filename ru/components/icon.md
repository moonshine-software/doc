# Icon

- [Основы](#basics)
- [Кастомный вывод](#custom)

---

<a name="basics"></a>
## Основы

Компонент `Icon` используется для вывода иконок.

```php
use MoonShine\Support\Enums\Color;

make(
    string $icon,
    int $size = 5,
    Color|string $color = '',
    ?string $path = null,
)
```

- `$icon` - название иконки или html (если используется кастомный режим),
- `$size` - размер,
- `$color` - цвет,
- `$path` - путь до директории где лежат blade шаблоны иконок.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Icon;

Icon::make('users')
```
tab: Blade
```blade
<x-moonshine::icon icon="users" />
```
~~~

<a name="custom"></a>
## Кастомный вывод

Пример с передачей HTML иконки:

```php
Icon::make(
    svg('path-to-icon-pack')->toHtml()
)->custom()
```
