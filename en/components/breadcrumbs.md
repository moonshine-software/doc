# Breadcrumbs

To create "breadcrumbs", the `Breadcrumbs` component is used.

```php
make(array $items = [])
```

 - `$items` - a list of "breadcrumbs", where the key is the link to the resource, and the value is the name of the item.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Breadcrumbs;

Breadcrumbs::make([
    '/' => 'Home',
    '/articles' => 'Articles',
]),
```
tab: Blade
```blade
<x-moonshine::breadcrumbs
    :items="[
        '/' => 'Home',
        '/articles' => 'Articles',
    ]"
/>
```
~~~
