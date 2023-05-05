<x-page title="Меню" :sectionMenu="[
    'Разделы' => [
        ['url' => '#register', 'label' => 'Регистрация'],
        ['url' => '#condition', 'label' => 'Условие отображения'],
        ['url' => '#link', 'label' => 'Внешняя ссылка'],
        ['url' => '#icon', 'label' => 'Иконка'],
        ['url' => '#badge', 'label' => 'Метка'],
        ['url' => '#translation', 'label' => 'Перевод']
    ]
]">

<x-sub-title id="register">Регистрация</x-sub-title>

<x-p>
    В разделе изучения ресурсов мы уже разобрались как регистрировать разделы админ-панели,
    после чего они также появляются в меню
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MoonShineUserResource::class,
    MoonShineUserRoleResource::class,
    PostResource::class,
]);
</x-code>

<x-p>
    Но для удобства интерфейса мы также можем сгруппировать пункты меню
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])
]);
</x-code>

<x-p>
    Всего лишь необходимо добавить ресурсы вторым параметром в класс <code>MoonShine\Menu\MenuGroup</code>.
    Ну а первый параметр название группы!
</x-p>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-sub-title id="condition">Условие отображения</x-sub-title>

<x-p>
    Отображать меню по условию
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
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
    app(MoonShine::class)->menu([
        MenuItem::make('Документация Laravel', 'https://laravel.com') // [tl! focus]
    ]);
</x-code>

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Также есть возможность менять иконку у пункта меню
</x-p>


<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('Система', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->icon('app') // [tl! focus]
]);
</x-code>

<x-p>
    За более подробной информацией обратитесь к разделу <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title id="badge">Метка</x-sub-title>

<x-p>
    Также есть возможность добавить счетчик к пункту меню
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('Blog', [
        MenuItem::make('Comments', new CommentResource(), 'heroicons.chat-bubble-left')
            ->badge(fn() => Comment::query()->count()),
    ], 'heroicons.newspaper') // [tl! focus]
]);
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_badge.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_badge_dark.png') }}"></x-image>

<x-sub-title id="translation">Перевод</x-sub-title>

<x-p>
    Для перевода пунктов меню необходимо в качестве названия передать ключ перевода
    и добавить метод <code>translatable()</code>
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('menu.Comments', new CommentResource())
        ->translatable() // [tl! focus]
    // or
    MenuItem::make('Comments', new CommentResource())
        ->translatable('menu') // [tl! focus]
]);
</x-code>

<x-code language="php">
// lang/ru/menu.php

return [
    'Comments' => 'Комментарии',
]; // [tl! focus]
</x-code>

<x-p>
    Для перевода меток меню можно воспользоваться средствами перевода Laravel
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Comments', new CommentResource())
        ->badge(fn() => __('menu.badge.new')) // [tl! focus]
]);
</x-code>

</x-page>
