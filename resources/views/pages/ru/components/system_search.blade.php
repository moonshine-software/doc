<x-page
    title="Системный компонент Search"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>Search</em> служит для отображения формы поиска в
    <strong>MoonShine</strong>.
</x-p>

<x-p>
    Создать <em>Search</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Search</code>.
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
