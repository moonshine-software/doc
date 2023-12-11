<x-page
    title="Recipes"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#form-with-events', 'label' => 'Form and events'],
            ['url' => '#make-component', 'label' => 'View component with AlpineJs'],
            ['url' => '#assets-vite', 'label' => 'Vite build connection'],
        ]
    ]"
>

@include('recipes.form-with-events', ['title' => 'Form and events'])
@include('recipes.make-component', ['title' => 'View component with AlpineJs'])
@include('recipes.assets-vite', ['title' => 'Vite build connection'])

</x-page>
