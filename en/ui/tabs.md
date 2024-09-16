https://moonshine-laravel.com/docs/resource/ui-components/ui-tabs?change-moonshine-locale=en

------
# Tabs

-[Basics](#basics)
-[Active tab](#active)

<a name="basics"></a>
## Basics 

To create tabs, you can use the `moonshine::tabs` component.

```php
<x-moonshine::tabs
    :tabs="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2'
    ]"
    :contents="[
        'tab_1' => fake()->text(),
        'tab_2' => fake()->text()
    ]"
/>
```

#### Via slots

```php
<x-moonshine::tabs
    :tabs="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2'
    ]"
>
    <x-slot:tab_1>
        {{ fake()->text() }}
    </x-slot:tab_1>
    <x-slot:tab_2>
        {{ fake()->text() }}
    </x-slot:tab_2>
</x-moonshine::tabs>
```

<a name="active"></a>
### Active tab

You can specify the default active tab by specifying `active`.

```php
<x-moonshine::tabs
    :tabs="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2'
    ]"
    :contents="[
        'tab_1' => fake()->text(),
        'tab_2' => fake()->text()
    ]"
    active="tab_2"
/>
```
