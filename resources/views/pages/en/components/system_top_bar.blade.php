<x-page
    title="System component TopBar"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#actions', 'label' => 'Actions'],
            ['url' => '#hide-logo', 'label' => 'Hide logo'],
            ['url' => '#hide-switcher', 'label' => 'Hide theme switcher'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>TopBar</em> system component is used to create the top navigation bar in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>TopBar</em> using the static method <code>make()</code>
    class <code>TopBar</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-p>
    As a parameter, method <code>make()</code> takes an array with components.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar; // [tl! focus]
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([ // [tl! focus]
                Menu::make()->top()
            ]),  // [tl! focus]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/topbar.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/topbar_dark.png') }}"></x-image>

<x-sub-title id="actions">Actions</x-sub-title>

<x-p>
    Method <code>actions()</code> of the <em>TopBar</em> component allows you to add additional elements to the
    <em>actions</em> areas. The method takes an array of components as a parameter.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->actions([ // [tl! focus:start]
                    When::make(
                        static fn() => config('moonshine.auth.enable', true),
                        static fn() => [Profile::make()]
                    )
                ]), // [tl! focus:end]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/topbar_actions.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/topbar_actions_dark.png') }}"></x-image>

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
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
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
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->hideSwitcher(), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

</x-page>
