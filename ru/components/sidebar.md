# Sidebar

- [Основы](#basics)
- [Возможность скрыть](#collapsed)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `Sidebar` предназначен для создания бокового меню.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\Layout\Sidebar;

Sidebar::make([
    Menu::make(),
])
```
tab: Blade
```blade
<x-moonshine::layout.sidebar :collapsed="true">
    <x-moonshine::layout.menu
        :elements="[
            ['label' => 'Dashboard', 'url' => '/'],
            ['label' => 'Section', 'url' => '/section'],
        ]"
    />
</x-moonshine::layput.sidebar>
```
~~~

<a name="collapsed"></a>
## Возможность скрыть

По умолчанию `Sidebar` всегда открыт, но с помощью метода `collapsed()`, вы можете добавить возможность скрыть `Sidebar`.

```php
Sidebar::make([
    Menu::make(),
])->collapsed()
```
