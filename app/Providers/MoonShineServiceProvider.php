<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuDivider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use MoonShine\Resources\CustomPage;
use MoonShine\Utilities\AssetManager;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $moonShineMenu = [];

        foreach (config('menu', []) as $group => $items) {
            $title = str($group);
            $moonShineItems = [];

            if (is_string($items) && str($items)->contains('_divider_')) {
                $moonShineMenu[] = MenuDivider::make(str($items)->before(':')->value());

                continue;
            }

            foreach ($items as $item) {
                if (is_string($item) && str($item)->contains('_divider_')) {
                    $moonShineItems[] = MenuDivider::make(str($item)->before(':')->value());

                   continue;
                }

                $menuItem = MenuItem::make(
                    $item['label'],
                    CustomPage::make(
                        $item['label'],
                        $item['slug'],
                        fn() => $this->getPageView($item['slug'])
                    )->translatable(),
                    'heroicons.hashtag'
                )->translatable();

                if ($item['badge'] ?? false) {
                    $menuItem->badge(fn() => $item['badge']);
                }

                $moonShineItems[] = $menuItem;
            }

            $icon = $title->contains(':') ? $title->after(':')
                ->prepend('heroicons.')
                ->value() : 'heroicons.squares-2x2';

            if (count($moonShineItems) === 1) {
                $moonShineMenu[] = $moonShineItems[0]->icon($icon);
            } else {
                $moonShineMenu[] = MenuGroup::make(
                    $title->before(':')->value(),
                    $moonShineItems,
                    $icon,
                    link: isset($items[0]['slug']) ? '/section/'.$items[0]['slug'] : '#'
                )->translatable();
            }
        }

        app(MoonShine::class)->menu($moonShineMenu);

        app(AssetManager::class)->add([
            '/assets/css/style.css',
            '/assets/js/app.js',
        ]);
    }

    private function getPageView(string $slug): string
    {
        $view = "pages.".session('change-moonshine-locale', app()->getLocale()).".".str_replace('-', '.', $slug);

        if (!view()->exists($view)) {
            $view = 'translation-in-progress';
        }

        return $view;
    }
}
