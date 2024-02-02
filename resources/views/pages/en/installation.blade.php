<x-page
    title="Installation"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#requirements', 'label' => 'Requirements'],
            ['url' => '#composer', 'label' => 'Composer'],
            ['url' => '#install', 'label' => 'Installation'],
            ['url' => '#admin', 'label' => 'Creating an administrator'],
            ['url' => '#config', 'label' => 'Service provider'],
        ]
    ]"
>

<x-sub-title id="requirements">Requirements</x-sub-title>

<x-p>
    To use MoonShine, the following requirements must be met before installation:
</x-p>

<x-ul :items="['php >= 8.1', 'laravel >= 10.23', 'composer > 2']"></x-ul>

<x-sub-title id="composer">Composer</x-sub-title>

<x-code language="shell">
    composer require moonshine/moonshine
</x-code>

<x-sub-title id="install">Installation</x-sub-title>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Once executed, a <code>config/moonshine.php</code> with basic settings will be added.<br />
    <x-link link="{{ to_page('configuration') }}">More information about the configuration file</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    A directory with the administration panel and resources will also be added - <code>app/MoonShine</code>.<br />
    <x-link link="{{ to_page('resources-index') }}">More about Resources</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    And a <code>MoonShineServiceProvider</code> provider will also be added,
    where resources should be registered.<br />
    <x-link link="{{ to_page('resources-index') }}">More about Resources</x-link>
</x-moonshine::alert>

<x-sub-title id="admin">Creating an administrator</x-sub-title>

<x-p>
    If during the installation of the admin panel <code>MoonShine</code> an administrator was not created or it is necessary to create another one,
    you can do it by executing the console command.
</x-p>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title id="config">Service provider</x-sub-title>

<x-p>
    To register new resources in MoonShine and create a menu, we need <code>app/Providers/MoonShineServiceProvider.php</code>
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
    Once installed, several resources will be registered in the <code>MoonShineServiceProvider</code>.<br />
    <x-link link="{{ to_page('menu') }}">More about Menu</x-link>.
</x-moonshine::alert>

<x-p>
    Great! Now you can create and register sections of the future admin panel and get to work!
    But don't forget to read the documentation to the end!
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    By default, the admin panel can be accessed by url <code>/admin</code>.<br />
    You can change the url in
    <x-link link="{{ to_page('configuration') }}">configuration file</x-link>.
</x-moonshine::alert>

</x-page>
