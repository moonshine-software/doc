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
        ['url' => '#range', 'label' => 'Range'],
        ['url' => '#select', 'label' => 'Select'],
        ['url' => '#switcher', 'label' => 'Switcher'],
        ['url' => '#textarea', 'label' => 'Textarea'],
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
    Using the component, you can display previously uploaded files.
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
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Additionally, hidden fields will be created with the values passed in the <code>files[]</code> array.
    </x-moonshine::alert>
</x-p>

<x-p>
    You can pass additional parameters to the component:
</x-p>
<x-p>
    <code>download</code> - download downloaded file <br>
    <code>removable</code> - removal from the list of downloaded files <br>
    <code>imageable</code> - display image previews
</x-p>

<x-code language="blade" file="resources/views/examples/components/form/file-full.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-moonshine::box>
            @include("examples/components/form/file-full")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="range">Range</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/range.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/form/range")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="select">Select</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/form/select.blade.php"></x-code>

<x-p>
    or via <code>slot:options</code>
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
    <code>nullable</code> - can be NULL
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
    For asynchronous loading of values, you need to specify the url in the <code>asyncRoute</code> attribute,
    which will return data in json format
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
    <code>onValue</code> - value when active<br>
    <code>offValue</code> - value when inactive
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
