<x-page title="Menu" :sectionMenu="[
    'Sections' => [
        ['url' => '#register', 'label' => 'Registration'],
        ['url' => '#condition', 'label' => 'Condition-based display'],
        ['url' => '#link', 'label' => 'External link'],
        ['url' => '#icon', 'label' => 'Icon'],
        ['url' => '#badge', 'label' => 'Tag'],
        ['url' => '#translation', 'label' => 'Translation'],
        ['url' => '#divider', 'label' => 'Divider']
    ]
]">

<x-sub-title id="register">Registration</x-sub-title>

<x-p>
    We have already figured out how to register sections of the admin panel
    to make them appear in the menu
</x-p>

<x-code language="php">
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem; // [tl! focus]
use MoonShine\MoonShine; // [tl! focus]
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    //...

    public function boot()
    {
        app(MoonShine::class)->menu([ // [tl! focus:start]
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
        ]); // [tl! focus:end]
    }
}
</x-code>

<x-p>
    But to make our interface convenient we can also group menu items
</x-p>

<x-code language="php">
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup; // [tl! focus]
use MoonShine\MoonShine;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    //...

    public function boot()
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('System', [ // [tl! focus]
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('Roles', new MoonShineUserRoleResource()),
            ]) // [tl! focus]
        ]);
    }
}
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
//...
app(MoonShine::class)->menu([
    MenuGroup::make('System', [
        MenuItem::make('Admins', new MoonShineUserResource()),
        MenuItem::make('Roles', new MoonShineUserRoleResource()),
    ])->canSee(function(Request $request) { // [tl! focus:start]
        return $request->user('moonshine')?->id === 1;
    }) // [tl! focus:end]
]);
//...
</x-code>

<x-sub-title id="link">External link</x-sub-title>

<x-p>
    Adding a custom link
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('Документация Laravel', 'https://laravel.com') // [tl! focus]
]);
//...
</x-code>

<x-p>
     Links can be passed through a function
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('Admins', function () { // [tl! focus:start]
        return (new MoonShineUserResource())->route('index');
    }),
    MenuItem::make('Home', fn() => route('home')) // [tl! focus:end]
]);
//...
</x-code>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    You can also change the icon of the menu item
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuGroup::make('Система', [ // [tl! focus:start]
        MenuItem::make('Admins', new MoonShineUserResource())->icon('heroicons.hashtag'),
        MenuItem::make('Roles', new MoonShineUserRoleResource())->icon('heroicons.hashtag'),
    ])->icon('app') // [tl! focus:end]
    // or
    MenuGroup::make('Blog', [ // [tl! focus:start]
        MenuItem::make('Comments', new CommentResource(), 'heroicons.chat-bubble-left')
    ], 'heroicons.newspaper') // [tl! focus:end]
]);
//...
</x-code>

<x-p>
    For more information, see <x-link link="{{ route('moonshine.page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title id="badge">Tag</x-sub-title>

<x-p>
    You can add a counter to the menu item
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('Comments', new CommentResource())
        ->badge(fn() => Comment::query()->count()), // [tl! focus]
]);
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_badge.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_badge_dark.png') }}"></x-image>

<x-sub-title id="translation">Translation</x-sub-title>

<x-p>
    To translate menu items, you need to add the translation key as the name
    and add the <code>translatable()</code> method
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('menu.Comments', new CommentResource())
        ->translatable() // [tl! focus]
    // or
    MenuItem::make('Comments', new CommentResource())
        ->translatable('menu') // [tl! focus]
]);
//...
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
//...
app(MoonShine::class)->menu([
    MenuItem::make('Comments', new CommentResource())
        ->badge(fn() => __('menu.badge.new')) // [tl! focus]
]);
//...
</x-code>

<x-sub-title id="divider">Divider</x-sub-title>

<x-p>
    Menu items can be visually separated using <code>MenuDivider</code>
</x-p>

<x-code language="php">
use MoonShine\Menu\MenuDivider; // [tl! focus]

//...
app(MoonShine::class)->menu([
    MenuItem::make('Categories', new CategoryResource()),
    MenuDivider::make(), // [tl! focus]
    MenuItem::make('Articles', new ArticleResource()),
]);
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_divider.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_divider_dark.png') }}"></x-image>

<x-p>
    You can use text as a separator, for this you need to pass it to the <code>make()</code> method
</x-p>

<x-code language="php">
use MoonShine\Menu\MenuDivider; // [tl! focus]

//...
app(MoonShine::class)->menu([
    MenuItem::make('Categories', new CategoryResource()),
    MenuDivider::make('Divider'), // [tl! focus]
    MenuItem::make('Articles', new ArticleResource()),
]);
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_divider_label.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_divider_label_dark.png') }}"></x-image>

</x-page>
