<x-page
    title="Component When"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>When</em> component allows you to display other components based on a condition.
</x-p>

<x-p>
    You can create <em>When</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(Closure $condition, Closure $components, ?Closure $default = null)
</x-code>

<x-p>
    <ul>
        <li><code>$condition</code> - method execution condition;</li>
        <li><code>$components</code> - a closure that returns an array of elements when the condition is met;</li>
        <li><code>$default</code> - a closure that returns an array of default elements.</li>
    </ul>
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\{LayoutBlock, LayoutBuilder, Menu, Profile, Sidebar};
use MoonShine\Components\When; // [tl! focus]
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                When::make(
                    static fn() => config('moonshine.auth.enable', true),
                    static fn() => [Profile::make(withBorder: true)]
                ) // [tl! focus:-3]
            ]),

            //...
        ]);
    }
}
</x-code>

</x-page>
