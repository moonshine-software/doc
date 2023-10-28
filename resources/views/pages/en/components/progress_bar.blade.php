<x-page title="Progress bar" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#radial', 'label' => 'Radial'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::progress-bar</code> component allows you to create a progress bar
</x-p>

@include('pages.en.ui.shared.colors')

<x-code language="blade" file="resources/views/examples/components/progress_bar.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/progress_bar")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="radial">Radial</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/progress_bar-radial.blade.php"></x-code>

<x-p>
    To create a radial progress indicator, you need to pass the <code>radial</code> parameter to the component with the value <code>TRUE</code>
</x-p>

@include('pages.en.ui.shared.sizes')

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/progress_bar-radial")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
