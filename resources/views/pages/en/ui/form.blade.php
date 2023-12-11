<x-page title="Form elements" :sectionMenu="[
    'Sections' => [
        ['url' => '#label', 'label' => 'Label'],
        ['url' => '#input', 'label' => 'Input'],
        ['url' => '#checkbox', 'label' => 'Checkbox'],
        ['url' => '#radio', 'label' => 'Radio'],
        ['url' => '#color', 'label' => 'Color'],
        ['url' => '#button', 'label' => 'Button'],
        ['url' => '#hint', 'label' => 'Hint'],
        ['url' => '#file', 'label' => 'File'],
        ['url' => '#slide-range', 'label' => 'Slide range'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#switcher', 'label' => 'Switcher'],
        ['url' => '#textarea', 'label' => 'Textarea'],
    ]
]">

<x-moonshine::alert type="default" icon="heroicons.information-circle" class="my-4">
    Form components are wrappers of similar HTML elements; they can be passed all the necessary attributes.
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
    If a field is required, you can pass the <code>required</code> attribute to style the element.
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

<x-sub-title id="color">Color</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/color.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/color")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="button">Button</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/button.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/button")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="hint">Hint</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/hint.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/hint")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="file">File</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/file.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/form/file")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    Using the component, you can display previously downloaded files.
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/file-files.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/form/file-files")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        <code>files</code> - array of url files for output<br>
        <code>raw</code> - array of source data (value stored in the database).
    </x-moonshine::alert>
</x-p>

<x-p>
    You can pass additional parameters to the component:
</x-p>
<x-p>
    <code>download</code> - downloading the uploaded file <br>
    <code>removable</code> - removal from the list of downloaded files <br>
    <code>imageable</code> - displaying preview images
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/file-full.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/form/file-full")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="slide-range">Slide range</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/slide-range.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/slide-range")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="select">Select</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/select.blade.php"></x-code>

<x-p>
    or through <code>slot:options</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/select-slot.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/select")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    You can combine values into groups.
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/select-groups.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/select-groups")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    You can pass additional parameters to the component:
</x-p>
<x-p>
    <code>searchable</code> - search by values <br>
    <code>nullable</code> - may matter <code>NULL</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/select-full.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/select-full")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    To load values asynchronously, you need to specify the url for the <code>asyncRoute</code> attribute,
    which will return data in json format.
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/select-async.blade.php"></x-code>

<x-sub-title id="switcher">Switcher</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/switcher.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/switcher")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    <code>onValue</code> - active value<br>
    <code>offValue</code> - inactive value
</x-p>

<x-sub-title id="textarea">Textarea</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/textarea.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/form/textarea")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
