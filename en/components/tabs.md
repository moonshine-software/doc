# Tabs

- [Basics](#basics)
- [Active Tab](#active)
- [Activation via event](#event-active)
- [Vertical mode](#vertical)
- [Label attributes](#label-attributes)
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

@preview('tabs')

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

<a name="event-active"></a>
## Activation via event

To programmatically activate a tab, you can use the JavaScript event `tab_active`.
This allows you to switch tabs from anywhere in the application.

To switch to the desired tab, you need to set its name using the `name()` method, and then trigger the `JsEvent::TAB_ACTIVE` event.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;

Tabs::make([
    Tab::make('Tab 1', [
        // ...
    ])->name('first-tab'),
    Tab::make('Tab 2', [
        // ...
    ])->name('second-tab'),
]),

ActionButton::make('Go to Tab 2')
    ->dispatchEvent(AlpineJs::event(JsEvent::TAB_ACTIVE, 'second-tab'))
```

You can also trigger the event from JavaScript:

```js
document.dispatchEvent(new CustomEvent('tab_active:second-tab'))
```

Or using the magic method `$dispatch()` from **Alpine.js**:

```js
$dispatch('tab_active:second-tab')
```

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
