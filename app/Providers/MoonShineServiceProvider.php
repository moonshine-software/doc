<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Leeto\MoonShine\MoonShine;
use Leeto\MoonShine\Menu\MenuGroup;
use Leeto\MoonShine\Menu\MenuItem;
use Leeto\MoonShine\Resources\CustomPage;
use Leeto\MoonShine\Resources\MoonShineUserResource;
use Leeto\MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $moonShineMenu = [];

        foreach (config('menu', []) as $group => $items) {
            $title = str($group);
            $moonShineItems = [];

            foreach ($items as $item) {
                $moonShineItems[] = MenuItem::make(
                    $item['label'],
                    CustomPage::make(
                        $item['label'],
                        $item['slug'],
                        fn() => $this->getPageView($item['slug'])
                    ),
                    'heroicons.hashtag'
                )->badge(fn() => $item['badge'] ?? null);
            }

            $moonShineMenu[] = MenuGroup::make(
                $title->before(':')->value(),
                $moonShineItems,
                $title->contains(':') ? $title->after(':')
                    ->prepend('heroicons.')
                    ->value() : 'heroicons.squares-2x2'
            );
        }

        app(MoonShine::class)->registerResources($moonShineMenu);
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
