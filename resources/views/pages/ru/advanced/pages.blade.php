<x-page title="Страницы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Можно создавать свои пустые страницы на основе blade view, стилизовать по своему и взаимодействовать
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    CustomPage::make('Название страницы', 'slug', 'view', fn() => [])
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
</x-page>
