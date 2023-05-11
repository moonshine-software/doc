<x-page title="Form elements" :sectionMenu="[
    'Sections' => [
        ['url' => '#label', 'label' => 'Label'],
        ['url' => '#input', 'label' => 'Input'],
        ['url' => '#checkbox', 'label' => 'Checkbox'],
        ['url' => '#radio', 'label' => 'Radio'],
        ['url' => '#color', 'label' => 'Color'],
    ]
]">

<x-moonshine::alert type="default" icon="heroicons.information-circle" class="my-4">
    Form components are a wrapper for similar html elements, they can be passed all the necessary attributes.
</x-moonshine::alert>

<x-sub-title id="label">Label</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/label.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/label")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    If the field is required, then you can pass the <code>required</code> attribute to style the element
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/label-required.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/label-required")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>


<x-sub-title id="input">Input</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/input.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/input")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="checkbox">Checkbox</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/checkbox.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/checkbox")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="radio">Radio</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/radio.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/radio")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="color">Color select</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
