<x-page title="Heroicons" :sectionMenu="[
    'Sections' => [
        ['url' => '#solid', 'label' => 'Solid'],
        ['url' => '#outline', 'label' => 'Outline']
    ]
]">

<x-p>
    In addition to the standard icons, in the folder <code>resources/views/vendor/moonshine/shared/icons/heroicons</code> preinstalled
    icons from the collection <x-link link="https://heroicons.com" target="_blank">Heroicons</x-link>
    (set <b>Solid</b> by default and <b>Outline</b>),
    you can use them wherever you use the <code>icon()</code>
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

</x-page>
