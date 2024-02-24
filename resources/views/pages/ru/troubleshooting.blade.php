<x-page title="Частые проблемы" :sectionMenu="null">
    <x-sub-title>Не отображаются изображения</x-sub-title>

    <ol>
        <li>Убедитесь что выполнили <code>php artisan storage:link</code></li>
        <li>Убедитесь что по умолчанию выбран диск <code>public</code>, а не <code>local</code></li>
        <li>Проверьте что <code>APP_URL</code> в <code>.env</code> соответствует действительности</li>
    </ol>

    <x-sub-title>Язык по умолчанию</x-sub-title>

    <x-p>
        Если вы оставили в конфиге MoonShine только один язык, но в панели используется другой
    </x-p>

    <ol>
        <li>Убедитесь что в конфиге Laravel <code>config/app.php</code> указан тот же язык, что и в MoonShine</li>
    </ol>

    <x-sub-title>Проблемы с https</x-sub-title>

    <x-p>
        Если в формах у вас используются url с http, а ожидаете https
    </x-p>

    <ol>
        <li>Убедитесь что у вас качественный ssl сертификат</li>
        <li>В middleware <code>TrustProxies</code> установите <code>protected $proxies = ['*']</code></li>
    </ol>

    <x-sub-title>Ошибка Page not found</x-sub-title>

    <ol>
        <li>
            Проверьте <code>config/app.php</code> на наличие в нем MoonShineServiceProvider.
            К примеру пакет Apiato меняет его структуру и MoonShine не может добавить провайдер автоматически.
            Добавьте самостоятельно
        </li>

        <li>
            Убедитесь что ресурс или страница объявлены в MoonShineServiceProvider
        </li>

        <li>
            Сбросьте кеш
        </li>
    </ol>
</x-page>
