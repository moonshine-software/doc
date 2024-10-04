https://moonshine-laravel.com/docs/resource/menu/menu?change-moonshine-locale=en

------

# Menu  

- [Basics](#basics)  
- [Groups](#group)
- [Attributes](#attributes)  
- [Delimiter](#divider)  
- [Display condition](#condition)  
- [Icon](#icon)  
- [Label](#badge)  
- [Translation](#translation)  
- [Open in new tab](#target-blank)  
- [Active item](#force-active)  
- [Custom view](#custom-view)  

<a name="basics"></a>  
## Basics  

The navigation menu is configured in **App\Providers\MoonShineServiceProvider** via the `menu()` method, which returns an array of menu items.  

In order to add a menu item, you must use the **MoonShine\Menu\MenuItem** class and its static method `make()`.  

```php
MenuItem::make(Closure|string $label, Closure|MenuFiller|string $filler, null|string $icon = null, Closure|bool $blank = false)  
```  

`$label` - name of the menu item
`$filler` - element for forming url
`$icon` - icon for the menu item,
`$blank` - open in new tab.

> [!NOTE]
> You can pass as the second parameter [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index) , [Page](https://moonshine-laravel.com/docs/resource/page/page-class) or Resource.

```php
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuItem::make('Home', fn() => route('home')),
            MenuItem::make('Docs', 'https://moonshine-laravel.com/docs'),
            MenuItem::make('Laravel Docs', 'https://laravel.com/docs', blank: true)
        ];
    }

    //...
}
```

> [!NOTE]
> If the menu is created for [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index) or Resource, then the menu item will use the first page advertised in method `pages()`.

#### Menu via Closure

You can declare a menu using a closure based on the current request:

```php
namespace App\Providers;

use Closure;
use MoonShine\MoonShineRequest;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): Closure
    {
        return static function (MoonShineRequest $request) {
            return [
                //...
            ];
        };
    };

    //...
}
```

> [!NOTE]
> It will be useful if you decide to use multi *tenancy* or if you have both the web and admin parts implemented on MoonShine.

> [!WARNING]
> When declaring a menu using *Closure*, you need to manually register [pages](https://moonshine-laravel.com/docs/resource/page/page-instance#define) and [resources](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) in the corresponding methods.

<a name="group"></a>  
## Groups  

Menu items can be combined into groups. To do this, use the **MoonShine\Menu\MenuGroup** class with the static method `make()`.  

```php
MenuGroup::make(Closure|string $label, iterable $items, null|string $icon = null)  
```  

`$label` - group name
`$items` - array of menu components
`$icon` - icon for the group.

```php
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
                MenuItem::make('Roles', new MoonShineUserRoleResource()),
            ])
        ];
    }

    //...
}
```

![menu](https://moonshine-laravel.com/screenshots/menu.png)
![menu_dark](https://moonshine-laravel.com/screenshots/menu_dark.png)

You can also add elements to a group using method `setItems()`

```php
setItems(iterable $items)
```

```php
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
            MenuGroup::make('System')->setItems([
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('Roles', new MoonShineUserRoleResource()),
            ])
        ];
    }

    //...
}
```

> [!NOTE]
> To create a multi-level menu, groups can be nested.

<a name="attributes"></a>  
## Attributes  

The `customAttributes()` method allows you to add your own attributes for groups and menu items.  

```php
customAttributes(array $attributes)  
```  
 ```php
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
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                )
                    ->customAttributes(['class' => 'group-li-custom-class']),
            ])
                ->customAttributes(['class' => 'group-li-custom-class'])
        ];
    }

    //...
}
```

The `linkAttributes()` method allows you to add attributes to the `a` link tag.

```php
linkAttributes(array $attributes)
```

```php
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
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                )
                    ->linkAttributes(['class' => 'group-a-custom-class']),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ])
                ->linkAttributes(['class' => 'group-button-custom-class'])
        ];
    }

    //...
}
```

<a name="divider"></a>  
## Delimiter  

Menu items can be visually divided using *MoonShine\Menu\MenuDivider*.  

```php
MenuDivider::make(Closure|string $label = '')  
```  

```php
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuDivider::make(),
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
```

![menu_divider](https://moonshine-laravel.com/screenshots/menu_divider.png)
![menu_divider_dark](https://moonshine-laravel.com/screenshots/menu_divider_dark.png)

You can use text as a delimiter; to do this, you need to pass it to the `make()` method.

```php
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuDivider::make('Divider'),
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
```

![menu_divider_label](https://moonshine-laravel.com/screenshots/menu_divider_label.png)
![menu_divider_label_dark](https://moonshine-laravel.com/screenshots/menu_divider_label_dark.png)

<a name="condition"></a>  
## Display condition  

You can display menu items based on conditions using the `canSee()` method.  

```php
canSee(Closure $callback)  
```  

```php
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
                    ->canSee(fn()=> false)
            ])
                ->canSee(function(Request $request) {
                    return $request->user('moonshine')?->id === 1;
                })
        ];
    }

    //...
}
```

<a name="icon"></a>  
## Icon  

You can set an icon for a menu item and a group. This can be accomplished in several ways.  

####  Via parameter  

The icon can be set by passing the name as the third parameter in static method `make()`.  
 
```php
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
                MenuItem::make('Admins', new MoonShineUserResource(), 'heroicons.outline.users'),
                MenuItem::make('Roles', new MoonShineUserRoleResource(), 'heroicons.hashtag'),
            ])
        ];
    }

    //...
}
```  
#### Via method

Use method `icon()`.  

```php
icon(string $icon)  
```  

```php
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
                    ->icon('heroicons.outline.users'),
                MenuItem::make('Roles', new MoonShineUserRoleResource())
                    ->icon('heroicons.hashtag'),
            ])
                ->icon('heroicons.cog')
        ];
    }

    //...
}
```  

#### Via attribute  
  

The menu item will display an icon if the class [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index), [Page](https://moonshine-laravel.com/docs/resource/page/page-class) or *Resource* the `Icon` attribute is specified and the icon is not overridden in other ways.  

```php
namespace MoonShine\Resources;

#[Icon('heroicons.outline.users')]
class MoonShineUserResource extends ModelResource
{

    //...

}
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="badge"></a>  
## Label  

It is also possible to add an icon to a menu item.  

#### Via menu item  
  
To add a badge to a menu item, use method `badge()`, which takes a closure as a parameter.  

```php
badge(Closure $callback)  
```

```php
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
                ->badge(fn() => Comment::count())
        ];
    }

    //...
}
```

#### Through a class method

For [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index), [Page](https://moonshine-laravel.com/docs/resource/page/page-class) or Resource There is an alternative way to set the badge - method `getBadge()`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getBadge(): string
    {
        return 'new';
    }

    //...
}
```

![menu_badge](https://moonshine-laravel.com/screenshots/menu_badge.png)
![menu_badge_dark](https://moonshine-laravel.com/screenshots/menu_badge_dark.png)

<a name="translation"></a>  
## Translation  

To translate menu items, you need to pass the translation key as the name and add method `translatable()`  

```php
translatable(string $key = '')  
```  

```php
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
                ->translatable()
            // or
            MenuItem::make('Comments', new CommentResource())
                ->translatable('menu')
        ];
    }

    //...
}
```

```php
// lang/ru/menu.php

return [
    'Comments' => 'Comments',
];
```

You can use Laravel's translation tools to translate menu labels.

```php
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
                ->badge(fn() => __('menu.badge.new'))
        ];
    }

    //...
}
```

<a name="target-blank"></a>  
## Open in new tab  

A menu item can have a flag indicating whether the link should be opened in a new tab or not. This can be implemented in several ways.  

#### Via parameter  

The flag can be set by passing `true/false` or a closure in a static method `make()`.  


```php
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
                MenuItem::make('MoonShine Docs', 'https://moonshine-laravel.com/docs', 'heroicons.arrow-up', true),
                MenuItem::make('Laravel Docs', 'https://laravel.com/docs', 'heroicons.arrow-up', fn() => true),
            ])
        ];
    }

    //...
}
```  

#### Via method  

Use method `blank()`.  

```php
blank(Closure|bool $blankCondition = true)  
```  
```php
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('MoonShine Docs', 'https://moonshine-laravel.com/docs')
                ->blank(),
            MenuItem::make('Laravel Docs', 'https://laravel.com/docs')
                ->blank(fn() => true),
        ];
    }

    //...
}
```

<a name="force-active"></a>  
## Active item  

The menu item becomes active if it matches the url, but the `forceActive()` method allows you to force the item to be active.  

```php
forceActive(Closure|bool $forceActive)  
```

```php
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuItem::make('Label', '/endpoint')
                ->forceActive(fn() => request()->fullUrlIs('*admin/endpoint/*')),
        ];
    }

    //...
}
```

<a name="custom-view"></a>  
## Custom view  

When you need to change the view using *fluent* interface you can use the `customView()` method.  

```php
customView(string $path)  
```  

```php
namespace App\Providers;

use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('Group', [
                MenuItem::make('Label', '/endpoint')
                    ->customView('admin.custom-menu-item'),
            ])
                ->customView('admin.custom-menu-group'),
        ];
    }

    //...
}
```
