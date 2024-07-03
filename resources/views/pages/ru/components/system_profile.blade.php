<x-page
    title="Системный компонент Profile"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#default-avatar', 'label' => 'Аватарка по умолчанию'],
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

<x-sub-title id="default-avatar">Аватарка по умолчанию</x-sub-title>

<x-p>
    Метод <code>defaultAvatar()</code> позволяет переопределить аватарку профиля по умолчанию.
</x-p>

<x-code language="php">
defaultAvatar(string $url)
</x-code>

<x-ul>
    <li><code>$url</code> - url адрес аватарки по умолчанию.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Layout\Profile;

//...

Profile::make()
    ->defaultAvatar("https://ui-avatars.com/api/?name=$name") // [tl! focus]
</x-code>

</x-page>
