<x-page
    title="Меню"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#group', 'label' => 'Группы'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
            ['url' => '#divider', 'label' => 'Разделитель'],
            ['url' => '#condition', 'label' => 'Условие отображения'],
            ['url' => '#icon', 'label' => 'Иконка'],
            ['url' => '#badge', 'label' => 'Метка'],
            ['url' => '#translation', 'label' => 'Перевод'],
            ['url' => '#target-blank', 'label' => 'Открытие в новой вкладке'],
            ['url' => '#force-active', 'label' => 'Активный пункт'],
            ['url' => '#custom-view', 'label' => 'Изменение отображения'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Настройка навигационного меню осуществляется в <strong>App\Providers\MoonShineServiceProvider</strong> через метод <code>menu()</code>,
    который возвращает массив элементов меню.
</x-p>

<x-p>
    Для того чтобы добавить пункт меню, необходимо воспользоваться классом <strong>MoonShine\Menu\MenuItem</strong>
    и его статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
MenuItem::make(Closure|string $label, Closure|MenuFiller|string $filler, null|string $icon = null, Closure|bool $blank = false)
</x-code>

<x-ul>
    <li><code>$label</code> - название пункта меню,</li>
    <li><code>$filler</code> - элемент для формирования url,</li>
    <li><code>$icon</code> - иконка для пункта меню,</li>
    <li><code>$blank</code> - открыть в новой вкладке.</li>
</x-ul>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        В качестве второго параметра можно передать
        <x-link :link="to_page('resources-index')">ModelResource</x-link>,
        <x-link :link="to_page('page-class')">Page</x-link> или
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
    Если меню создается для <x-link :link="to_page('resources-index')">ModelResource</x-link>
    или Resource,
    то для элемента меню будет использоваться первая страница объявленная в методе <code>pages()</code>.
</x-moonshine::alert>

<x-moonshine::divider label="Меню через Closure" />

<x-p>
    Объявить меню можно используя замыкание на основе текущего запроса:
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
    Будет полезно если вы решили использовать <em>multi tenancy</em> или же у вас и веб и админ часть реализована на MoonShine.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    При объявлении меню через <em>Closure</em>,
    необходимо вручную зарегистрировать <x-link link="{{ to_page('page-instance') }}#define">страницы</x-link>
    и <x-link link="{{ to_page('resources-index') }}#define">ресурсы</x-link> в соответствующих методах.
</x-moonshine::alert>

<x-sub-title id="group">Группы</x-sub-title>

<x-p>
    Пункты меню можно объединять в группы. Для этого используется класс <strong>MoonShine\Menu\MenuGroup</strong>
    со статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
MenuGroup::make(Closure|string $label, iterable $items, null|string $icon = null)
</x-code>

<x-ul>
    <li><code>$label</code> - название группы,</li>
    <li><code>$items</code> - массив компонентов меню,</li>
    <li><code>$icon</code> - иконка для группы.</li>
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
    Так же группе можно добавить элементы через метод <code>setItems()</code>
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

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Для создания многоуровнего меню, группы можно делать вложенными.
</x-moonshine::alert>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Метод <code>customAttributes()</code> позволяет добавлять свои атрибуты для групп и элементов меню.
</x-p>

<x-code language="php">
customAttributes(array $attributes)
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
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                )
                    ->customAttributes(['class' => 'group-li-custom-class']), // [tl! focus]
            ])
                ->customAttributes(['class' => 'group-li-custom-class']) // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-p>
    Метод <code>linkAttributes()</code> позволяет добавить атрибуты тег ссылки <code>a</code>.
</x-p>

<x-code language="php">
linkAttributes(array $attributes)
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
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                )
                    ->linkAttributes(['class' => 'group-a-custom-class']), // [tl! focus]
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ])
                ->linkAttributes(['class' => 'group-button-custom-class']) // [tl! focus]
        ];
    }

    //...
}
</x-code>

<x-sub-title id="divider">Разделитель</x-sub-title>

<x-p>
    Пункты меню можно визуально разделить с помощью <em>MoonShine\Menu\MenuDivider</em>.
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
    В качестве разделителя можно использовать текст, для этого его нужно передать методу <code>make()</code>.
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

<x-sub-title id="condition">Условие отображения</x-sub-title>

<x-p>
    Отображать элементы меню можно по условию, воспользовавшись методом <code>canSee()</code>.
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

<x-sub-title id="icon">Иконка</x-sub-title>

<x-p>
    У пункта меню и у группы можно задать иконку. Это можно реализовать несколькими методами.
</x-p>

<x-moonshine::divider label="Через параметр" />

<x-p>
    Иконку можно задать, передав третьим параметром название в статическом методе <code>make()</code>.
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

<x-moonshine::divider label="Через метод" />

<x-p>
    Воспользоваться методом <code>icon()</code>.
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

<x-moonshine::divider label="Через атрибут" />

<x-p>
    У пункта меню отобразится иконка, если у класса
    <em><x-link link="{{ to_page('resources-index') }}">ModelResource</x-link></em>,
    <em><x-link link="{{ to_page('page-class') }}">Page</x-link></em>
    или <em>Resource</em>
    задан атрибут <code>Icon</code> и иконка не переопределена другими способами.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

#[Icon('heroicons.outline.users')] // [tl! focus]
class MoonShineUserResource extends ModelResource
{

    //...

}
</x-code>

@include('pages.ru.shared.alert_icons')

<x-sub-title id="badge">Метка</x-sub-title>

<x-p>
    Также есть возможность добавить значок к пункту меню.
</x-p>

<x-moonshine::divider label="Через элемент меню" />

<x-p>
    Для добавления значка к пункту меню используется метод <code>badge()</code>,
    который в качестве параметра принимает замыкание.
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

<x-moonshine::divider label="Через метод класса" />

<x-p>
    Для <em><x-link link="{{ to_page('resources-index') }}">ModelResource</x-link></em>,
    <em><x-link link="{{ to_page('page-class') }}">Page</x-link></em>
    или <em>Resource</em>
    существует альтернативный способ задать значок - метод <code>getBadge()</code>.
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

<x-sub-title id="translation">Перевод</x-sub-title>

<x-p>
    Для перевода пунктов меню необходимо в качестве названия передать ключ перевода
    и добавить метод <code>translatable()</code>
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
    'Comments' => 'Комментарии',
];
</x-code>

<x-p>
    Для перевода меток меню можно воспользоваться средствами перевода Laravel.
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

<x-sub-title id="target-blank">Открытие в новой вкладке</x-sub-title>

<x-p>
    У пункта меню можно указать флаг, указывающий, открывать ссылку в новой вкладке или нет. Это можно реализовать несколькими способами.
</x-p>

<x-moonshine::divider label="Через параметр" />

<x-p>
    Флаг можно задать, передав четвёртым параметром <code>true/false</code> или замыкание в статическом методе <code>make()</code>.
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

<x-moonshine::divider label="Через метод" />

<x-p>
    Воспользоваться методом <code>blank()</code>.
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

<x-sub-title id="force-active">Активный пункт</x-sub-title>

<x-p>
    Пункт меню становится активным если он соответствует url,
    но метод <code>forceActive()</code> позволяет принудительно сделать пункт активным.
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

<x-sub-title id="custom-view">Изменение отображения</x-sub-title>

<x-p>
    Когда необходимо изменить view с помощью <em>fluent interface</em>
    можно воспользоваться методом <code>customView()</code>.
</x-p>

<x-code language="php">
customView(string $path)
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
            MenuGroup::make('Group', [
                MenuItem::make('Label', '/endpoint')
                    ->customView('admin.custom-menu-item'), // [tl! focus]
            ])
                ->customView('admin.custom-menu-group'), // [tl! focus]
        ];
    }

    //...
}
</x-code>

</x-page>
