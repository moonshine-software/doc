<x-page title="Menu" :sectionMenu="[
    'Sections' => [
        ['url' => '#register', 'label' => 'Registration'],
        ['url' => '#condition', 'label' => 'Display condition'],
        ['url' => '#link', 'label' => 'External link'],
        ['url' => '#icon', 'label' => 'Icon'],
        ['url' => '#badge', 'label' => 'Tag']
    ]
]">

<x-sub-title id="register">Registration</x-sub-title>

<x-p>
    We have already figured out how to register sections of the admin. panel, after which they also appear in the menu
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MoonShineUserResource::class,
    MoonShineUserRoleResource::class,
    PostResource::class,
]);
</x-code>

<x-p>
    But for the convenience of the interface we can also group menu items
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('System', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])
]);
</x-code>

<x-p>
    You just need to add the resources as a second parameter to the class <code>Leeto\MoonShine\Menu\MenuGroup</code>.
    Well, the first parameter is the name of the group!
</x-p>

<x-image src="{{ asset('screenshots/menu.png') }}"></x-image>

<x-sub-title id="condition">Display condition</x-sub-title>

<x-p>
    Display menu by condition
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('System', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->canSee(function(Request $request) { // [tl! focus:start]
        return $request->user('moonshine')?->id === 1;
    }) // [tl! focus:end]
]);
</x-code>

<x-sub-title id="link">External link</x-sub-title>

<x-p>
    Ability to add a custom link
</x-p>

<x-code language="php">
    app(MoonShine::class)->registerResources([
        MenuItem::make('Documentation Laravel', 'https://laravel.com') // [tl! focus]
    ]);
</x-code>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    It is also possible to change the icon of the menu item
</x-p>


<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('System', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->icon('app') // [tl! focus]
]);
</x-code>

<x-p>
    Available values
</x-p>In addition to the standard icons, in the folder

<x-ul :items="['add', 'app', 'bookmark', 'cart', 'delete', 'edit', 'setexport', 'filter', 'search', 'users']"></x-ul>

    <x-p>
        In addition to the standard icons, in the folder <code>resources/views/vendor/moonshine/shared/icons/heroicons</code> preinstalled
        icons from the collection Heroicons (set <b>Solid</b>),
        you can use them wherever you use the <code>->icon(...)</code>, e.g.:
        <x-code language="php">
            MenuItem::make('Documentation Laravel', 'https://laravel.com')
                ->icon('heroicons.link'),
        </x-code>
        A complete list of icons and a search for them is available on the site <x-link link="https://heroicons.com/" target="_blank">Heroicons</x-link>
    </x-p>

    <x-p>
        It is also possible to create blade file with your custom icon. To do this, you need to in <code>resources/views/vendor/moonshine/shared/icons</code>
        create blade example file my-icon.blade.php with displaying an icon inside (e.g. code svg)
        and then specify <code>icon('my-icon')</code>
    </x-p>

<x-sub-title id="badge">Tag</x-sub-title>

<x-p>
    It is also possible to add a counter to the menu item
</x-p>

<x-code language="php">
app(MoonShine::class)->registerResources([
    MenuGroup::make('System', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->badge(fn() => cache()->rememberForever('count', fn() => User::query()->count())) // [tl! focus]
]);
</x-code>


<x-image src="{{ asset('screenshots/menu_badge.png') }}"></x-image>

</x-page>



