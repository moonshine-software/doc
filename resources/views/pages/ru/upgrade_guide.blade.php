<x-page title="Upgrade Guide" :sectionMenu="null">

<x-moonshine::badge color="green">
    Upgrading To 1.50 From 1.0
</x-moonshine::badge>

<x-sub-title>
    registerResources устарел и будет удален в версии 2.0
</x-sub-title>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuItem::make('Admins', new MoonShineUserResource()),
]);
</x-code>

<x-p>
    Рекомендуем использовать метод menu
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Admins', new MoonShineUserResource()),
]);
</x-code>

<x-sub-title>
    Метод у полей fullWidth устарел и будет удален
</x-sub-title>

<x-sub-title>
    Для создания сетки отображения в форме необходимо использовать декорации Grid/Column
</x-sub-title>

<x-sub-title>
    Laravel filemanager исключен из базовой поставки, необходимо ставить отдельно
</x-sub-title>
</x-page>
