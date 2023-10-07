<x-page title="Меню" :sectionMenu="[
    'Разделы' => [
        ['url' => '#register', 'label' => 'Регистрация'],
        ['url' => '#condition', 'label' => 'Условие отображения'],
        ['url' => '#link', 'label' => 'Внешняя ссылка'],
        ['url' => '#icon', 'label' => 'Иконка'],
        ['url' => '#badge', 'label' => 'Метка'],
        ['url' => '#translation', 'label' => 'Перевод'],
        ['url' => '#divider', 'label' => 'Разделитель']
    ]
]">

<x-sub-title id="register">Регистрация</x-sub-title>

<x-p>
    В разделе изучения ресурсов мы уже разобрались как регистрировать разделы админ-панели,
    после чего они также появляются в меню
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
    Но для удобства интерфейса мы также можем сгруппировать пункты меню
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

<x-sub-title id="link">Внешняя ссылка</x-sub-title>

<x-p>
    Возможность добавить кастомный линк
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('Документация Laravel', 'https://laravel.com') // [tl! focus]
]);
//...
</x-code>

<x-p>
    Ссылки можно передавать через функцию
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

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    Также есть возможность менять иконку у пункта меню
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
    За более подробной информацией обратитесь к разделу <x-link link="{{ route('moonshine.page', 'appearance-icons') }}">Icons</x-link>
</x-p>

<x-sub-title id="badge">Метка</x-sub-title>

<x-p>
    Также есть возможность добавить счетчик к пункту меню
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

<x-sub-title id="translation">Перевод</x-sub-title>

<x-p>
    Для перевода пунктов меню необходимо в качестве названия передать ключ перевода
    и добавить метод <code>translatable()</code>
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
    Для перевода меток меню можно воспользоваться средствами перевода Laravel
</x-p>

<x-code language="php">
//...
app(MoonShine::class)->menu([
    MenuItem::make('Comments', new CommentResource())
        ->badge(fn() => __('menu.badge.new')) // [tl! focus]
]);
//...
</x-code>

<x-sub-title id="divider">Разделитель</x-sub-title>

<x-p>
    Пункты меню можно визуально разделить с помощью <code>MenuDivider</code>
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
    В качестве разделителя можно использовать текст, для этого его нужно передать методу <code>make()</code>
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
