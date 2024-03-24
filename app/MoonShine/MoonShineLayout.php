<?php

declare(strict_types=1);

namespace App\MoonShine;

use App\View\Components\ChangeVersion;
use App\View\Components\DocSearch;
use MoonShine\Components\Layout\{Content, Flash, Footer, Header, LayoutBlock, LayoutBuilder, Menu, MobileBar, Sidebar};
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Contracts\MoonShineLayoutContract;
use MoonShine\Decorations\Divider;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            MobileBar::make([
                Menu::make(),
                Divider::make(),
                ActionButton::make(__('Screencasts'), 'https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy')
                    ->primary()
                    ->icon('heroicons.outline.play')
                    ->blank()
                    ->customAttributes(['class' => 'rounded-full']),
                ActionButton::make(__('Online consultation'), 'https://forms.gle/U41uLZzXBCibmwbE7')
                    ->secondary()
                    ->icon('heroicons.outline.rocket-launch')
                    ->blank()
                    ->customAttributes(['class' => 'rounded-full mt-2']),
            ]),
            Sidebar::make([
                Menu::make(),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    ActionButton::make(__('Screencasts'), 'https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy')
                        ->primary()
                        ->icon('heroicons.outline.play')
                        ->blank()
                        ->customAttributes(['class' => 'rounded-full hidden lg:flex']),
                    ActionButton::make(__('Online consultation'), 'https://forms.gle/U41uLZzXBCibmwbE7')
                        ->secondary()
                        ->icon('heroicons.outline.rocket-launch')
                        ->blank()
                        ->customAttributes(['class' => 'rounded-full hidden lg:flex']),
                    new DocSearch(),
                    new ChangeVersion(),
                ]),
                Content::make(),
                Footer::make()
                    ->copyright(fn(): string => sprintf(
                        <<<'HTML'
                            &copy; 2021-%d Made with ❤️ by
                            <a href="https://cutcode.dev"
                                class="font-semibold text-primary hover:text-secondary"
                                target="_blank"
                            >
                                CutCode
                            </a>
                        HTML,
                        now()->year
                    ))
                    ->menu([
                        'https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy' => 'Screencasts',
                        'https://cutcode.dev/articles/moonshine-tips-tricks' => 'Tips & Tricks',
                        'https://github.com/moonshine-software/moonshine/blob/1.x/LICENSE.md' => 'License',
                        'https://demo.moonshine-laravel.com' => 'Demo',
                        'https://github.com/moonshine-software/moonshine' => 'GitHub',
                        'https://t.me/laravel_chat/24568' => 'Telegram chat',
                    ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
