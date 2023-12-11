<x-page
    title="System component Sidebar"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Sidebar</em> system component is used to create a side menu in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>Sidebar</em> using the static <code>make()</code> method
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

</x-page>
