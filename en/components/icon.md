# Icon

- [Basics](#basics)
- [Custom Output](#custom)

---

<a name="basics"></a>
## Basics

The `Icon` component is used for rendering icons.

```php
use MoonShine\Support\Enums\Color;

make(
    string $icon,
    int $size = 5,
    Color|string $color = '',
    ?string $path = null,
)
```

- `$icon` - name of the icon or HTML (if custom mode is used),
- `$size` - size,
- `$color` - color,
- `$path` - path to the directory where the Blade templates for icons are located.

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
## Custom Output

Example with passing an HTML icon:

```php
Icon::make(
    svg('path-to-icon-pack')->toHtml()
)->custom()
```
