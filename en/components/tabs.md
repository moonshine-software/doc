# Tabs

- [Basics](#basics)
- [Active Tab](#active)
- [Vertical mode](#vertical)
- [Label attributes](#label-attributes)
-
---

<a name="basics"></a>
## Basics

To create tabs, you can use the `Tabs` component.

```php
make(iterable $components = [])
```

To add tabs, the `Tab` component is used.

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
> Use `snake_case` for naming the tab key.

<a name="active"></a>
## Active Tab

You can specify the default active tab by setting `active`.

~~~tabs
tab: Class
```php
Tabs::make([
    Tab::make('Tab 1', [
        Text::make('Text 1')
    ]),
    Tab::make('Tab 2', [
        Text::make('Text 2')
    ])->active(),
]),

// Condition

Tabs::make([
    Tab::make('Tab 1', [
        Text::make('Text 1')
    ])->active(session()->has('key')),
    Tab::make('Tab 2', [
        Text::make('Text 2')
    ])->active(!session()->has('key')),
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
~~~

<a name="vertical"></a>
## Vertical mode

~~~tabs
tab: Class
```php
Tabs::make([
    // ...
])->vertical(),
```
tab: Blade
```blade
<x-moonshine::tabs :isVertical="true"
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

<a name="label-attributes"></a>
## Label attributes

For the tab content, you can specify **HTML**-attributes through the method `customAttributes()`,
But if attributes are required for the heading, then use the `labelAttributes()`.

```php
Tabs::make([
    Tabs\Tab::make([
        // ...
    ])->labelAttributes(['x-show' => '!flag'])
]),
```
