<x-page title="Toast" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#without', 'label' => 'Without use component'],
    ]
]">
<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using the <code>moonshine::toast</code> component, you can create notifications
</x-p>

<x-code language="blade" file="resources/views/examples/components/toast.blade.php"></x-code>

@include('pages.en.ui.shared.type')

<x-code language="blade" file="resources/views/examples/components/toast-type.blade.php"></x-code>

<div class="flex gap-2">
    @include("examples/components/toast-default")
    @include("examples/components/toast-success")
    @include("examples/components/toast-info")
    @include("examples/components/toast-warning")
    @include("examples/components/toast-error")
</div>

<x-sub-title id="without">Without use component</x-sub-title>

<x-p>
    You can create a notification using the <code>MoonShineUi::toast()</code> method
</x-p>

<x-code language="php">
use MoonShine\MoonShineUI;

MoonShineUi::toast('Toast content', 'error');
</x-code>

</x-page>
