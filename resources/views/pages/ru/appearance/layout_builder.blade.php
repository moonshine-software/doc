<x-page title="Icons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#publish', 'label' => 'Публикация шаблона'],
        ['url' => '#topbar', 'label' => 'Верхнее меню'],
    ]
]">

<x-sub-title id="publish">Публикация шаблона</x-sub-title>

<x-p>
    Для изменения структуры шаблона необходимо воспользоваться <code>LayoutBuilder</code>.
</x-p>

<x-p>
    Первым делом нужно опубликовать класс по изменению шаблона, воспользовавшись консольной командой.
</x-p>

<x-code language="shell">
php artisan moonshine:publish
</x-code>

<x-p>
    После публикации <em>Layout</em>, в директории <code>app/MoonShine</code> появится класс <code>MoonShineLayout.php</code>.
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

<x-sub-title id="topbar">Верхнее меню</x-sub-title>

<x-p>
    По умолчанию в MoonShine есть компонент для верхнего меню.
    Давайте взглянем как в <code>LayoutBuilder</code> заменить <code>Sidebar</code> на <code>TopBar</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Components\Layout\{TopBar, Content, Flash, Footer, Header, LayoutBlock, LayoutBuilder, Menu, Sidebar};
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ]), // [tl! focus:-2]
            LayoutBlock::make([
                Flash::make(),
                Header::make(),
                Content::make(),
                Footer::make()->copyright(fn (): string => <<<'HTML'
                        &copy; 2021-2023 Made with ❤️ by
                        <a href="https://cutcode.dev"
                            class="font-semibold text-primary hover:text-secondary"
                            target="_blank"
                        >
                            CutCode
                        </a>
                    HTML)
                    ->menu([
                        'https://github.com/moonshine-software/moonshine' => 'GitHub',
                    ]),
            ])->customAttributes(['class' => 'layout-page']),
        ])
    }
}
</x-code>

</x-page>
