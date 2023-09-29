<x-page
    title="Installation"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#requirements', 'label' => 'Requirements'],
            ['url' => '#composer', 'label' => 'Composer'],
            ['url' => '#install', 'label' => 'Installation'],
            ['url' => '#config', 'label' => 'Configuration'],
        ]
    ]"
>

<x-sub-title id="requirements">Requirements</x-sub-title>

<x-p>
     To use MoonShine, the following requirements must be met prior to installation:
</x-p>

<x-ul :items="['php >=8.0', 'laravel >= 9.0', 'composer']"></x-ul>
<x-sub-title id="composer" hashtag="1">Composer</x-sub-title>

<x-code language="shell">
    composer require moonshine/moonshine
</x-code>

<x-sub-title id="install" hashtag="2">Installation</x-sub-title>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    This command will add <code>config/moonshine.php</code> with the basic settings.
    <x-link link="{{ route('moonshine.page', 'configuration') }}">More about the config file</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    A directory containing the admin panel and resources will also be added - <code>app/MoonShine</code>.
    <x-link link="{{ route('moonshine.page', 'resources-index') }}">More about Resources</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
     It will also add MoonShineServiceProvider <code>App\Providers\MoonShineServiceProvider</code> where you need to register resources.
     <x-link link="{{ route('moonshine.page', 'resources-index') }}">More about Resources</x-link>
</x-moonshine::alert>

<x-sub-title id="admin" hashtag="3">
    Create an Administrator
</x-sub-title>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title id="config" hashtag="4">
    Resource registration and menu configuration
</x-sub-title>

<x-p>
    To register new resources in the MoonShine and configure a menu, we need <code>app/Providers/MoonShineServiceProvider.php</code>
</x-p>

<x-code language="php">
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // [tl! focus:start]
        app(MoonShine::class)->menu([
            MenuItem::make('Admins', new MoonShineUserResource()),
        ]);
        // [tl! focus:end]
    }
}
</x-code>

<x-p>
    In this example, we have added a menu item with panel admins.
    <x-link link="{{ route('moonshine.page', 'advanced-menu') }}">More about Menu</x-link>
</x-p>

<x-p>
    Great! Now you can create and register sections of the future admin panel and proceed with the real work!
    But don't forget to read the documentation all the way through!
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    By default, the admin panel is accessed by url <code>/moonshine</code>. You can change the url in
    <x-link link="{{ route('moonshine.page', 'configuration') }}">config file</x-link>.
</x-moonshine::alert>

</x-page>
