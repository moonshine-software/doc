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
                ActionButton::make(
                    __('Screencasts'),
                    config(app()->getLocale() === 'ru' ? 'links_ru.screencasts' : 'links_en.screencasts')
                )
                    ->primary()
                    ->icon('heroicons.outline.play')
                    ->blank()
                    ->customAttributes(['class' => 'rounded-full']),
                ActionButton::make(__('Online consultation'), 'https://forms.gle/U41uLZzXBCibmwbE7')
                    ->secondary()
                    ->icon('heroicons.outline.rocket-launch')
                    ->blank()
                    ->customAttributes(['class' => 'rounded-full mt-2'])
                    ->canSee(fn() => app()->getLocale() === 'ru'),
            ]),
            Sidebar::make([
                Menu::make(),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    ActionButton::make(
                        __('Screencasts'),
                        config(app()->getLocale() === 'ru' ? 'links_ru.screencasts' : 'links_en.screencasts')
                    )
                        ->primary()
                        ->icon('heroicons.outline.play')
                        ->blank()
                        ->customAttributes(['class' => 'rounded-full hidden lg:flex']),
                    ActionButton::make(__('Online consultation'), 'https://forms.gle/U41uLZzXBCibmwbE7')
                        ->secondary()
                        ->icon('heroicons.outline.rocket-launch')
                        ->blank()
                        ->customAttributes(['class' => 'rounded-full hidden lg:flex'])
                        ->canSee(fn() => app()->getLocale() === 'ru'),
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
                    ->when(
                        app()->getLocale() === 'ru',
                        function (Footer $footer) {
                            return $footer->menu([
                                config('links_ru.screencasts') => __('Screencasts'),
                                'https://cutcode.dev/articles/moonshine-tips-tricks' => __('Tips & Tricks'),
                                'https://github.com/moonshine-software/moonshine/blob/1.x/LICENSE.md' => __('License'),
                                'https://demo.moonshine-laravel.com' => __('Demo'),
                                config('links.github') => 'GitHub',
                                config('links_ru.chat') => __('Telegram chat')
                            ]);
                        }
                    )
                    ->when(
                        app()->getLocale() === 'en',
                        function (Footer $footer) {
                            return $footer->menu([
                                config('links_en.screencasts') => __('Screencasts'),
                                'https://github.com/moonshine-software/moonshine/blob/1.x/LICENSE.md' => __('License'),
                                'https://demo.moonshine-laravel.com' => __('Demo'),
                                config('links.github') => 'GitHub',
                                config('links_en.discord') => __('Discord chat'),
                                config('links_en.chat') => __('Telegram chat')
                            ]);
                        }
                    ),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
