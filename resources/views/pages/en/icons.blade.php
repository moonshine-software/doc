<x-page title="Icons" :sectionMenu="[
    'Sections' => [
        ['url' => '#solid', 'label' => 'Solid'],
        ['url' => '#outline', 'label' => 'Outline'],
        ['url' => '#custom', 'label' => 'Custom icons']
    ]
]">

<x-p>
    For all entities that have a <code>icon()</code> method,
    you can use one of the preset sets
    from the collection <x-link link="https://heroicons.com" target="_blank">Heroicons</x-link>
    (default <b>Solid</b> and <b>Outline</b> set) or create your own set.
</x-p>

<x-sub-title id="solid">Solid</x-sub-title>

<x-code language="php">
    ->icon('heroicons.academic-cap') // [tl! focus]
</x-code>

<x-icon-list
    pattern="../vendor/moonshine/moonshine/resources/views/ui/icons/heroicons/*.blade.php"
    prefix="heroicons."
/>

<x-sub-title id="outline">Outline</x-sub-title>

<x-code language="php">
    ->icon('heroicons.outline.academic-cap') // [tl! focus]
</x-code>

<x-icon-list
    pattern="../vendor/moonshine/moonshine/resources/views/ui/icons/heroicons/outline/*.blade.php"
    prefix="heroicons.outline."
/>

<x-sub-title id="custom">Custom icons</x-sub-title>

<x-p>
    It is also possible to create a blade file with your custom icon. To do this, you need to go to <code>resources/views/vendor/moonshine/shared/icons</code>
    create a blade file (for example <code>my-icon.blade.php</code>) with an icon displayed inside (for example, the code of an svg file)
    and then specify <code>icon('my-icon')</code>
</x-p>

</x-page>
