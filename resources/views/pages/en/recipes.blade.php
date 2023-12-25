<x-page
    title="Recipes"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#form-with-events', 'label' => 'Form and events'],
            ['url' => '#make-component', 'label' => 'View component with AlpineJs'],
            ['url' => '#assets-vite', 'label' => 'Vite build connection'],
            ['url' => '#custom-buttons', 'label' => 'Custom buttons'],
        ]
    ]"
>

@include('pages.en.recipes.form-with-events', ['title' => 'Form and events'])
@include('pages.en.recipes.make-component', ['title' => 'View component with AlpineJs'])
@include('pages.en.recipes.assets-vite', ['title' => 'Vite build connection'])
@include('pages.en.recipes.custom-buttons', ['title' => 'Custom buttons'])

</x-page>
