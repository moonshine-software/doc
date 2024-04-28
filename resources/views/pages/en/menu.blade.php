<x-page
    title="Menu"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#group', 'label' => 'Groups'],
            ['url' => '#divider', 'label' => 'Divider'],
            ['url' => '#condition', 'label' => 'Display condition'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#badge', 'label' => 'Label'],
            ['url' => '#translation', 'label' => 'Translation'],
            ['url' => '#target-blank', 'label' => 'Open in new tab'],
            ['url' => '#force-active', 'label' => 'Active item'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The navigation menu is configured in <strong>App\Providers\MoonShineServiceProvider</strong> via the <code>menu()</code> method,
    which returns an array of menu items.
</x-p>

<x-p>
    In order to add a menu item, you must use the <strong>MoonShine\Menu\MenuItem</strong> class and its static method <code>make()</code>.
</x-p>

<x-code language="php">
MenuItem::make(Closure|string $label, Closure|MenuFiller|string $filler, null|string $icon = null, Closure|bool $blank = false)
</x-code>

<x-ul>
    <li><code>$label</code> - name of the menu item</li>
    <li><code>$filler</code> - element for forming url</li>
    <li><code>$icon</code> - icon for the menu item,</li>
    <li><code>$blank</code> - open in new tab.</li>
</x-ul>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        You can pass as the second parameter
        <x-link :link="to_page('resources-index')">ModelResource</x-link>,
        <x-link :link="to_page('page-class')">Page</x-link> or
        Resource.
    </x-moonshine::alert>
</x-p>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuItem; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array // [tl! focus:start]
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuItem::make('Home', fn() => route('home')),
            MenuItem::make('Docs', 'https://moonshine-laravel.com/docs'),
            MenuItem::make('Laravel Docs', 'https://laravel.com/docs', blank: true)
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the menu is created for <x-link :link="to_page('resources-index')">ModelResource</x-link>
    or Resource,
    then the menu item will use the first page advertised in method <code>pages()</code>.
</x-moonshine::alert>

<x-moonshine::divider label="Menu via Closure" />

<x-p>
    You can declare a menu using a closure based on the current request:
</x-p>

<x-code language="php">
namespace App\Providers;

use Closure; // [tl! focus]
use MoonShine\MoonShineRequest; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): Closure // [tl! focus:start]
    {
        return static function (MoonShineRequest $request) {
            return [
                //...
            ];
        };
    }; // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    It will be useful if you decide to use <em>multi tenancy</em> or if you have both the web and admin parts implemented on MoonShine.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    When declaring a menu using <em>Closure</em>,
    you need to manually register <x-link link="{{ to_page('page-instance') }}#define">pages</x-link>
    and <x-link link="{{ to_page('resources-index') }}#define">resources</x-link> in the corresponding methods.
</x-moonshine::alert>

<x-sub-title id="group">Groups</x-sub-title>

<x-p>
    Menu items can be combined into groups. To do this, use the <strong>MoonShine\Menu\MenuGroup</strong> class
    with the static method <code>make()</code>.
</x-p>

<x-code language="php">
MenuGroup::make(Closure|string $label, iterable $items, null|string $icon = null)
</x-code>

<x-ul>
    <li><code>$label</code> - group name</li>
    <li><code>$items</code> - array of menu components</li>
    <li><code>$icon</code> - icon for the group.</li>
</x-ul>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup; // [tl! focus]
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [ // [tl! focus]
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('Roles', new MoonShineUserRoleResource()),
            ]) // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-p>
    You can also add elements to a group using method <code>setItems()</code>
</x-p>

<x-code language="php">
setItems(iterable $items)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup; // [tl! focus]
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System')->setItems([
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('Roles', new MoonShineUserRoleResource()),
            ]) // [tl! focus:-3]
        ];
    }

    //...
}
</x-code>

<x-sub-title id="divider">Delimiter</x-sub-title>

<x-p>
    Menu items can be visually divided using <em>MoonShine\Menu\MenuDivider</em>.
</x-p>

<x-code language="php">
MenuDivider::make(Closure|string $label = '')
</x-code>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Menu\MenuDivider; // [tl! focus]
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuDivider::make(), // [tl! focus]
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_divider.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_divider_dark.png') }}"></x-image>

<x-p>
    You can use text as a delimiter; to do this, you need to pass it to the <code>make()</code>method.
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Menu\MenuDivider; // [tl! focus]
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuDivider::make('Divider'), // [tl! focus]
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_divider_label.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_divider_label_dark.png') }}"></x-image>

<x-sub-title id="condition">Display condition</x-sub-title>

<x-p>
    You can display menu items based on conditions using the <code>canSee()</code> method.
</x-p>

<x-code language="php">
canSee(Closure $callback)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('Roles', new MoonShineUserRoleResource())
                    ->canSee(fn()=> false) // [tl! focus]
            ])
                ->canSee(function(Request $request) {
                    return $request->user('moonshine')?->id === 1;
                }) // [tl! focus:-2]
        ];
    }

    //...
}
</x-code>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    You can set an icon for a menu item and a group. This can be accomplished in several ways.
</x-p>

<x-moonshine::divider label="Via parameter" />

<x-p>
    The icon can be set by passing the name as the third parameter in static method <code>make()</code>.
</x-p>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [
                MenuItem::make('Admins', new MoonShineUserResource(), 'heroicons.outline.users'), // [tl! focus]
                MenuItem::make('Roles', new MoonShineUserRoleResource(), 'heroicons.hashtag'), // [tl! focus]
            ])
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Via method" />

<x-p>
    Use method <code>icon()</code>.
</x-p>

<x-code language="php">
icon(string $icon)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [
                MenuItem::make('Admins', new MoonShineUserResource())
                    ->icon('heroicons.outline.users'), // [tl! focus]
                MenuItem::make('Roles', new MoonShineUserRoleResource())
                    ->icon('heroicons.hashtag'), // [tl! focus]
            ])
                ->icon('heroicons.cog') // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Via attribute" />

<x-p>
    The menu item will display an icon if the class
    <em><x-link link="{{ to_page('resources-index') }}">ModelResource</x-link></em>,
    <em><x-link link="{{ to_page('page-class') }}">Page</x-link></em>
    or <em>Resource</em>
    the <code>Icon</code> attribute is specified and the icon is not overridden in other ways.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

#[Icon('heroicons.outline.users')] // [tl! focus]
class MoonShineUserResource extends ModelResource
{

    //...

}
</x-code>

@include('pages.en.shared.alert_icons')

<x-sub-title id="badge">Label</x-sub-title>

<x-p>
    It is also possible to add an icon to a menu item or group.
</x-p>

<x-moonshine::divider label="Via menu item" />

<x-p>
    To add a badge to a menu item or group, use method <code>badge()</code>,
    which takes a closure as a parameter.
</x-p>

<x-code language="php">
badge(Closure $callback)
</x-code>

<x-code language="php">
namespace App\Providers;

use App\Models\Comment;
use App\MoonShine\Resources\CommentResource;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Comments', new CommentResource())
                ->badge(fn() => Comment::count()) // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Through a class method" />

<x-p>
    For <em><x-link link="{{ to_page('resources-index') }}">ModelResource</x-link></em>,
    <em><x-link link="{{ to_page('page-class') }}">Page</x-link></em>
    or <em>Resource</em>
    There is an alternative way to set the badge - method <code>getBadge()</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getBadge(): string
    {
        return 'new';
    } // [tl! focus:-3]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu_badge.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_badge_dark.png') }}"></x-image>

<x-sub-title id="translation">Translation</x-sub-title>

<x-p>
    To translate menu items, you need to pass the translation key as the name
    and add method <code>translatable()</code>
</x-p>

<x-code language="php">
translatable(string $key = '')
</x-code>

<x-code language="php">
namespace App\Providers;

use App\Models\Comment;
use App\MoonShine\Resources\CommentResource;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('menu.Comments', new CommentResource())
                ->translatable() // [tl! focus]
            // or
            MenuItem::make('Comments', new CommentResource())
                ->translatable('menu') // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-code language="php">
// lang/ru/menu.php

return [
    'Comments' => 'Comments',
];
</x-code>

<x-p>
    You can use Laravel's translation tools to translate menu labels.
</x-p>
<x-code language="php">
namespace App\Providers;

use App\Models\Comment;
use App\MoonShine\Resources\CommentResource;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Comments', new CommentResource())
                ->badge(fn() => __('menu.badge.new')) // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-sub-title id="target-blank">Open in new tab</x-sub-title>

<x-p>
    A menu item can have a flag indicating whether the link should be opened in a new tab or not. This can be implemented in several ways.
</x-p>

<x-moonshine::divider label="Через параметр" />

<x-p>
    The flag can be set by passing as the fourth parameter <code>true/false</code> or a closure in a static method <code>make()</code>.
</x-p>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [
                MenuItem::make('MoonShine Docs', 'https://moonshine-laravel.com/docs', 'heroicons.arrow-up', true), // [tl! focus]
                MenuItem::make('Laravel Docs', 'https://laravel.com/docs', 'heroicons.arrow-up', fn() => true), // [tl! focus]
            ])
        ];
    }

    //...
}
</x-code>

<x-moonshine::divider label="Via method" />

<x-p>
    Use method <code>blank()</code>.
</x-p>

<x-code language="php">
    blank(Closure|bool $blankCondition = true)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('MoonShine Docs', 'https://moonshine-laravel.com/docs')
                ->blank(), // [tl! focus]
            MenuItem::make('Laravel Docs', 'https://laravel.com/docs')
                ->blank(fn() => true), // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-sub-title id="force-active">Active item</x-sub-title>

<x-p>
    The menu item becomes active if it matches the url,
    but the <code>forceActive()</code> method allows you to force the item to be active.
</x-p>

<x-code language="php">
forceActive(Closure|bool $forceActive)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Label', '/endpoint')
                ->forceActive(fn() => request()->fullUrlIs('*admin/endpoint/*')), // [tl! focus]
        ];
    }

    //...
}
</x-code>

</x-page>
