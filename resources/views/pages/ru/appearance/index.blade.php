<x-page title="Icons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#logo', 'label' => 'Логотип'],
        ['url' => '#theme', 'label' => 'Основная тема'],
        ['url' => '#colors', 'label' => 'Цветовая схема'],
    ]
]">

<x-sub-title id="logo">Логотип</x-sub-title>

<x-p>
    Меняется в конфигурационном файле <code>config/moonshine.php</code>
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
    При необходимости можно создать собственный css который заменит системный
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...
    /**
    * @return array{css: string, colors: array, darkColors: array}
    */
    protected function theme(): array
    {
        return [
            'css' => 'path_to_theme.css'
        ];
    }
    //...
}

</x-code>

<x-sub-title id="colors">Цветовая схема</x-sub-title>

<x-p>
    Изменить определенные цвета
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...
    /**
    * @return array{css: string, colors: array, darkColors: array}
    */
    protected function theme(): array
    {
        return [
            'colors' => [
                // Можно использовать hex
                'primary' => '#0000',
                // или rgb
                'secondary' => 'rgb(120, 67, 233)',
            ],
        ];
    }
    //...
}
</x-code>

<x-p>
    Если необходимо изменить цвета темной темы
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...
    /**
    * @return array{css: string, colors: array, darkColors: array}
    */
    protected function theme(): array
    {
        return [
            'darkColors' => [
                'body' => 'rgb(27, 37, 59)',
            ]
        ];
    }
    //...
}
</x-code>

<x-p>
    Все доступные значения и цвета по умолчанию
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...
    /**
    * @return array{css: string, colors: array, darkColors: array}
    */
    protected function theme(): array
    {
        return [
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
        ];
    }
    //...
}
</x-code>
</x-page>
