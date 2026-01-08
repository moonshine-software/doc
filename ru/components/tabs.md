# Tabs

- [Основы](#basics)
- [Активная вкладка](#active)
- [Активация через событие](#event-active)
- [Вертикальный режим](#vertical)
- [Атрибуты для заголовка](#label-attributes)

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

@preview('tabs')

> [!WARNING]
> Используйте `snake_case` для наименования ключа tab.

<a name="active"></a>
## Активная вкладка

Вы можете указать активную вкладку по умолчанию, через метод `active()`.

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
## Активация через событие

Для программной активации вкладки можно использовать JavaScript-событие `tab_active`.
Это позволяет переключать вкладки из любого места приложения.

Чтобы переключиться на нужную вкладку, необходимо задать ей имя через метод `name()`, а затем вызвать событие `JsEvent::TAB_ACTIVE`.

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

ActionButton::make('Перейти на Tab 2')
    ->dispatchEvent(AlpineJs::event(JsEvent::TAB_ACTIVE, 'second-tab'))
```

Также можно вызвать событие из JavaScript:

```js
document.dispatchEvent(new CustomEvent('tab_active:second-tab'))
```

Или с использованием магического метода `$dispatch()` из **Alpine.js**:

```js
$dispatch('tab_active:second-tab')
```

<a name="vertical"></a>
## Вертикальный режим

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
## Атрибуты для заголовка

Для контента вкладок вы можете указывать **HTML**-атрибуты через метод `customAttributes()`,
но если требуются атрибуты для заголовка, то воспользуйтесь методом `labelAttributes()`.

```php
Tabs::make([
    Tabs\Tab::make([
        // ...
    ])->labelAttributes(['x-show' => '!flag'])
]),
```
