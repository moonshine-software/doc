<x-page title="Modal" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#wide', 'label' => 'Wide window'],
        ['url' => '#auto', 'label' => 'Automatic width'],
        ['url' => '#close', 'label' => 'Closing a window'],
        ['url' => '#async', 'label' => 'Asynchronous Content'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create modal windows, the <code>moonshine::modal</code> component is used.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal.blade.php"></x-code>

@include("examples/components/modal")

<x-sub-title id="wide">Wide window</x-sub-title>

<x-p>
    The <code>wide</code> parameter allows modal windows to fill the entire width.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-wide.blade.php"></x-code>

@include("examples/components/modal-wide")

<x-sub-title id="auto">Automatic width</x-sub-title>

<x-p>
    The <code>auto</code> parameter allows modal windows to take up width based on the content.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-auto.blade.php"></x-code>

@include("examples/components/modal-auto")

<x-sub-title id="close">Closing a window</x-sub-title>

<x-p>
    By default, modal windows close when clicked outside the window area.
    You can override this behavior using the <code>closeOutside</code> parameter.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-close.blade.php"></x-code>

@include("examples/components/modal-close")

<x-sub-title id="async">Asynchronous Content</x-sub-title>

<x-p>
    The <code>moonshine::modal</code> component allows you to load content asynchronously.
</x-p>

<x-code language="blade" file="resources/views/examples/components/modal-async.blade.php"></x-code>

@include("examples/components/modal-async")

</x-page>
