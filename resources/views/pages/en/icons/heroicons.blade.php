<x-page title="Heroicons" :sectionMenu="[
    'Sections' => [
        ['url' => '#solid', 'label' => 'Solid'],
        ['url' => '#outline', 'label' => 'Outline']
    ]
]">

<x-p>
    In addition to the standard icons, you can find preinstalled
    icons from the <x-link link="https://heroicons.com" target="_blank">Heroicons</x-link> collection
    (<b>Solid</b> set is the default one, plus <b>Outline</b>) in the <code>resources/views/vendor/moonshine/shared/icons/heroicons</code> folder.
    You can use them wherever you use the <code>icon()</code> method
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
