<x-page title="Icons" :sectionMenu="[
    'Sections' => [
        ['url' => '#publish', 'label' => 'Publishing a template'],
        ['url' => '#topbar', 'label' => 'Top Menu'],
    ]
]">

<x-sub-title id="publish">Publishing a template</x-sub-title>

<x-p>
    To change the structure of the template, you must use <code>LayoutBuilder</code>.
</x-p>

<x-p>
    The first step is to publish the template modification class using the console command.
</x-p>

<x-code language="shell">
php artisan moonshine:publish layout
</x-code>

@include('pages.en.shared.alert_select_item_console')

<x-p>
    After publishing <em>Layout</em>, the <code>MoonShineLayout.php</code> class will appear in the <code>app/MoonShine</code> directory.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
    Flash,
    Footer,
    Header,
    LayoutBlock,
    LayoutBuilder,
    Menu,
    Profile,
    Search,
    Sidebar};
use MoonShine\Components\When;
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
                ),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    Search::make(),
                ]),
                Content::make(),
                Footer::make()->copyright(fn (): string => <<<'HTML'
                        &copy; 2021-2023 Made with ❤️ by
                        <a href="https://cutcode.dev"
                            class="font-semibold text-primary hover:text-secondary"
                            target="_blank"
                        >
                            CutCode
                        </a>
                    HTML)->menu([
                    'https://moonshine.cutcode.dev' => 'Documentation',
                ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
</x-code>

<x-sub-title id="topbar">Top Menu</x-sub-title>

<x-p>
    By default, MoonShine has a top menu component.
    Let's take a look at how to replace <code>Sidebar</code> with <code>TopBar</code> in <code>LayoutBuilder</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
    Flash,
    Footer,
    Header,
    LayoutBlock,
    LayoutBuilder,
    Menu,
    Profile,
    Search,
    TopBar};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->actions([
                    When::make(
                        static fn() => config('moonshine.auth.enable', true),
                        static fn() => [Profile::make()]
                    )
                ]), // [tl! focus:-8]
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    Search::make(),
                ]),
                Content::make(),
                Footer::make()->copyright(fn (): string => <<<'HTML'
                        &copy; 2021-2023 Made with ❤️ by
                        <a href="https://cutcode.dev"
                            class="font-semibold text-primary hover:text-secondary"
                            target="_blank"
                        >
                            CutCode
                        </a>
                    HTML)->menu([
                    'https://moonshine.cutcode.dev' => 'Documentation',
                ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
</x-code>

</x-page>
