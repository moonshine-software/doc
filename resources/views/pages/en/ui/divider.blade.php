<x-page title="Divider" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#text', 'label' => 'Text separator'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::divider</code> component allows you to create a stylized content divider.
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="text">Text separator</x-sub-title>

<x-p>
    You can use text as a separator. To do this, you need to specify the text in the <code>label</code> parameter.
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider-label.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider-label")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    The <code>centered</code> parameter allows you to center the text.
</x-p>

<x-code language="blade" file="resources/views/examples/components/divider-label-center.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/divider-label-center")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
