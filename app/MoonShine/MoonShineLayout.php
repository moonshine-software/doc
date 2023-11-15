<?php

declare(strict_types=1);

namespace App\MoonShine;

use App\View\Components\ChangeVersion;
use App\View\Components\DocSearch;
use MoonShine\Components\Layout\{Content, Flash, Footer, Header, LayoutBlock, LayoutBuilder, Menu, Sidebar};
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    new ChangeVersion(),
                    new DocSearch()
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
                    HTML)
                    ->menu([
                        'https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy' => 'Screencasts',
                        'https://cutcode.dev/articles/moonshine-tips-tricks' => 'Tips & Tricks',
                        'https://github.com/moonshine-software/moonshine/blob/1.x/LICENSE.md' => 'License',
                        'https://github.com/moonshine-software/demo-project' => 'Demo project',
                        'https://github.com/moonshine-software/moonshine' => 'GitHub',
                        'https://t.me/laravel_chat/24568' => 'Telegram chat',
                    ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
