<x-page
    title="System component Search"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Search</em> system component is used to display the search form in
    <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>Search</em> using the static <code>make()</code> method
    class <code>Search</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\Header;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Search; // [tl! focus]
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Header::make([
                Search::make() // [tl! focus]
            ]),

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/search_component.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/search_component_dark.png') }}"></x-image>

</x-page>
