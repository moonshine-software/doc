<x-page
    title="Системный компонент Sidebar"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>Sidebar</em> служит для создания бокового меню в <strong>MoonShine</strong>.
</x-p>

<x-p>
    Создать <em>Sidebar</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Sidebar</code>.
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
