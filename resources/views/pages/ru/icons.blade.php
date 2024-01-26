<x-page title="Icons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#solid', 'label' => 'Solid'],
        ['url' => '#outline', 'label' => 'Outline'],
        ['url' => '#custom', 'label' => 'Кастомные иконки']
    ]
]">

<x-p>
    Для всех сущностей, в которых есть метод <code>icon()</code>,
    можно воспользоваться одним из предустановленных наборов
    из коллекции <x-link link="https://heroicons.com" target="_blank">Heroicons</x-link>
    (набор <b>Solid</b> по умолчанию и <b>Outline</b>) или создать свой собственный набор.
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

<x-sub-title id="custom">Кастомные иконки</x-sub-title>

<x-p>
    Также есть возможность создать blade-файл с вашей кастомной иконкой. Для этого необходимо в <code>resources/views/vendor/moonshine/ui/icons</code>
    создать blade-файл (например <code>my-icon.blade.php</code>) с отображением иконки внутри (например, код svg-файла)
    и далее указать <code>icon('my-icon')</code>
</x-p>

</x-page>
