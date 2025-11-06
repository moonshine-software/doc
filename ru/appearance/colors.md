---
video: https://youtu.be/95qxienFmtI?si=89rh5M5inDBim5ZP&t=1144
---

# Color Manager

- [Основы](#basics)
- [Основные цвета](#default-colors)
- [Палитры](#palettes)
    - [Стандартные палитры](#standard-palettes)
    - [Способы подключения](#palette-usage)
- [Методы](#methods)
    - [Установка цветов](#set-colors)
    - [Получение цветов](#get-colors)
    - [Управление темой](#theme)
    - [Компонентные шорткаты](#shortcuts)
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

По умолчанию MoonShine приходит с преднастроенным набором цветовых переменных.
Ниже приведён массив, который используется сразу после установки (подробнее о палитрах рассказываем в следующем разделе):

```php
return [
    'body' => '0.99 0 0',
    'primary' => '0.25 0 0',
    'primary-text' => '1 0 0',
    'secondary' => '0.6 0 0',
    'secondary-text' => '1 0 0',
    'base' => [
        'text' => '0.25 0 0',
        'stroke' => '0.25 0 0 / 20%',
        'default' => '1 0 0',
        50 => '0.985 0 0',
        100 => '0.97 0 0',
        200 => '0.955 0 0',
        300 => '0.94 0 0',
        400 => '0.925 0 0',
        500 => '0.91 0 0',
        600 => '0.88 0 0',
        700 => '0.85 0 0',
        800 => '0.80 0 0',
        900 => '0.75 0 0',
    ],
    'success' => '0.64 0.22 142.49',
    'success-text' => '0.46 0.16 142.49',
    'warning' => '0.75 0.17 75.35',
    'warning-text' => '0.5 0.10 76.10',
    'error' => '0.58 0.21 26.855',
    'error-text' => '0.37 0.145 26.85',
    'info' => '0.60 0.219 257.63',
    'info-text' => '0.35 0.12 257.63',
];
```

<a name="palettes"></a>
## Палитры

Палитры помогают инкапсулировать светлую и тёмную схемы в отдельных классах.

<a name="standard-palettes"></a>
### Стандартные палитры

MoonShine поставляется с набором предустановленных палитр. По умолчанию активна `MoonShine\ColorManager\Palettes\PurplePalette`.

- `CyanPalette`: Чистый циан с голубовато-зеленым оттенком.
- `GrayPalette`: Холодный нейтральный серый.
- `GreenPalette`: Натуральный зелёный.
- `HalloweenPalette`: Оранжево-фиолетовая палитра с атмосферой Хэллоуина.
- `LimePalette`: Яркий лаймово-салатовый.
- `NeutralPalette`: Нейтральная черно-белая классика.
- `OrangePalette`: Классический оранжевый.
- `PinkPalette`: Насыщенные тона ярко-розового.
- `PurplePalette`: Классическая пурпурно-магентовая палитра.
- `RetroPalette`: Винтажный желтовато-зеленый.
- `RosePalette`: Тёплые персиково-розовые оттенки.
- `SkyPalette`: Небесно-голубая с лёгким фиолетовым подтоном.
- `SpringPalette`: Нежный пастельный мятный.
- `TealPalette`: Чистый бирюзовый.
- `ValentinePalette`: Романтичные красно-розовые оттенки.
- `WinterPalette`: Прохладные ледяные голубые тона.
- `YellowPalette`: Зеленовато-желтая палитра.

> [!TIP]
> Вы можете посмотреть, как всё выглядит, или создать свою палитру на [getmoonshine.app/palette-generator](https://getmoonshine.app/palette-generator).

Чтобы создать собственную палитру, реализуйте контракт и верните пары светлых и тёмных значений:

```php
namespace App\MoonShine\Palettes;

use MoonShine\Contracts\ColorManager\PaletteContract;

final class CorporatePalette implements PaletteContract
{
    public function getColors(): array
    {
        return [
            'primary' => 'oklch(65% 0.18 264)',
            'base' => [
                'default' => '0 0 0',
                50 => 'oklch(98% 0.02 250)',
                // ...
            ],
        ];
    }

    public function getDarkColors(): array
    {
        return [
            'primary' => 'oklch(60% 0.17 264)',
            'base' => [
                'default' => '0.24 0 0',
                50 => 'oklch(98% 0.02 250)',
                // ...
            ],
            // ...
        ];
    }
}
```

<a name="palette-usage"></a>
### Способы подключения

Активировать палитру можно несколькими способами:

- глобально указать класс в ключе `palette` внутри `config/moonshine.php` (или через `MoonShineConfigurator`);
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

Если layout не задаёт `$palette`, MoonShine использует значение из глобальной конфигурации.

После выбора палитры можно переходить к настройке цветов через API `ColorManager`. Далее мы последовательно разберём базовые методы, способы получения значений и готовые хелперы для компонентов.

<a name="methods"></a>
## Методы

<a name="set-colors"></a>
### Установка цветов

Используйте `set()`, `setEverything()` или `bulkAssign()` для управления отдельными переменными.
Передавайте `everything: true`, если значение нужно применить сразу к светлой и тёмной темам.

```php
// Установка одного цвета (поддерживаются OKLCH, HEX, RGB, RGBA)
$colorManager->set('primary', 'oklch(65% 0.18 264)');

// Значение для тёмной темы
$colorManager->set('primary', 'oklch(60% 0.17 264)', dark: true);

// Одновременное применение к светлой и тёмной темам
$colorManager->set('primary', '#7357ff', everything: true);

// Явный хелпер для синхронизации тем
$colorManager->setEverything('primary-text', '#ffffff');

// Массовая установка (массивом удобно задавать оттенки)
$colorManager->bulkAssign([
    'base' => [
        'default' => '0 0 0',
        50 => '0.99 0 0',
        100 => '0.98 0 0',
    ],
], everything: true);

// Подключение палитры
$colorManager->palette(new \App\MoonShine\Palettes\CorporatePalette());

// Обновление конкретного оттенка через dot-нотацию
$colorManager->set('base.500', 'oklch(70% 0.10 280)');
$colorManager->set('base.500', '0.36 0.023 274.32', dark: true);
```

<a name="get-colors"></a>
### Получение цветов

```php
// Получение цвета
$colorManager->get('primary'); // Возвращает HEX по умолчанию
$colorManager->get('primary', hex: false); // Возвращает исходный формат

// Получение оттенка
$colorManager->get('base', 500); // Конкретный оттенок

// Получение всех цветов
$colorManager->getAll(); // Для светлой темы
$colorManager->getAll(dark: true); // Для тёмной темы
```

<a name="theme"></a>
### Управление темой

`ColorManager` включает компонентные хелперы, которые настраивают связанные переменные одним вызовом. Примеры ниже показывают три частых сценария: базовые настройки фона и текста, интерактивные элементы навигации и формы со всеми состояниями.

```php
$colorManager->background('oklch(91% 0 0)', pageBg: 'oklch(98% 0 0)');
$colorManager->text('oklch(20% 0.04 274)');
$colorManager->borders('oklch(72% 0.02 274)');
$colorManager->button(
    'oklch(65% 0.18 264)',
    text: '#ffffff',
    hoverBg: 'oklch(60% 0.18 264)',
    hoverText: '#f8fafc'
);
$colorManager->menu(
    'oklch(70% 0.14 230)',
    text: '#0f172a',
    hoverBg: 'oklch(80% 0.05 230)'
);
$colorManager->dropzone(
    'oklch(98% 0 0)',
    text: '#0f172a',
    icon: '#2563eb'
);
$colorManager->form(
    bg: 'oklch(100% 0 0)',
    text: '#0f172a',
    focus: '#2563eb',
    disabled: '#f1f5f9',
    disabledText: '#64748b'
);
```

Метод `dropzone()` также управляет цветом имени файла через аргумент `text`.

<a name="shortcuts"></a>
### Компонентные шорткаты

`ColorManager` поддерживает динамические методы для всех записей палитры и включает трейт `ColorShortcuts` с высокоуровневыми хелперами.
Когда нужно скорректировать сразу группу переменных (фон, текст, hover-состояния), используйте соответствующий шорткат;
когда требуется точечное изменение конкретного токена, выбирайте `set()` или `setEverything()`.
Каждый хелпер принимает флаги `dark` и `everything`, а также дополнительные аргументы для связанных цветов.

```php
$colorManager->primary('oklch(65% 0.18 264)', text: '#ffffff');
$colorManager->success('oklch(63.9% 0.218 142.495)', text: '#194638', everything: true);
$colorManager->collapse(
    'oklch(100% 0 0)',
    text: '#0f172a',
    bgOpen: 'oklch(96% 0 0)'
);
$colorManager->progress(
    bg: 'oklch(96% 0 0)',
    barBg: 'oklch(65% 0.18 264)',
    text: '#0f172a'
);
$colorManager->theme('oklch(95% 0.01 274)', 400);
$colorManager->theme('oklch(35% 0.18 274)', 800, dark: true);
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

Комбинируйте описанные подходы: начните с выбора палитры, при необходимости настройте отдельные переменные через `set()` или `setEverything()`, затем примените шорткаты для пакетной правки компонентов и, наконец, выведите итоговые значения через `toHtml()` для быстрой проверки в интерфейсе.
