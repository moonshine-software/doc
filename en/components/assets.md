# Assets

@include('_includes/note-about-appearance-layout')

The `Assets` component is designed to include scripts and stylesheets into the HTML page, added through [AssetManager](/docs/{{version}}/appearance/assets).

> [!NOTE]
> The `Assets` component also includes system styles and scripts.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Assets;

Assets::make();
```
tab: Blade
```blade
<x-moonshine::layout.assets />
```
~~~

> [!NOTE]
> Parent component: [Head](/docs/{{version}}/components/head).
