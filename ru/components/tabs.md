# Tabs

- [Основы](#basics)
- [Активная вкладка](#active)

---

<a name="basics"></a>
## Основы

Для создания вкладок можно использовать компонент `Tabs`.

```php
make(iterable $components = [])
```

Для добавления вкладок используется компонент `Tab`.

```php
make(
    Closure|string|iterable $labelOrComponents = [],
    iterable $components = [],
)
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Text;

Tabs::make([
    Tab::make('Tab 1', [
        Text::make('Text 1')
    ]),
    Tab::make('Tab 2', [
        Text::make('Text 2')
    ]),
]),
```
tab: Blade
```blade
<x-moonshine::tabs
    :items="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2',
        'tab_3' => 'Tab 3',
    ]"
>
    <x-slot:tab_1>
        Tab 1 content
    </x-slot>

    <x-slot name="tab_2">
        Tab 2 content
    </x-slot>

    <x-slot:tab_3>
        Tab 3 content
    </x-slot>
</x-moonshine::tabs>
```
~~~

> [!WARNING]
> Используйте `snake_case` для наименования ключа tab.

<a name="active"></a>
## Активная вкладка

Вы можете указать активную вкладку по умолчанию, указав `active`.

```blade
<x-moonshine::tabs
    :items="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2',
        'tab_3' => 'Tab 3',
    ]"
    active="tab_2"
>
    <x-slot:tab_1>
        Tab 1 content
    </x-slot>

    <x-slot name="tab_2">
        Tab 2 content
    </x-slot>

    <x-slot:tab_3>
        Tab 3 content
    </x-slot>
</x-moonshine::tabs>
```
