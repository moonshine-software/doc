<x-page
    title="System component Sidebar"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#hide-logo', 'label' => 'Hide logo'],
            ['url' => '#hide-switcher', 'label' => 'Hide theme switcher'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Sidebar</em> system component is used to create a side menu in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>Sidebar</em> using the static method <code>make()</code>
    class <code>Sidebar</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-p>
    The <code>make()</code> method takes an array of components as a parameter.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar; // [tl! focus]
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([ // [tl! focus]
                Menu::make()->customAttributes(['class' => 'mt-2']),
                Profile::make(withBorder: true)
            ]), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/sidebar.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/sidebar_dark.png') }}"></x-image>

<x-sub-title id="hide-logo">Hide logo</x-sub-title>

<x-p>
    The <code>hideLogo()</code> method allows you to hide the logo.
</x-p>

<x-code language="php">
hideLogo()
</x-code>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make(),
                Profile::make(withBorder: true)
            ])
                ->hideLogo(), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

<x-sub-title id="hide-switcher">Hide theme switcher</x-sub-title>

<x-p>
    The <code>hideSwitcher()</code> method allows you to hide the theme switcher.
</x-p>

<x-code language="php">
    hideSwitcher()
</x-code>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make(),
                Profile::make(withBorder: true)
            ])
                ->hideSwitcher(), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

</x-page>
