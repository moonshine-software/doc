<x-page
    title="Системный компонент TopBar"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#actions', 'label' => 'Actions'],
            ['url' => '#hide-logo', 'label' => 'Скрыть логотип'],
            ['url' => '#hide-switcher', 'label' => 'Скрыть переключатель темы'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>TopBar</em> служит для создания верхней панели навигации в <strong>MoonShine</strong>.
</x-p>

<x-p>
    Создать <em>TopBar</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>TopBar</code>.
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
use MoonShine\Components\Layout\TopBar; // [tl! focus]
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([ // [tl! focus]
                Menu::make()->top()
            ]),  // [tl! focus]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/topbar.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/topbar_dark.png') }}"></x-image>

<x-sub-title id="actions">Actions</x-sub-title>

<x-p>
    Метод <code>actions()</code> компонента <em>TopBar</em> позволяет добавить дополнительные элементы в области
    <em>actions</em>. Метод в качестве параметра принимает массив компонентов.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->actions([ // [tl! focus:start]
                    When::make(
                        static fn() => config('moonshine.auth.enable', true),
                        static fn() => [Profile::make()]
                    )
                ]), // [tl! focus:end]

            //...
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/topbar_actions.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/topbar_actions_dark.png') }}"></x-image>

<x-sub-title id="hide-logo">Скрыть логотип</x-sub-title>

<x-p>
    Метод <code>hideLogo()</code> позволяет скрыть логотип.
</x-p>

<x-code language="php">
hideLogo()
</x-code>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->hideLogo(), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

<x-sub-title id="hide-switcher">Скрыть переключатель темы</x-sub-title>

<x-p>
    Метод <code>hideSwitcher()</code> позволяет скрыть переключатель темы.
</x-p>

<x-code language="php">
    hideSwitcher()
</x-code>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->hideSwitcher(), // [tl! focus]

            //...
        ]);
    }
}
</x-code>

</x-page>
