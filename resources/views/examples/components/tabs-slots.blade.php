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
