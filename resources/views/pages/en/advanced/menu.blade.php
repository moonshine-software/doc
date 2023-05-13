<x-page title="Menu" :sectionMenu="[
    'Sections' => [
        ['url' => '#register', 'label' => 'Registration'],
        ['url' => '#condition', 'label' => 'Condition-based display'],
        ['url' => '#link', 'label' => 'External link'],
        ['url' => '#icon', 'label' => 'Icon'],
        ['url' => '#badge', 'label' => 'Tag'],
        ['url' => '#translation', 'label' => 'Translation']
    ]
]">

<x-sub-title id="register">Registration</x-sub-title>

<x-p>
    We have already figured out how to register sections of the admin panel
    to make them appear in the menu
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MoonShineUserResource::class,
    MoonShineUserRoleResource::class,
    PostResource::class,
]);
</x-code>

<x-p>
    But to make our interface convenient we can also group menu items
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('System', [ // [tl! focus]
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ]) // [tl! focus]
]);
</x-code>

<x-p>
    You just need to add the resources as a second parameter to the <code>MoonShine\Menu\MenuGroup</code> class.
    And the first parameter is the name of the group!
</x-p>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-sub-title id="condition">Condition-based display</x-sub-title>

<x-p>
    Displays menu based on the condition
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
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
    Adding a custom link
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Documentation Laravel', 'https://laravel.com') // [tl! focus]
]);
</x-code>

<x-p>
     Links can be passed through a function
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Admins', function () { // [tl! focus:start]
        return (new MoonShineUserResource())->route('index');
    }),
    MenuItem::make('Home', fn() => route('home')) // [tl! focus:end]
]);
</x-code>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    You can also change the icon of the menu item
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('System', [
        MoonShineUserResource::class,
        MoonShineUserRoleResource::class,
    ])->icon('app') // [tl! focus]
]);
</x-code>

<x-p>
    For more information, see <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title id="badge">Tag</x-sub-title>

<x-p>
    You can add a counter to the menu item
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuGroup::make('Blog', [
        MenuItem::make('Comments', new CommentResource(), 'heroicons.chat-bubble-left')
            ->badge(fn() => Comment::query()->count()), // [tl! focus]
    ], 'heroicons.newspaper')
]);
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_badge.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_badge_dark.png') }}"></x-image>

<x-sub-title id="translation">Translation</x-sub-title>

<x-p>
    To translate menu items, you need to add the translation key as the name
    and add the <code>translatable()</code> method
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
];
</x-code>

<x-p>
    To translate menu labels, you can use Laravel's translation tools
</x-p>

<x-code language="php">
app(MoonShine::class)->menu([
    MenuItem::make('Comments', new CommentResource())
        ->badge(fn() => __('menu.badge.new')) // [tl! focus]
]);
</x-code>

</x-page>
