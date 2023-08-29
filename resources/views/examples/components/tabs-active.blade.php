<x-moonshine::tabs
    :tabs="[
        'tab_1' => 'Tab 1',
        'tab_2' => 'Tab 2'
    ]"
    :contents="[
        'tab_1' => fake()->text(),
        'tab_2' => fake()->text()
    ]"
    activeTab="tab_2"
/>
