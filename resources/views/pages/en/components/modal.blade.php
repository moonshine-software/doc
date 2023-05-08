<x-page title="Modal" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#wide', 'label' => 'Wide'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <code>moonshine::modal</code> component is used to create modal windows.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal.blade.php"></x-code>

@include("examples/components/modal")

<x-sub-title id="wide">Wide</x-sub-title>

<x-p>
    The <code>wide</code> parameter allows modal windows to take up the entire width.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-wide.blade.php"></x-code>

@include("examples/components/modal-wide")

</x-page>
