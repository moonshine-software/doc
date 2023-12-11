<x-page
    title="Компонент When"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>When</em> позволяет отображать другие компоненты по условию.
</x-p>

<x-p>
    Создать <em>When</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure $condition, Closure $components, ?Closure $default = null)
</x-code>

<x-p>
    <ul>
        <li><code>$condition</code> - условие выполнения метода;</li>
        <li><code>$components</code> - замыкание возвращающее массив элементов при выполнении условия;</li>
        <li><code>$default</code> - замыкание возвращающее массив элементов по умолчанию.</li>
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
