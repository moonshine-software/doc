<x-page
    title="Установка"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#requirements', 'label' => 'Требования'],
            ['url' => '#composer', 'label' => 'Composer'],
            ['url' => '#install', 'label' => 'Установка'],
            ['url' => '#config', 'label' => 'Конфигурация'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/GjW6vyBsuhc', 'title' => 'Screencasts: Установка и настройка'],
    ]"
>

<x-sub-title id="requirements">Требования</x-sub-title>

<x-p>
    Для использования MoonShine необходимо выполнение следующих требований перед установкой:
</x-p>

<x-ul :items="['php >=8.0', 'laravel >= 9.0', 'composer']"></x-ul>
<x-sub-title id="composer" hashtag="1">Composer</x-sub-title>

<x-code language="shell">
    composer require moonshine/moonshine
</x-code>

<x-sub-title id="install" hashtag="2">Установка</x-sub-title>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    После выполнения будет добавлен <code>config/moonshine.php</code> с основными настройками.
    <x-link link="#config">Подробнее о файле конфигурации</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Также будет добавлена директория с административной панелью и ресурсами - <code>app/MoonShine</code>.
    <x-link link="{{ route('moonshine.custom_page', 'resources-index') }}">Подробнее о Ресурсах</x-link>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    А также будет добавлен MoonShineServiceProvider <code>App\Providers\MoonShineServiceProvider</code>, где нужно регистрировать ресурсы.
    <x-link link="{{ route('moonshine.custom_page', 'resources-index') }}">Подробнее о Ресурсах</x-link>
</x-moonshine::alert>

<x-sub-title hashtag="3">
    Создание администратора
</x-sub-title>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title hashtag="4">
    Регистрация ресурсов и конфигурация меню
</x-sub-title>

<x-p>
    Для регистрации новых ресурсов в MoonShine и формирования меню, нам потребуется <code>app/Providers/MoonShineServiceProvider.php</code>
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
    В данном примере мы добавили пункт меню с администраторами панели
    <x-link link="{{ route('moonshine.custom_page', 'advanced-menu') }}">Подробнее о Меню</x-link>
</x-p>

<x-p>
    Отлично! Теперь можно создавать и регистрировать разделы будущей админ. панели и приступать к работе!
    Но не забудьте ознакомиться с документацией до конца!
</x-p>
</x-page>
