# Breadcrumbs

Для создания "хлебных крошек" используется компонент `Breadcrumbs`.

```php
make(array $items = [])
```

 - `$items` - список "хлебных крошек", где ключ это ссылка на ресурс, а значение это название элемента.

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
