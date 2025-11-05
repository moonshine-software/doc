---
video: https://youtu.be/6eUtdbCLVZQ?si=Ll3Xg1LihfigMhqs&t=1106
---

# Color Manager

- [Basics](#basics)
- [Default Colors](#default-colors)
- [Palettes](#palettes)
    - [Standard Palettes](#standard-palettes)
    - [Palette Usage](#palette-usage)
- [Methods](#methods)
    - [Set Colors](#set-colors)
    - [Get Colors](#get-colors)
    - [Theme Management](#theme)
    - [Component Shortcuts](#shortcuts)
- [HTML Output](#html)
- [Color Conversion](#conversion)
- [Global Override](#service-provider)

---

<a name="basics"></a>
## Basics

`ColorManager` is used to control the color scheme of the admin panel.
It allows you to configure the colors of various interface elements for both light and dark themes.

`ColorManager` сan be used in `Layout` or globally in `ServiceProvider`.

<a name="default-colors"></a>
## Default Colors

MoonShine ships with `MoonShine\ColorManager\Palettes\DefaultPalette`.  
It exposes the light and dark palettes in OKLCH notation:

```php
[
    'primary' => '0.627 0.265 303.9',
    'primary-text' => '1 0 0',
    'secondary' => '0.746 0.16 232.661',
    'secondary-text' => '1 0 0',
    'body' => '0.98 0.0035 67.78',
    'theme' => [
        'body' => '0 0 0',         // default text
        'stroke' => '0 0 0 / 10%', // borders
        'default' => '1 0 0',      // background
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

The dark palette mirrors the same structure:

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
## Palettes

Palettes allow you to encapsulate light and dark color schemes in dedicated classes.  
A palette implements `MoonShine\Contracts\ColorManager\PaletteContract` and returns two associative arrays:

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

<a name="standard-palettes"></a>
### Standard Palettes

MoonShine ships with a set of ready-made palettes:

| Class | Description |
| --- | --- |
| `MoonShine\ColorManager\Palettes\DefaultPalette` | Black and white classic. |
| `MoonShine\ColorManager\Palettes\CyanPalette` | True cyan blue-green. |
| `MoonShine\ColorManager\Palettes\GrayPalette` | Cool neutral gray. |
| `MoonShine\ColorManager\Palettes\GreenPalette` | Natural green tones. |
| `MoonShine\ColorManager\Palettes\HalloweenPalette` | Orange and purple spooky theme. |
| `MoonShine\ColorManager\Palettes\LimePalette` | Bright lime/chartreuse. |
| `MoonShine\ColorManager\Palettes\OrangePalette` | Classic orange. |
| `MoonShine\ColorManager\Palettes\PinkPalette` | Bold hot pink shades. |
| `MoonShine\ColorManager\Palettes\PurplePalette` | Classic purple and magenta mix. |
| `MoonShine\ColorManager\Palettes\RetroPalette` | Vintage yellowish green. |
| `MoonShine\ColorManager\Palettes\RosePalette` | Warm peachy-rose tones. |
| `MoonShine\ColorManager\Palettes\SkyPalette` | Sky blue with a purple undertone. |
| `MoonShine\ColorManager\Palettes\SpringPalette` | Fresh pastel mint green. |
| `MoonShine\ColorManager\Palettes\TealPalette` | Pure cyan-teal blend. |
| `MoonShine\ColorManager\Palettes\ValentinePalette` | Romantic red and pink duo. |
| `MoonShine\ColorManager\Palettes\WinterPalette` | Cool icy blue tones. |
| `MoonShine\ColorManager\Palettes\YellowPalette` | Greenish yellow. |

<a name="palette-usage"></a>
### Palette Usage

You can activate a palette:

- globally by setting the `palette` key in `config/moonshine.php` (or via `MoonShineConfigurator`);
- in a layout by setting the `$palette` property to the palette class name;
- programmatically, by calling `$colorManager->palette(new CorporatePalette());`.

```php
use App\MoonShine\Palettes\CorporatePalette;
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected ?string $palette = CorporatePalette::class;
}
```

If the layout does not define `$palette`, MoonShine falls back to the global configuration value.

After choosing a palette, you can move on to configuring colors via the `ColorManager` API. The following sections cover the core methods, ways to read values back, and shortcuts for common components.

<a name="methods"></a>
## Methods

<a name="set-colors"></a>
### Set Colors

Use `set()`, `setEverything()`, or `bulkAssign()` to control individual variables.  
Pass `everything: true` when you want to apply the same value to both light and dark themes.

```php
// Set a single color (OKLCH, HEX, RGB, and RGBA are accepted)
$colorManager->set('primary', 'oklch(65% 0.18 264)');

// Set color for dark theme
$colorManager->set('primary', 'oklch(60% 0.17 264)', dark: true);

// Apply color to both light and dark themes at once
$colorManager->set('primary', '#7357ff', everything: true);

// Explicit helper that syncs both themes
$colorManager->setEverything('primary-text', '#ffffff');

// Bulk assign colors (use arrays to define shades)
$colorManager->bulkAssign([
    'theme' => [
        'body' => '0 0 0',
        50 => '0.99 0 0',
        100 => '0.98 0 0',
    ],
], everything: true);

// Apply a palette object
$colorManager->palette(new \App\MoonShine\Palettes\CorporatePalette());

// Update a specific shade via dot notation
$colorManager->set('theme.500', 'oklch(70% 0.10 280)');
$colorManager->set('theme.500', '0.36 0.023 274.32', dark: true);
```

<a name="get-colors"></a>
### Get Colors

```php
// Get color
$colorManager->get('primary'); // Returns HEX by default
$colorManager->get('primary', hex: false); // Returns the stored format

// Get shade
$colorManager->get('theme', 500); // Get a specific shade

// Get all colors
$colorManager->getAll(); // For light theme
$colorManager->getAll(dark: true); // For dark theme
```

<a name="theme"></a>
### Theme Management

`ColorManager` includes component helpers that configure several related variables in one call.

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

`dropzone()` now also controls the file name color through the `text` argument.

<a name="shortcuts"></a>
### Component Shortcuts

`ColorManager` supports dynamic methods for all palette entries and ships with the `ColorShortcuts` trait for higher-level helpers.  
Each helper accepts `dark` and `everything` flags and optional arguments for related colors.

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
## HTML Output

If you need to output color variables in `HTML`, use the `toHtml()` method.

```php
$colorManager->toHtml()
```

Result:

```html
<style>
    :root {
        --primary:0.627 0.265 303.9;
        --secondary:0.746 0.16 232.661;
        /* other light theme variables */
    }
    :root.dark {
        /* dark theme variables */
    }
</style>
```

<a name="conversion"></a>
## Color Conversion

`ColorManager` includes the `ColorMutator` utility for converting between HEX, RGB, RGBA, and OKLCH formats.

```php
use MoonShine\ColorManager\ColorMutator;

// Convert to HEX
ColorMutator::toHEX('oklch(65% 0.18 264)'); // '#7357ff'

// Convert to RGB
ColorMutator::toRGB('#7357ff'); // 'rgb(115,87,255)'

// Convert to OKLCH (accepts RGB, HEX, or short OKLCH strings)
ColorMutator::toOKLCH('rgb(115,87,255)'); // 'oklch(65.07% 0.20052 282.513)'
```

<a name="service-provider"></a>
## Global Override

You can also globally override colors for all `Layout` via `MoonShineServiceProvider`.

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
> `Layout` loads after `ServiceProvider` and will take precedence.  
> When using palettes globally, make sure the target layout does not override colors or provide its own `$palette`.

Combine the approaches described above: start by choosing a palette, adjust single tokens with `set()` or `setEverything()`, apply shortcuts to tweak related components in bulk, and finish by exporting the variables with `toHtml()` for a quick interface review.
