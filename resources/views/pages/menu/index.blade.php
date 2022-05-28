<x-page title="Основы">

<x-p>
    В разделе изучения ресурсов мы уже разобрались как регистрировать разделы админ. панели,
    после чего они также появляются в меню
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MoonShineUserResource::class,
    MoonShineUserRoleResource::class,
    PostResource::class,
]);
</x-code>

<x-p>
    Но для удобства интерфейса мы также можем сгруппировать пункты меню
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])
]);
</x-code>

<x-p>
    Всего лишь необходимо добавить ресурсы вторым параметром в класс <code>Leeto\MoonShine\Menu\MenuGroup</code>.
    Ну а первый параметр название группы!
</x-p>

<x-image src="{{ asset('screenshots/menu.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-index') }}">Поля</x-next>

</x-page>



