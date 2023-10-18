<x-page title="Toast" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without', 'label' => 'Без компонента'],
    ]
]">
<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    C помощью компонента <code>moonshine::toast</code> можно создавать уведомления.
</x-p>

<x-code language="blade" file="resources/views/examples/components/toast.blade.php"></x-code>

@include('pages.ru.components.shared.type')

<x-code language="blade" file="resources/views/examples/components/toast-type.blade.php"></x-code>

<div class="flex flex-wrap gap-2">
    @include("examples/components/toast-default")
    @include("examples/components/toast-primary")
    @include("examples/components/toast-secondary")
    @include("examples/components/toast-success")
    @include("examples/components/toast-info")
    @include("examples/components/toast-warning")
    @include("examples/components/toast-error")
</div>

<x-sub-title id="without">Без использования компонента</x-sub-title>

<x-p>
    Также создать уведомление можно с помощью метода <code>MoonShineUi::toast()</code>.
</x-p>

<x-code language="php">
use MoonShine\MoonShineUI;

MoonShineUI::toast('Toast content', 'error');
</x-code>

</x-page>
