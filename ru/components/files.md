# Files

Для отображения списка файлов можно использовать компонент `Files`.

```php
make(
    array $files = [],
    bool $download = true,
)
```

 - `$files` - массив файлов,
 - `$download` - включение возможности скачивать файлы.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Files;

Files::make([
    '/images/thumb_1.jpg',
    '/images/thumb_2.jpg',
    '/images/thumb_3.jpg',
]),
```
tab: Blade
```blade
<x-moonshine::files
    :files="[
        '/images/thumb_1.jpg',
        '/images/thumb_2.jpg',
        '/images/thumb_3.jpg',
    ]"
    :download="false"
/>
```
~~~
