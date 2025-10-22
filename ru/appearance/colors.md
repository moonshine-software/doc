---
video: https://youtu.be/95qxienFmtI?si=89rh5M5inDBim5ZP&t=1144
---

# Color Manager

- [Основы](#basics)
- [Основные цвета](#default-colors)
- [Палитры](#palettes)
- [Методы](#methods)
    - [Установка цветов](#set-colors)
    - [Получение цветов](#get-colors)
    - [Управление темой](#theme)
    - [Специальные методы](#special)
- [Вывод в HTML](#html)
- [Конвертация цветов](#conversion)
- [Глобальное переопределение](#service-provider)

---

<a name="basics"></a>
## Основы

`ColorManager` служит для управления цветовой схемой административной панели.
Он позволяет настраивать цвета различных элементов интерфейса как для светлой, так и для тёмной темы.

`ColorManager` можно использовать в `Layout` или глобально в `ServiceProvider`.

<a name="default-colors"></a>
## Основные цвета

MoonShine поставляется с палитрой `MoonShine\ColorManager\Palettes\DefaultPalette`.  
Она возвращает светлую и тёмную схемы в нотации OKLCH:

```php
[
    'primary' => '0.627 0.265 303.9',
    'primary-text' => '1 0 0',
    'secondary' => '0.746 0.16 232.661',
    'secondary-text' => '1 0 0',
    'body' => '0.98 0.0035 67.78',
    'theme' => [
        'body' => '0 0 0',         // текст по умолчанию
        'stroke' => '0 0 0 / 10%', // границы
        'default' => '1 0 0',      // фон
        50 => '0.99 0 0',
        100 => '0.98 0 0',
        // ...
        900 => '0.90 0 0',
    ],
    'success-bg' => '0.639 0.218 142.495',
    'success-text' => '0.4676 0.1549 142.495',
    // ...
];
```

Тёмная палитра имеет ту же структуру:

```php
[
    'primary' => '0.606 0.25 292.717',
    'body' => '0.2 0.0168 274.32',
    'theme' => [
        'body' => '1 0 0',
        'stroke' => '1 0 0 / 10%',
        'default' => '0.24 0.0168 274.32',
        // ...
    ],
    'success-bg' => '0.639 0.218 142.495',
    'warning-bg' => '0.898 0.177 96.726',
    'error-bg' => '0.589 0.214 26.855',
    'info-bg' => '0.601 0.219 257.63',
];
```

<a name="palettes"></a>
## Палитры

Палитры помогают инкапсулировать светлую и тёмную схемы в отдельных классах.  
Класс палитры реализует `MoonShine\Contracts\ColorManager\PaletteContract` и возвращает два массива:

```php
namespace App\MoonShine\Palettes;

use MoonShine\Contracts\ColorManager\PaletteContract;

final class CorporatePalette implements PaletteContract
{
    public function getColors(): array
    {
        return [
            'primary' => 'oklch(65% 0.18 264)',
            'theme' => [
                'body' => '0 0 0',
                50 => 'oklch(98% 0.02 250)',
                // ...
            ],
        ];
    }

    public function getDarkColors(): array
    {
        return [
            'primary' => 'oklch(60% 0.17 264)',
            900 => 'oklch(24% 0.04 274)',
            // ...
        ];
    }
}
```

Активировать палитру можно двумя способами:

- указать класс палитры в свойстве `$palette` внутри `Layout`;
- вызвать `$colorManager->palette(new CorporatePalette());` в коде.

```php
use App\MoonShine\Palettes\CorporatePalette;
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected ?string $palette = CorporatePalette::class;
}
```

<a name="methods"></a>
## Методы

<a name="set-colors"></a>
### Установка цветов

```php
// Установка одного цвета (поддерживаются OKLCH, HEX, RGB, RGBA)
$colorManager->set('primary', 'oklch(65% 0.18 264)');

// Значение для тёмной темы
$colorManager->set('primary', 'oklch(60% 0.17 264)', dark: true);

// Массовая установка (массивом удобно задавать оттенки)
$colorManager->bulkAssign([
    'theme' => [
        'body' => '0 0 0',
        50 => '0.99 0 0',
        100 => '0.98 0 0',
    ],
]);

// Подключение палитры
$colorManager->palette(new \App\MoonShine\Palettes\CorporatePalette());

// Обновление конкретного оттенка через dot-нотацию
$colorManager->set('theme.500', 'oklch(70% 0.10 280)');
$colorManager->set('theme.500', '0.36 0.023 274.32', dark: true);
```

<a name="get-colors"></a>
### Получение цветов

```php
// Получение цвета
$colorManager->get('primary'); // Возвращает HEX по умолчанию
$colorManager->get('primary', hex: false); // Возвращает исходный формат

// Получение оттенка
$colorManager->get('theme', 500); // Конкретный оттенок

// Получение всех цветов
$colorManager->getAll(); // Для светлой темы
$colorManager->getAll(dark: true); // Для тёмной темы
```

<a name="theme"></a>
### Управление темой

```php
// Установка цветов фона
$colorManager->background('oklch(91% 0.0 0)');

// Установка цветов контента
$colorManager->content('oklch(58% 0.05 274)');

// Настройка компонентов интерфейса
$colorManager->tableRow('oklch(56% 0.07 274)'); // Строки таблицы
$colorManager->borders('oklch(72% 0.02 274)'); // Границы
$colorManager->dropdowns('oklch(68% 0.04 274)'); // Выпадающие списки
$colorManager->buttons('oklch(80% 0.08 274)'); // Кнопки
$colorManager->dividers('oklch(90% 0.02 274)'); // Разделители
```

<a name="special"></a>
### Специальные методы

`ColorManager` поддерживает динамические методы для всех основных цветов.

```php
$colorManager->primary('oklch(65% 0.18 264)');
$colorManager->secondary('oklch(70% 0.14 230)');
$colorManager->theme('oklch(95% 0.01 274)', 400);
$colorManager->theme('oklch(35% 0.18 274)', 800, dark: true);
$colorManager->successBg('oklch(63.9% 0.218 142.495)');
$colorManager->successText('oklch(46.76% 0.1549 142.495)');
$colorManager->warningBg('oklch(80.88% 0.170358 75.3501)');
$colorManager->warningText('oklch(50% 0.1031 76.1)');
$colorManager->errorBg('oklch(58.9% 0.214 26.855)');
$colorManager->errorText('oklch(37.06% 0.145 26.855)');
$colorManager->infoBg('oklch(60.1% 0.219 257.63)');
$colorManager->infoText('oklch(34.71% 0.1204 257.63)');
```

<a name="html"></a>
## Вывод в HTML

Если требуется вывести переменные цветов в `HTML` воспользуйтесь методом `toHtml()`.

```php
$colorManager->toHtml()
```

Результат:

```html
<style>
    :root {
        --primary:0.627 0.265 303.9;
        --secondary:0.746 0.16 232.661;
        /* остальные переменные светлой темы */
    }
    :root.dark {
        /* переменные темной темы */
    }
</style>
```

<a name="conversion"></a>
## Конвертация цветов

`ColorManager` включает утилиту `ColorMutator` для конвертации между HEX, RGB, RGBA и OKLCH.

```php
use MoonShine\ColorManager\ColorMutator;

// Конвертация в HEX
ColorMutator::toHEX('oklch(65% 0.18 264)'); // '#7357ff'

// Конвертация в RGB
ColorMutator::toRGB('#7357ff'); // 'rgb(115,87,255)'

// Конвертация в OKLCH (принимает RGB, HEX и сокращённые OKLCH-строки)
ColorMutator::toOKLCH('rgb(115,87,255)'); // 'oklch(65.07% 0.20052 282.513)'
```

<a name="service-provider"></a>
## Глобальное переопределение

Вы также можете переопределить цвета глобально для всех `Layout` через `MoonShineServiceProvider`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use Illuminate\Support\ServiceProvider;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     * @param  ColorManager  $colors
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
        ColorManagerContract $colors,
    ): void
    {
        $colors->palette(new \App\MoonShine\Palettes\CorporatePalette());

        $colors->primary('oklch(65% 0.18 264)');
        $colors->successBg('oklch(70% 0.15 142)');
    }
}
```

> [!WARNING]
> `Layout` загружается после `ServiceProvider` и имеет приоритет.  
> При использовании глобальных палитр убедитесь, что нужный Layout не переопределяет цвета и не задаёт своё свойство `$palette`.
