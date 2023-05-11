<x-page title="Страницы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without-title', 'label' => 'Без заголовка'],
        ['url' => '#layout', 'label' => 'Layout'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Можно создавать свои пустые страницы на основе blade view, стилизовать по своему и взаимодействовать
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    CustomPage::make('Название страницы', 'slug', 'view', fn() => [])  // [tl! focus]
]);
</x-code>

<x-p>
    Первый аргумент - Title страницы
</x-p>

<x-p>
    Второй аргумент - slug страницы для формирования url
</x-p>

<x-p>
    Третий аргумент - ваша кастомная blade view, которая располагается в resources/views
</x-p>

<x-p>
    Четвертый аргумент - данные, необходимые для view
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Например, с использованием собственных роутов и контроллеров добавлять логику
</x-moonshine::alert>

<x-sub-title id="without-title">Без заголовка</x-sub-title>

<x-p>
    Иногда не требуется вывод заголовка на кастомной странице, поэтому его можно скрыть используя метод <code>withoutTitle</code>
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    CustomPage::make('Название страницы', 'slug', 'view', fn() => [])
        ->withoutTitle()  // [tl! focus]
]);
</x-code>

<x-sub-title id="layout">Layout</x-sub-title>

<x-p>
    Можно использовать кастомный <code>layout</code>, для этого необходимо указать путь до него в соответствующем методе
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    CustomPage::make('Название страницы', 'slug', 'view', fn() => [])
        ->layout('path') // [tl! focus]
]);
</x-code>

</x-page>
