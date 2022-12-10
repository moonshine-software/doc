<x-page title="Основы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#register', 'label' => 'Регистрация'],
        ['url' => '#condition', 'label' => 'Условие отображения'],
        ['url' => '#link', 'label' => 'Внешняя ссылка'],
        ['url' => '#icon', 'label' => 'Иконка'],
        ['url' => '#badge', 'label' => 'Метка']
    ]
]">

<x-sub-title id="register">Регистрация</x-sub-title>

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

<x-sub-title id="condition">Условие отображения</x-sub-title>

<x-p>
    Отображать меню по условию
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->canSee(function(Request $request) { // [tl! focus:start]
        return $request->user('moonshine')?->id === 1;
    }) // [tl! focus:end]
]);
</x-code>

<x-sub-title id="link">Внешняя ссылка</x-sub-title>

<x-p>
    Возможность добавить кастомный линк
</x-p>

<x-code language="php">
    app(MoonShine::class)->registerResources([
        MenuItem('Документация Laravel', 'https://laravel.com') // [tl! focus]
    ]);
</x-code>

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Также есть возможность менять иконку у пункта меню
</x-p>


<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->icon('app') // [tl! focus]
]);
</x-code>

<x-p>
    Доступные значения
</x-p>

<x-ul :items="['add', 'app', 'bookmark', 'cart', 'delete', 'edit', 'export', 'filter', 'search', 'users']"></x-ul>

<x-p>
    Также есть возможность создать blade файл с вашей кастомной иконкой. Для этого необходимо в <code>resources/vendor/moonshine/shared/icons</code>
     создать blade файл как пример my-icon.blade.php с отображением иконки внутри (например код svg)
     и далее указать <code>icon('my-icon')</code>
</x-p>

<x-sub-title id="badge">Метка</x-sub-title>

<x-p>
    Также есть возможность добавить счетчик к пункту меню
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->badge(fn() => cache()->rememberForever('count', fn() => User::query()->count())) // [tl! focus]
]);
</x-code>


<x-image src="{{ asset('screenshots/menu_badge.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-index') }}">Поля</x-next>

</x-page>



