# Меню

- [Основы](#basics)
- [Группы](#group)
- [Атрибуты](#attributes)
- [Разделитель](#divider)
- [Условие отображения](#condition)
- [Иконка](#icon)
- [Метка](#badge)
- [Перевод](#translation)
- [Открытие в новой вкладке](#target-blank)
- [Активный элемент](#force-active)
- [Пользовательское представление](#custom-view)

---

<a name="basics"></a>
## Основы

Навигационное меню настраивается в **App\Providers\MoonShineServiceProvider** через метод `menu()`, который возвращает массив элементов меню.

Чтобы добавить пункт меню, необходимо использовать класс **MoonShine\Menu\MenuItem** и его статический метод `make()`.

```php
MenuItem::make(Closure|string $label, Closure|MenuFiller|string $filler, null|string $icon = null, Closure|bool $blank = false)
```

`$label` - название пункта меню
`$filler` - элемент для формирования url
`$icon` - иконка для пункта меню,
`$blank` - открыть в новой вкладке.

> [!NOTE]
> В качестве второго параметра можно передать [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index), [Page](https://moonshine-laravel.com/docs/resource/page/page-class) или Resource.

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
            MenuItem::make('Администраторы', new MoonShineUserResource()),
            MenuItem::make('Главная', fn() => route('home')),
            MenuItem::make('Документация', 'https://moonshine-laravel.com/docs'),
            MenuItem::make('Документация Laravel', 'https://laravel.com/docs', blank: true)
        ];
    }

    //...
}
```

> [!NOTE]
> Если меню создается для [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index) или Resource, то пункт меню будет использовать первую страницу, объявленную в методе `pages()`.

#### Меню через Closure

Вы можете объявить меню, используя замыкание на основе текущего запроса:

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
> Это будет полезно, если вы решите использовать мультитенантность или если у вас реализованы как веб, так и админ части на MoonShine.

> [!WARNING]
> При объявлении меню с использованием *Closure* необходимо вручную зарегистрировать [страницы](https://moonshine-laravel.com/docs/resource/page/page-instance#define) и [ресурсы](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) в соответствующих методах.

<a name="group"></a>
## Группы

Пункты меню можно объединять в группы. Для этого используйте класс **MoonShine\Menu\MenuGroup** со статическим методом `make()`.

```php
MenuGroup::make(Closure|string $label, iterable $items, null|string $icon = null)
```

`$label` - название группы
`$items` - массив компонентов меню
`$icon` - иконка для группы.

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
            MenuGroup::make('Система', [
                MenuItem::make('Администраторы', new MoonShineUserResource()),
                MenuItem::make('Роли', new MoonShineUserRoleResource()),
            ])
        ];
    }

    //...
}
```

![menu](https://moonshine-laravel.com/screenshots/menu.png)
![menu_dark](https://moonshine-laravel.com/screenshots/menu_dark.png)

Вы также можете добавлять элементы в группу, используя метод `setItems()`

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
            MenuGroup::make('Система')->setItems([
                MenuItem::make('Администраторы', new MoonShineUserResource()),
                MenuItem::make('Роли', new MoonShineUserRoleResource()),
            ])
        ];
    }

    //...
}
```

> [!NOTE]
> Для создания многоуровневого меню группы можно вкладывать друг в друга.

<a name="attributes"></a>
## Атрибуты

Метод `customAttributes()` позволяет добавлять собственные атрибуты для групп и пунктов меню.

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

Метод `linkAttributes()` позволяет добавлять атрибуты к тегу ссылки `a`.

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
## Разделитель

Пункты меню можно визуально разделить с помощью *MoonShine\Menu\MenuDivider*.

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
            MenuItem::make('Администраторы', new MoonShineUserResource()),
            MenuDivider::make(),
            MenuItem::make('Роли', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
```

![menu_divider](https://moonshine-laravel.com/screenshots/menu_divider.png)
![menu_divider_dark](https://moonshine-laravel.com/screenshots/menu_divider_dark.png)

Вы можете использовать текст в качестве разделителя; для этого нужно передать его в метод `make()`.

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
            MenuItem::make('Администраторы', new MoonShineUserResource()),
            MenuDivider::make('Разделитель'),
            MenuItem::make('Роли', new MoonShineUserRoleResource()),
        ];
    }

    //...
}
```

![menu_divider_label](https://moonshine-laravel.com/screenshots/menu_divider_label.png)
![menu_divider_label_dark](https://moonshine-laravel.com/screenshots/menu_divider_label_dark.png)

<a name="condition"></a>
## Условие отображения

Вы можете отображать пункты меню на основе условий с помощью метода `canSee()`.

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
            MenuGroup::make('Система', [
                MenuItem::make('Администраторы', new MoonShineUserResource()),
                MenuItem::make('Роли', new MoonShineUserRoleResource())
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
## Иконка

Вы можете установить иконку для пункта меню и группы. Это можно сделать несколькими способами.

#### Через параметр

Иконку можно установить, передав название в качестве третьего параметра в статическом методе `make()`.

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
            MenuGroup::make('Система', [
                MenuItem::make('Администраторы', new MoonShineUserResource(), 'heroicons.outline.users'),
                MenuItem::make('Роли', new MoonShineUserRoleResource(), 'heroicons.hashtag'),
            ])
        ];
    }

    //...
}
```

#### Через метод

Используйте метод `icon()`.

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
            MenuGroup::make('Система', [
                MenuItem::make('Администраторы', new MoonShineUserResource())
                    ->icon('heroicons.outline.users'),
                MenuItem::make('Роли', new MoonShineUserRoleResource())
                    ->icon('heroicons.hashtag'),
            ])
                ->icon('heroicons.cog')
        ];
    }

    //...
}
```

#### Через атрибут

Пункт меню отобразит иконку, если у класса [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index), [Page](https://moonshine-laravel.com/docs/resource/page/page-class) или *Resource* указан атрибут `Icon`, и иконка не переопределена другими способами.

```php
namespace MoonShine\Resources;

#[Icon('heroicons.outline.users')]
class MoonShineUserResource extends ModelResource
{

    //...

}
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="badge"></a>
## Метка

Также возможно добавить метку к пункту меню.

#### Через пункт меню

Чтобы добавить метку к пункту меню, используйте метод `badge()`, который принимает замыкание в качестве параметра.

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
            MenuItem::make('Комментарии', new CommentResource())
                ->badge(fn() => Comment::count())
        ];
    }

    //...
}
```

#### Через метод класса

Для [ModelResource](https://moonshine-laravel.com/docs/resource/models-resources/resources-index), [Page](https://moonshine-laravel.com/docs/resource/page/page-class) или Resource есть альтернативный способ установки метки - метод `getBadge()`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getBadge(): string
    {
        return 'новый';
    }

    //...
}
```

![menu_badge](https://moonshine-laravel.com/screenshots/menu_badge.png)
![menu_badge_dark](https://moonshine-laravel.com/screenshots/menu_badge_dark.png)

<a name="translation"></a>
## Перевод

Для перевода пунктов меню нужно передать ключ перевода в качестве имени и добавить метод `translatable()`

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
            // или
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
    'Comments' => 'Комментарии',
];
```

Вы можете использовать инструменты перевода Laravel для перевода меток меню.

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
            MenuItem::make('Комментарии', new CommentResource())
                ->badge(fn() => __('menu.badge.new'))
        ];
    }

    //...
}
```

<a name="target-blank"></a>
## Открытие в новой вкладке

Пункт меню может иметь флаг, указывающий, должна ли ссылка открываться в новой вкладке или нет. Это можно реализовать несколькими способами.

#### Через параметр

Флаг можно установить, передав `true/false` или замыкание в статический метод `make()`.

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
            MenuGroup::make('Система', [
                MenuItem::make('Документация MoonShine', 'https://moonshine-laravel.com/docs', 'heroicons.arrow-up', true),
                MenuItem::make('Документация Laravel', 'https://laravel.com/docs', 'heroicons.arrow-up', fn() => true),
            ])
        ];
    }

    //...
}
```

#### Через метод

Используйте метод `blank()`.

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
            MenuItem::make('Документация MoonShine', 'https://moonshine-laravel.com/docs')
                ->blank(),
            MenuItem::make('Документация Laravel', 'https://laravel.com/docs')
                ->blank(fn() => true),
        ];
    }

    //...
}
```

<a name="force-active"></a>
## Активный элемент

Пункт меню становится активным, если он соответствует url, но метод `forceActive()` позволяет принудительно сделать элемент активным.

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
            MenuItem::make('Метка', '/endpoint')
                ->forceActive(fn() => request()->fullUrlIs('*admin/endpoint/*')),
        ];
    }

    //...
}
```

<a name="custom-view"></a>
## Пользовательское представление

Когда вам нужно изменить представление, используя *fluent* интерфейс, вы можете использовать метод `customView()`.

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
            MenuGroup::make('Группа', [
                MenuItem::make('Метка', '/endpoint')
                    ->customView('admin.custom-menu-item'),
            ])
                ->customView('admin.custom-menu-group'),
        ];
    }

    //...
}
```