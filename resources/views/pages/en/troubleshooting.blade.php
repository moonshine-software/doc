<x-page title="Frequent problems" :sectionMenu="[
    'Sections' => [
        ['url' => '#images-are-not-displayed', 'label' => 'Images are not displayed'],
        ['url' => '#default-language', 'label' => 'Default language'],
        ['url' => '#problems-with-https', 'label' => 'Problems with https'],
        ['url' => '#error-page-not-found', 'label' => 'Error Page not found'],
    ]
]">

<x-sub-title id="images-are-not-displayed">Images are not displayed</x-sub-title>

<x-ul>
    <li>Make sure you've done <code>php artisan storage:link</code></li>
    <li>Make sure the disk is selected by default <code>public</code>, not <code>local</code></li>
    <li>
        Check that <code>APP_URL</code> in <code>.env</code> is correct
        <x-code>
            APP_URL=http://moonshine.test:8080
        </x-code>
    </li>
</x-ul>

<x-sub-title id="default-language">Default language</x-sub-title>

<x-p>
    If you have left only one language in the MoonShine config, but another language is used in the panel
</x-p>

<x-ul>
    <li>Make sure that the Laravel config <code>config/app.php</code> specifies the same language as MoonShine</li>
</x-ul>

<x-sub-title id="problems-with-https">Problems with https</x-sub-title>

<x-p>
    If you have forms using url with http, but expect https
</x-p>

<x-ul>
    <li>Make sure you have a quality ssl certificate</li>
    <li>In middleware <code>TrustProxies</code> set <code>protected $proxies = ['*']</code></li>
</x-ul>

<x-sub-title id="error-page-not-found">Error Page not found</x-sub-title>

<x-ul>
    <li>
        Check <code>config/app.php</code> for MoonShineServiceProvider.
        For example, the Apiato package changes its structure and MoonShine cannot be added by the provider automatically.
        Add it yourself
    </li>
    <li>Make sure the resource or page is declared in MoonShineServiceProvider</li>
    <li>Clear cache</li>
</x-ul>

</x-page>
