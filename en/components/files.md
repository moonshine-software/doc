# Files

To display a list of files, you can use the `Files` component.

```php
make(
    array $files = [],
    bool $download = true,
)
```

 - `$files` - an array of files,
 - `$download` - enabling the ability to download files.

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
