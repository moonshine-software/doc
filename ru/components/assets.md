# Assets

@include('_includes/note-about-appearance-layout')

Компонент `Assets` предназначен для подключения к html-странице скриптов и таблиц стилей, добавленных через [AssetManager](/docs/{{version}}/appearance/assets).

> [!NOTE]
> Компонент `Assets` также подключает системные стили и скрипты.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Assets;

Assets::make();
```
tab: Blade
```blade
<x-moonshine::layout.assets />
```
~~~

> [!NOTE]
> Родительский компонент: [Head](/docs/{{version}}/components/head).
