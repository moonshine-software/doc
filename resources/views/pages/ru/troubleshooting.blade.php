<x-page title="Частые проблемы" :sectionMenu="[
    'Sections' => [
        ['url' => '#images-are-not-displayed', 'label' => 'Не отображаются изображения'],
        ['url' => '#default-language', 'label' => 'Язык по умолчанию'],
        ['url' => '#problems-with-https', 'label' => 'Проблемы с https'],
        ['url' => '#error-page-not-found', 'label' => 'Ошибка Page not found'],
    ]
]">

<x-sub-title id="images-are-not-displayed">Не отображаются изображения</x-sub-title>

<x-ul>
    <li>Убедитесь что выполнили <code>php artisan storage:link</code></li>
    <li>Убедитесь что по умолчанию выбран диск <code>public</code>, а не <code>local</code></li>
    <li>
        Проверьте что <code>APP_URL</code> в <code>.env</code> соответствует действительности
        <x-code>
            APP_URL=http://moonshine.test:8080
        </x-code>
    </li>
</x-ul>

<x-sub-title id="default-language">Язык по умолчанию</x-sub-title>

<x-p>
    Если вы оставили в конфиге MoonShine только один язык, но в панели используется другой
</x-p>

<x-ul>
    <li>Убедитесь что в конфиге Laravel <code>config/app.php</code> указан тот же язык, что и в MoonShine</li>
</x-ul>

<x-sub-title id="problems-with-https">Проблемы с https</x-sub-title>

<x-p>
    Если в формах у вас используются url с http, а ожидаете https
</x-p>

<x-ul>
    <li>Убедитесь что у вас качественный ssl сертификат</li>
    <li>В middleware <code>TrustProxies</code> установите <code>protected $proxies = ['*']</code></li>
</x-ul>

<x-sub-title id="error-page-not-found">Ошибка Page not found</x-sub-title>

<x-ul>
    <li>
        Проверьте <code>config/app.php</code> на наличие в нем MoonShineServiceProvider.
        К примеру пакет Apiato меняет его структуру и MoonShine не может добавить провайдер автоматически.
        Добавьте самостоятельно
    </li>
    <li>Убедитесь что ресурс или страница объявлены в MoonShineServiceProvider</li>
    <li>Сбросьте кеш</li>
</x-ul>

</x-page>
