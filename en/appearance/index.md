https://moonshine-laravel.com/docs/resource/appearance/appearance-index?change-moonshine-locale=en

------
# Basics

- [Logo](#logo)
- [Main theme](#theme)
- [Color scheme](#colors)
- [Color manager](#color-manager)
- [Favicons](#favicons)
- [Minimalistic theme](#minimalistic)

<a name="logo"></a>
## Logo

Can be changed in the configuration file `config/moonshine.php`.

```php
return [
    # Admin panel title
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # You can change the logo by specifying the path (example - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),
];
```

<a name="theme"></a>
## Main theme

`theme()` method in the `MoonShineServiceProvider` provider allows you to configure the *MoonShine* admin panel theme.


```php
/**
* @return array{css: string, colors: array, darkColors: array}
*/
protected function theme(): array
```

If necessary, you can create your own css file that will replace the system one.

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
   //...
 
   protected function theme(): array
   {
       return [
           'css' => 'path_to_theme.css'
       ];
   }
 
   //...
}
```

You can also use a closure based on the current request to configure a topic.

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
   //...
 
   protected function theme(): Closure
   {
       return static function (MoonShineRequest $request) {
           return [
               //...
           ];
       }
   }
 
   //...
}
```

> [!NOTE]
> It will be useful if you decide to use *multi tenancy* or if you have both the web and admin parts implemented on MoonShine.


<a name="colors"></a>
## Color scheme

If you need to override certain light scheme colors, then from method `theme()` you need to return an array containing key `colors`.

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function theme(): array
    {
        return [
            'colors' => [
                'primary' => '#0000',
                'secondary' => 'rgb(120, 67, 233)',
            ],
        ];
    }

    //...
}
```

> [!NOTE]
> When specifying a color, you can use *hex* or *rgb*.

The colors in the dark theme are determined by the `darkColors` array key

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
   //...
 
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
```

All available default values and colors:

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

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
```

<a name="color-manager"></a>
## Color-manager

The *Color Manager* in the MoonShine admin panel allows you to manage your color scheme more conveniently.

```php
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
            ->secondary('#AE76A6');
    }

    //...
}
```

You can change the color array key through a magic method, for example if you need to change the color of success-bg in a dark theme.

```php
keyName(string $value, string $shade, string $dark)
```

-`keyName` - key in color array;
-`$value` - color value;
-`$shade` - color tint (optional parameter);
-`$dark` - dark theme, default light theme (optional parameter).

```php
moonshineColors()->successBg('#000000', dark: true);
```

<a name="favicons"></a>
## Favicons

To change *favicons* in the *MoonShine* admin panel,you need to override the corresponding template.

To do this, run the console command and select `Favicons`.

```
php artisan moonshine:publish
```

> [!WARNING]
> To select the appropriate item, use the space bar.

Or copy the file `vendor/moonshine/moonshine/resources/views/layouts/shared/favicon.blade.php` in `resources/views/vendor/moonshine/layouts/shared/favicon.blade.php`.

Then change the file links in this template to point to your own favicons.


<a name="minimalistic"></a>
## Minimalistic theme

For a minimal theme you need to add a style file, set colors and set the `theme-minimalistic` class to the body tag.


```php
// app/Providers/MoonShineServiceProvider.php

public function boot(): void
{
    parent::boot();

    moonshineAssets()->add(['/vendor/moonshine/assets/minimalistic.css']);

    moonshineColors()
        ->primary('#1E96FC')
        ->secondary('#1D8A99')
        ->body('249, 250, 251')
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
        ->dark('74, 90, 121', 100, dark: true)
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
```

```php
// app/MoonShine/MoonShineLayout.php

LayoutBuilder::make(...)
    ->bodyClass('theme-minimalistic');
```
