# Вкладки

-[Основы](#basics)
-[Активная вкладка](#active)

---

<a name="basics"></a>
## Основы 

Для создания вкладок можно использовать компонент `moonshine::tabs`.

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

#### Через слоты

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
## Активная вкладка

Вы можете указать активную вкладку по умолчанию, указав `active`.

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
