<x-page
    title="System component Header"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Header</em> system component is used to create a header block in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>Header</em> using the static <code>make()</code> method
    class <code>Header</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-p>
    <code>$components</code> - массив компонентов которые располагаются в шапке.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\Header; // [tl! focus]
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Search;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Header::make([
                Search::make(),
            ]), // [tl! focus:-2]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/header.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/header_dark.png') }}"></x-image>

</x-page>
