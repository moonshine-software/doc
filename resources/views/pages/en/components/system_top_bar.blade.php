<x-page
    title="System component TopBar"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#actions', 'label' => 'Actions'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>TopBar</em> system component is used to create the top navigation bar in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>TopBar</em> using the static <code>make()</code> method
    class <code>TopBar</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-p>
    В качестве параметра метод <code>make()</code> принимает массив с компонентами.
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
    The <code>actions()</code> method of the <em>TopBar</em> component allows you to add additional elements to the areas
    <em>actions</em>. The method takes an array of components as a parameter.
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

</x-page>
