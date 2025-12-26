# ThemeSwitcher

@include('_includes/note-about-appearance-layout')

The `ThemeSwitcher` component displays a button-icon for switching themes (light/dark).

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


@preview('theme-switcher')
