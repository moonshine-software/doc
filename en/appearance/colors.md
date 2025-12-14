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

MoonShine ships with a preconfigured set of color variables.
The array below reflects the values you get right after installation (palettes are covered in the following section):

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
## Palettes

Palettes allow you to encapsulate light and dark color schemes in dedicated classes.

<a name="standard-palettes"></a>
### Standard Palettes

MoonShine ships with a set of ready-made palettes.
The default palette is `MoonShine\ColorManager\Palettes\PurplePalette`.

- `CyanPalette`: True cyan blue-green.
- `GrayPalette`: Cool neutral gray.
- `GreenPalette`: Natural green tones.
- `HalloweenPalette`: Orange and purple spooky theme.
- `LimePalette`: Bright lime/chartreuse.
- `NeutralPalette`: Neutral black and white classic.
- `OrangePalette`: Classic orange.
- `PinkPalette`: Bold hot pink shades.
- `PurplePalette`: Classic purple and magenta mix.
- `RetroPalette`: Vintage yellowish green.
- `RosePalette`: Warm peachy-rose tones.
- `SkyPalette`: Sky blue with a purple undertone.
- `SpringPalette`: Fresh pastel mint green.
- `TealPalette`: Pure cyan-teal blend.
- `ValentinePalette`: Romantic red and pink duo.
- `WinterPalette`: Cool icy blue tones.
- `YellowPalette`: Greenish yellow.

> [!TIP]
> Preview or build palettes at [getmoonshine.app/palette-generator](https://getmoonshine.app/palette-generator).

To create your own palette, implement the contract and return pairs of light and dark values:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Palettes;

use MoonShine\Contracts\ColorManager\PaletteContract; // [tl! collapse:end]

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
### Palette Usage

You can activate a palette:

- globally by setting the `palette` key in `config/moonshine.php` (or via `MoonShineConfigurator`),
- in a layout by setting the `$palette` property to the palette class name,
- programmatically, by calling `$colorManager->palette(new CorporatePalette());`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Palettes\CorporatePalette;
use MoonShine\Laravel\Layouts\AppLayout;

final class MoonShineLayout extends AppLayout
{
    protected ?string $palette = CorporatePalette::class;
}
```

If the layout does not define `$palette`, MoonShine falls back to the global configuration value.

After choosing a palette, you can move on to configuring colors via the `ColorManager` API.
The following sections cover the core methods, ways to read values back, and shortcuts for common components.

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
    'base' => [
        'default' => '0 0 0',
        50 => '0.99 0 0',
        100 => '0.98 0 0',
    ],
], everything: true);

// Apply a palette object
$colorManager->palette(new \App\MoonShine\Palettes\CorporatePalette());

// Update a specific shade via dot notation
$colorManager->set('base.500', 'oklch(70% 0.10 280)');
$colorManager->set('base.500', '0.36 0.023 274.32', dark: true);
```

<a name="get-colors"></a>
### Get Colors

```php
// Get color
$colorManager->get('primary'); // Returns HEX by default
$colorManager->get('primary', hex: false); // Returns the stored format

// Get shade
$colorManager->get('base', 500); // Get a specific shade

// Get all colors
$colorManager->getAll(); // For light theme
$colorManager->getAll(dark: true); // For dark theme
```

<a name="theme"></a>
### Theme Management

`ColorManager` includes component helpers that configure several related variables in one call.
The examples below highlight three common scenarios: baseline text/background tweaks, interactive navigation elements, and fully stateful forms.

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

`dropzone()` also controls the file name color through the `text` argument.

<a name="shortcuts"></a>
### Component Shortcuts

`ColorManager` supports dynamic methods for all palette entries and ships with the `ColorShortcuts` trait for higher-level helpers.
When you need to adjust a group of variables at once (background, text, hover states), use the appropriate shortcut.
When a specific change to a specific token is required, choose `set()` or `setEverything()`.
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
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
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

Combine the approaches described above: start by choosing a palette, adjust single tokens with `set()` or `setEverything()`,
apply shortcuts to tweak related components in bulk, and finish by exporting the variables with `toHtml()` for a quick interface review.
