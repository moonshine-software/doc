<x-page
    title="System component Layout"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#blade', 'label' => 'Blade'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Layout</em> system component serves as the basis for building any page in <strong>MoonShine</strong>.<br />
    It includes the <code>body</code> tag and basic markup elements, as well as the necessary classes and scripts.
</x-p>

<x-p>
    You can create a <em>Layout</em> using the static <code>make()</code> method
    class <code>LayoutBuilder</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-code language="php">
use MoonShine\Components\LayoutBuilder
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([ // [tl! focus]
            // ...
        ]); // [tl! focus]
    }
}
</x-code>

<x-sub-title id="blade">Blade</x-sub-title>

<x-p>
    The component can be used in <em>html</em> markup:
</x-p>

<x-code language="blade" file="resources/views/examples/components/system/layout.blade.php"></x-code>

</x-page>
