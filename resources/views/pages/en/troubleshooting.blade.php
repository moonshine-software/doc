<x-page title="Frequent problems" :sectionMenu="null">
    <x-sub-title>Images are not displayed</x-sub-title>

    <ol>
        <li>Make sure you've done <code>php artisan storage:link</code></li>
        <li>Make sure the disk is selected by default <code>public</code>, not <code>local</code></li>
        <li>Check that <code>APP_URL</code> in <code>.env</code> is correct</li>
    </ol>

    <x-sub-title>Default language</x-sub-title>

    <x-p>
        If you have left only one language in the MoonShine config, but another language is used in the panel
    </x-p>

    <ol>
        <li>Make sure that the Laravel config <code>config/app.php</code> specifies the same language as MoonShine</li>
    </ol>

    <x-sub-title>Problems with https</x-sub-title>

    <x-p>
        If you have forms using url with http, but expect https
    </x-p>

    <ol>
        <li>Make sure you have a quality ssl certificate</li>
        <li>In middleware <code>TrustProxies</code> set <code>protected $proxies = ['*']</code></li>
    </ol>

    <x-sub-title>Error Page not found</x-sub-title>

    <ol>
        <li>
            Check <code>config/app.php</code> for MoonShineServiceProvider.
            For example, the Apiato package changes its structure and MoonShine cannot be added by the provider automatically.
            Add it yourself
        </li>

        <li>
            Make sure the resource or page is declared in MoonShineServiceProvider
        </li>

        <li>
            Clear cache
        </li>
    </ol>
</x-page>
