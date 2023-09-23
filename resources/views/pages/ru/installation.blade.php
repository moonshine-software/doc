<x-page
    title="Установка"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#requirements', 'label' => 'Требования'],
            ['url' => '#composer', 'label' => 'Composer'],
            ['url' => '#install', 'label' => 'Установка'],
            ['url' => '#config', 'label' => 'Сервис провайдер'],
        ]
    ]"
>

<x-sub-title id="requirements">Требования</x-sub-title>

<x-p>
    Для использования MoonShine необходимо выполнение следующих требований перед установкой:
</x-p>

<x-ul :items="['php >=8.1', 'laravel >= 10.20', 'composer']"></x-ul>

<x-sub-title id="composer" hashtag="1">Composer</x-sub-title>

<x-code language="shell">
    composer require moonshine/moonshine
</x-code>

<x-sub-title id="install">Установка</x-sub-title>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    После выполнения будет добавлен <code>config/moonshine.php</code> с основными настройками.<br />
    <x-link link="{{ route('moonshine.custom_page', 'configuration') }}">Подробнее о файле конфигурации</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Также будет добавлена директория с административной панелью и ресурсами - <code>app/MoonShine</code>.<br />
    <x-link link="{{ route('moonshine.custom_page', 'resources-index') }}">Подробнее о Ресурсах</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    А также будет добавлен провайдер <code>MoonShineServiceProvider</code>,
    где необходимо регистрировать ресурсы.<br />
    <x-link link="{{ route('moonshine.custom_page', 'resources-index') }}">Подробнее о Ресурсах</x-link>
</x-moonshine::alert>

<x-sub-title id="admin">
    Создание администратора
</x-sub-title>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title id="config">Сервис провайдер</x-sub-title>

<x-p>
    Для регистрации новых ресурсов в MoonShine и формирования меню нам потребуется <code>app/Providers/MoonShineServiceProvider.php</code>
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
    protected function resources(): array
    {
        return [
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('moonshine::ui.resource.system', [
               MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                   ->translatable(),
               MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                   ->translatable(),
            ])->translatable(),

            MenuItem::make('Documentation', 'https://laravel.com')
               ->badge(fn() => 'Check'),
        ];
    }

    protected function theme(): array
    {
        return [];
    }
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    После установки в <code>MoonShineServiceProvider</code> будет зарегистрировано несколько ресурсов.<br />
    <x-link link="{{ route('moonshine.custom_page', 'advanced-menu') }}">Подробнее о Меню</x-link>
</x-moonshine::alert>

<x-p>
    Отлично! Теперь можно создавать и регистрировать разделы будущей админ-панели и приступать к работе!
    Но не забудьте ознакомиться с документацией до конца!
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию админ-панель доступна по url <code>/admin</code>.<br />
    Изменить url можно в
    <x-link link="{{ route('moonshine.custom_page', 'configuration') }}">файле конфигурации</x-link>.
</x-moonshine::alert>

</x-page>
