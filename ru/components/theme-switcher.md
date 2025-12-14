# ThemeSwitcher

@include('_includes/note-about-appearance-layout')

Компонент `ThemeSwitcher` отображает кнопку-иконку для переключения темы (светлая/темная).

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\ThemeSwitcher;

ThemeSwitcher::make()
```
tab: Blade
```blade
<x-moonshine::layout.theme-switcher />
```
~~~
