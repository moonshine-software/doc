<x-page title="Heroicons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#solid', 'label' => 'Solid'],
        ['url' => '#outline', 'label' => 'Outline']
    ]
]">

<x-p>
    Кроме стандартных иконок, в папке <code>resources/views/vendor/moonshine/shared/icons/heroicons</code> предустановлены
    иконки из коллекции <x-link link="https://heroicons.com" target="_blank">Heroicons</x-link>
    (набор <b>Solid</b> по умолчанию и <b>Outline</b>),
    вы можете использовать их в любом месте, где используется метод <code>icon()</code>
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
