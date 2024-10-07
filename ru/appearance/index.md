# Основы

- [Логотип](#logo)
- [Основная тема](#theme)
- [Цветовая схема](#colors)
- [Менеджер цветов](#color-manager)
- [Фавиконы](#favicons)
- [Минималистичная тема](#minimalistic)

---

<a name="logo"></a>
## Логотип

Может быть изменен в конфигурационном файле `config/moonshine.php`.

```php
return [
    # Заголовок админ-панели
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # Вы можете изменить логотип, указав путь (пример - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),
];
```

<a name="theme"></a>
## Основная тема

Метод `theme()` в провайдере `MoonShineServiceProvider` позволяет настроить тему админ-панели *MoonShine*.

```php
/**
* @return array{css: string, colors: array, darkColors: array}
*/
protected function theme(): array
```

При необходимости вы можете создать собственный css-файл, который заменит системный.

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
   //...
 
   protected function theme(): array
   {
       return [
           'css' => 'путь_к_теме.css'
       ];
   }
 
   //...
}
```

Вы также можете использовать замыкание на основе текущего запроса для настройки темы.

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
> Это будет полезно, если вы решите использовать *multi tenancy* или если у вас есть как веб-, так и админ-части, реализованные на MoonShine.

<a name="colors"></a>
## Цветовая схема

Если вам нужно переопределить определенные цвета светлой схемы, то из метода `theme()` нужно вернуть массив, содержащий ключ `colors`.

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
> При указании цвета вы можете использовать *hex* или *rgb*.

Цвета в темной теме определяются ключом массива `darkColors`

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

Все доступные значения по умолчанию и цвета:

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
## Менеджер цветов

*Менеджер цветов* в админ-панели MoonShine позволяет более удобно управлять вашей цветовой схемой.

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

Вы можете изменить ключ массива цветов через магический метод, например, если вам нужно изменить цвет success-bg в темной теме.

```php
keyName(string $value, string $shade, string $dark)
```

- `keyName` - ключ в массиве цветов,
- `$value` - значение цвета,
- `$shade` - оттенок цвета (необязательный параметр),
- `$dark` - темная тема, по умолчанию светлая тема (необязательный параметр).

```php
moonshineColors()->successBg('#000000', dark: true);
```

<a name="favicons"></a>
## Фавиконы

Чтобы изменить *фавиконы* в админ-панели *MoonShine*, вам нужно переопределить соответствующий шаблон.

Для этого выполните консольную команду и выберите `Favicons`.

```
php artisan moonshine:publish
```

> [!WARNING]
> Для выбора соответствующего пункта используйте пробел.

Или скопируйте файл `vendor/moonshine/moonshine/resources/views/layouts/shared/favicon.blade.php` в `resources/views/vendor/moonshine/layouts/shared/favicon.blade.php`.

Затем измените ссылки на файлы в этом шаблоне, чтобы они указывали на ваши собственные фавиконы.

<a name="minimalistic"></a>
## Минималистичная тема

Для минималистичной темы вам нужно добавить файл стилей, установить цвета и задать класс `theme-minimalistic` для тега body.

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
