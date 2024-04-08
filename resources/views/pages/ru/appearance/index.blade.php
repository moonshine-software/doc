<x-page title="Внешний вид" :sectionMenu="[
    'Разделы' => [
        ['url' => '#logo', 'label' => 'Логотип'],
        ['url' => '#theme', 'label' => 'Основная тема'],
        ['url' => '#colors', 'label' => 'Цветовая схема'],
        ['url' => '#color-manager', 'label' => 'Менеджер цветов'],
        ['url' => '#minimalistic', 'label' => 'Минимальная тема'],
    ]
]">

<x-sub-title id="logo">Логотип</x-sub-title>

<x-p>
    Меняется в конфигурационном файле <code>config/moonshine.php</code>.
</x-p>

<x-code language="php">
return [
    # Заголовок админ-панели
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    # Вы можете изменить логотип, указав путь (пример - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'), // [tl! focus]
    'logo_small' => env('MOONSHINE_LOGO_SMALL'), // [tl! focus]
];
</x-code>

<x-sub-title id="theme">Основная тема</x-sub-title>

<x-p>
    Метод <code>theme()</code> в провайдере <code>MoonShineServiceProvider</code>
    позволяет конфигурировать тему админ-панели <strong>MoonShine</strong>.
</x-p>

<x-code language="php">
/**
* @return array{css: string, colors: array, darkColors: array}
*/
protected function theme(): array // [tl! focus]
</x-code>

<x-p>
    При необходимости можно создать собственный css файл, который заменит системный.
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
    Для конфигурации темы можно также использовать замыкание на основе текущего реквеста.
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
    Будет полезно если вы решили использовать <em>multi tenancy</em> или же у вас и веб и админ часть реализована на MoonShine.
</x-moonshine::alert>

<x-sub-title id="colors">Цветовая схема</x-sub-title>

<x-p>
    Если необходимо переопределить определенные цвета светлой схемы,
    то из метода <code>theme()</code> нужно вернуть массив, содержащий ключ <code>colors</code>.
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
    При указании цвета можно использовать <em>hex</em> или <em>rgb</em>.
</x-moonshine::alert>

<x-p>
    За цвета в темной теме отвечает ключ массива <code>darkColors</code>.
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
    Все доступные значения и цвета по умолчанию:
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

<x-sub-title id="color-manager">Менеджер цветов</x-sub-title>

<x-p>
    <em>Менеджер цветов</em> в админ-панели <strong>MoonShine</strong> позволяет более удобно управлять цветовой схемой.
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
    Изменить ключ массива цветов можно через магический метод, например если вам требуется изменить цвет success-bg в темной теме.
</x-p>

<x-code language="php">
keyName(string $value, string $shade, string $dark)
</x-code>

<x-ul>
    <li><code>keyName</code> - ключ в массиве цветов;</li>
    <li><code>$value</code> - значение цвета;</li>
    <li><code>$shade</code> - оттенок цвета (необязательный параметр);</li>
    <li><code>$dark</code> - темная тема, по умолчанию светлая тема (необязательный параметр).</li>
</x-ul>

<x-code language="php">
    moonshineColors()->successBg('#000000', dark: true);
</x-code>

<x-sub-title id="minimalistic">Минимальная тема</x-sub-title>

<x-p>
    Для минимальной темы необходимо добавить файл стилей,
    задать цвета и установить класс <code>theme-minimalistic</code> у тега body.
</x-p>

<x-code language="php">
// app/Providers/MoonShineServiceProvider.php

public function boot(): void
{
    parent::boot();

    moonshineAssets()->add(['/vendor/moonshine/assets/minimalistic.css']);

    moonshineColors()
        ->primary('#1E96FC')
        ->secondary('#1D8A99')
        ->body('255, 255, 255')
        ->dark('30, 31, 67', 'DEFAULT')
        ->dark('249, 250, 251', 50)
        ->dark('243, 244, 246', 100)
        ->dark('229, 231, 235', 200)
        ->dark('209, 213, 219', 300)
        ->dark('156, 163, 175', 400)
        ->dark('107, 114, 128', 500)
        ->dark('75, 85, 99', 600)
        ->dark('55, 65, 81', 700)
        ->dark('31, 41, 55', 800)
        ->dark('17, 24, 39', 900)
        ->successBg('209, 255, 209')
        ->successText('15, 99, 15')
        ->warningBg('255, 246, 207')
        ->warningText('92, 77, 6')
        ->errorBg('255, 224, 224')
        ->errorText('81, 20, 20')
        ->infoBg('196, 224, 255')
        ->infoText('34, 65, 124');

    moonshineColors()
        ->body('27, 37, 59', dark: true)
        ->dark('83, 103, 132', 50, dark: true)
        ->dark('74, 90, 12', 100, dark: true)
        ->dark('65, 81, 114', 200, dark: true)
        ->dark('53, 69, 103', 300, dark: true)
        ->dark('48, 61, 93', 400, dark: true)
        ->dark('41, 53, 82', 500, dark: true)
        ->dark('40, 51, 78', 600, dark: true)
        ->dark('39, 45, 69', 700, dark: true)
        ->dark('27, 37, 59', 800, dark: true)
        ->dark('15, 23, 42', 900, dark: true)
        ->successBg('17, 157, 17', dark: true)
        ->successText('178, 255, 178', dark: true)
        ->warningBg('225, 169, 0', dark: true)
        ->warningText('255, 255, 199', dark: true)
        ->errorBg('190, 10, 10', dark: true)
        ->errorText('255, 197, 197', dark: true)
        ->infoBg('38, 93, 205', dark: true)
        ->infoText('179, 220, 255', dark: true);
}
</x-code>

<x-code language="php">
// app/MoonShine/MoonShineLayout.php

LayoutBuilder::make(...)
    ->bodyClass('theme-minimalistic'); // [tl! focus]
</x-code>

</x-page>
