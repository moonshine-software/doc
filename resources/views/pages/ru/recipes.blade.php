<x-page
    title="Рецепты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#form-with-events', 'label' => 'Форма и события'],
            ['url' => '#make-component', 'label' => 'View компонента с AlpineJs'],
            ['url' => '#assets-vite', 'label' => 'Подключение Vite build'],
            ['url' => '#custom-buttons', 'label' => 'Кастомные кнопки'],
            ['url' => '#hasone-through-template', 'label' => 'HasOne через поле Template'],
            ['url' => '#custom-breadcrumbs', 'label' => 'Изменение breadcrumbs из ресурса'],
            ['url' => '#index-page-cards', 'label' => 'Индексная страница через CardsBuilder'],
            ['url' => '#sorting-for-cards-builder', 'label' => 'Сортировка для CardsBuilder'],
            ['url' => '#update-on-preview-pivot', 'label' => 'updateOnPreview для pivot полей'],
            ['url' => '#hasmany-parent-id', 'label' => 'ID родителя в HasMany'],
        ]
    ]"
>

@include('pages.ru.recipes.form-with-events', ['title' => 'Форма и события'])
@include('pages.ru.recipes.make-component', ['title' => 'View компонента с AlpineJs'])
@include('pages.ru.recipes.assets-vite', ['title' => 'Подключение Vite build'])
@include('pages.ru.recipes.custom-buttons', ['title' => 'Кастомные кнопки'])
@include('pages.ru.recipes.hasone-through-template', ['title' => 'HasOne через поле Template'])
@include('pages.ru.recipes.custom-breadcrumbs', ['title' => 'Изменение breadcrumbs из ресурса'])
@include('pages.ru.recipes.index-page-cards', ['title' => 'Индексная страница через CardsBuilder'])
@include('pages.ru.recipes.sorting-for-cards-builder', ['title' => 'Сортировка для CardsBuilder'])
@include('pages.ru.recipes.update-on-preview-pivot', ['title' => 'updateOnPreview для pivot полей'])
@include('pages.ru.recipes.hasmany-parent-id', ['title' => 'ID родителя в HasMany'])

</x-page>
