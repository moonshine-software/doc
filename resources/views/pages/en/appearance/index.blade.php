<x-page title="Appearance" :sectionMenu="[
    'Sections' => [
        ['url' => '#logo', 'label' => 'Logo'],
        ['url' => '#theme', 'label' => 'Main theme'],
        ['url' => '#colors', 'label' => 'Color scheme'],
        ['url' => '#color-manager', 'label' => 'Color manager'],
    ]
]">
<x-sub-title id="logo">Logo</x-sub-title>

<x-p>
    Changes in the configuration file <code>config/moonshine.php</code>.
</x-p>

<x-code language="php">
return [
    # Admin panel title
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    # You can change the logo by specifying the path (example - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'), // [tl! focus]
    'logo_small' => env('MOONSHINE_LOGO_SMALL'), // [tl! focus]
];
</x-code>

<x-sub-title id="theme">Main theme</x-sub-title>

<x-p>
    <code>theme()</code> method in the <code>MoonShineServiceProvider</code> provider
    allows you to configure the <strong>MoonShine</strong> admin panel theme.
</x-p>

<x-code language="php">
/**
* @return array{css: string, colors: array, darkColors: array}
*/
protected function theme(): array // [tl! focus]
</x-code>

<x-p>
    If necessary, you can create your own css file that will replace the system one.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): array // [tl! focus:start]
    {
        return [
            'css' => 'path_to_theme.css'
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    You can also use a closure based on the current request to configure a topic.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): Closure // [tl! focus:start]
    {
        return static function (MoonShineRequest $request) {
            return [
                //...
            ];
        }
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    It will be useful if you decide to use <em>multi tenancy</em> or if you have both the web and admin parts implemented on MoonShine.
</x-moonshine::alert>

<x-sub-title id="colors">Color scheme</x-sub-title>

<x-p>
    If you need to override certain light scheme colors,
    then from the <code>theme()</code> method you need to return an array containing the <code>colors</code> key.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): array
    {
        return [
            'colors' => [
                'primary' => '#0000',
                'secondary' => 'rgb(120, 67, 233)',
            ], // [tl! focus:-3]
        ];
    }

    //...
}
</x-code>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.book-open">
    When specifying a color, you can use <em>hex</em> or <em>rgb</em>.
</x-moonshine::alert>

<x-p>
    The colors in the dark theme are determined by the <code>darkColors</code> array key.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): array
    {
        return [
            'darkColors' => [
                'body' => 'rgb(27, 37, 59)',
            ] // [tl! focus:-2]
        ];
    }
    //...
}
</x-code>

<x-p>
    All available default values and colors:
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): array
    {
        return [ // [tl! focus:start]
            'colors' => [
                'primary' => 'rgb(120, 67, 233)',
                'secondary' => 'rgb(236, 65, 118)',
                'body' => 'rgb(27, 37, 59)',
                'dark' => [
                    'DEFAULT' => 'rgb(30, 31, 67)',
                    50 => 'rgb(83, 103, 132)',
                    100 => 'rgb(74, 90, 121)',
                    200 => 'rgb(65, 81, 114)',
                    300 => 'rgb(53, 69, 103)',
                    400 => 'rgb(48, 61, 93)',
                    500 => 'rgb(41, 53, 82)',
                    600 => 'rgb(40, 51, 78)',
                    700 => 'rgb(39, 45, 69)',
                    800 => 'rgb(27, 37, 59)',
                    900 => 'rgb(15, 23, 42)',
                ],

                'success-bg' => 'rgb(0, 170, 0)',
                'success-text' => 'rgb(255, 255, 255)',
                'warning-bg' => 'rgb(255, 220, 42)',
                'warning-text' => 'rgb(139, 116, 0)',
                'error-bg' => 'rgb(224, 45, 45)',
                'error-text' => 'rgb(255, 255, 255)',
                'info-bg' => 'rgb(0, 121, 255)',
                'info-text' => 'rgb(255, 255, 255)',
            ],
            'darkColors' => [
                'body' => 'rgb(27, 37, 59)',
                'success-bg' => 'rgb(17, 157, 17)',
                'success-text' => 'rgb(178, 255, 178)',
                'warning-bg' => 'rgb(225, 169, 0)',
                'warning-text' => 'rgb(255, 255, 199)',
                'error-bg' => 'rgb(190, 10, 10)',
                'error-text' => 'rgb(255, 197, 197)',
                'info-bg' => 'rgb(38, 93, 205)',
                'info-text' => 'rgb(179, 220, 255)',
            ]
        ];// [tl! focus:end]
    }

    //...
}
</x-code>

<x-sub-title id="color-manager">Color manager</x-sub-title>

<x-p>
    The <em>Color Manager</em> in the <strong>MoonShine</strong> admin panel allows you to more conveniently manage your color scheme.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonshineColors()
            ->background('#A3C3D9')
            ->content('#A3C3D9')
            ->tableRow('#AE76A6')
            ->dividers('#AE76A6')
            ->borders('#AE76A6')
            ->buttons('#AE76A6')
            ->primary('#CCD6EB')
            ->secondary('#AE76A6');  // [tl! focus:-8]
    }

    //...
}
</x-code>

<x-p>
    You can change the color array key through a magic method, for example if you need to change the color of success-bg in a dark theme.
</x-p>

<x-code language="php">
keyName(string $value, string $shade, string $dark)
</x-code>

<x-ul>
    <li><code>keyName</code> - key in color array;</li>
    <li><code>$value</code> - color meaning;</li>
    <li><code>$shade</code> - color tint (optional parameter);</li>
    <li><code>$dark</code> - dark theme, default light theme (optional parameter).</li>
</x-ul>

<x-code language="php">
    moonshineColors()->successBg('#000000', dark: true);
</x-code>

</x-page>
