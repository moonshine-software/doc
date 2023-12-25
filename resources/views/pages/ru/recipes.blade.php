<x-page
    title="Рецепты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#form-with-events', 'label' => 'Форма и события'],
            ['url' => '#make-component', 'label' => 'View компонента с AlpineJs'],
            ['url' => '#assets-vite', 'label' => 'Подключение Vite build'],
            ['url' => '#custom-buttons', 'label' => 'Кастомные кнопки'],
        ]
    ]"
>

@include('pages.ru.recipes.form-with-events', ['title' => 'Форма и события'])
@include('pages.ru.recipes.make-component', ['title' => 'View компонента с AlpineJs'])
@include('pages.ru.recipes.assets-vite', ['title' => 'Подключение Vite build'])
@include('pages.ru.recipes.custom-buttons', ['title' => 'Кастомные кнопки'])

</x-page>
