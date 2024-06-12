<x-page title="Card" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#overlay', 'label' => 'Overlay mode'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To create cards in the admin panel, use the <code>moonshine::card</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/card.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <div class="mb-6">
            @include("examples/components/card")
        </div>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="overlay">Overlay mode</x-sub-title>

<x-p>
    The <code>overlay</code> mode is available for the card.
</x-p>

<x-code language="blade" file="resources/views/examples/components/card-overlay.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <div class="mb-6">
            @include("examples/components/card-overlay")
        </div>
    </x-moonshine::column>
</x-moonshine::grid>
<x-sub-title id="carousel">Карусель изображений</x-sub-title>

<x-p>
    To add an images carousel to a card, you can add to <code>thumbnails</code> parameter array of images.
</x-p>

<x-code language="blade" file="resources/views/examples/components/card-carousel.blade.php"></x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <div class="mb-6">
            @include("examples/components/card-carousel")
        </div>
    </x-moonshine::column>
</x-moonshine::grid>
</x-page>
