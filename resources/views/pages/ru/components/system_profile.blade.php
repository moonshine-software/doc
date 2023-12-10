<x-page
    title="Системный компонент Profile"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>Profile</em> служит для отображения информации об авторизованном пользователе в
    <strong>MoonShine</strong>.
</x-p>

<x-p>
    Создать <em>Profile</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Profile</code>.
</x-p>

<x-code language="php">
make(bool $withBorder = false)
</x-code>

<x-p>
    <code>$withBorder</code> - разделить перед компонентом.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile; // [tl! focus]
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                Profile::make(withBorder: true) // [tl! focus]
            ]),

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/profile.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/profile_dark.png') }}"></x-image>

</x-page>
