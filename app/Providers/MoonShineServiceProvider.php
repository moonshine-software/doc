<?php

namespace App\Providers;

use App\MoonShine\Pages\DocSection;
use App\MoonShine\Resources\DocResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        moonshineAssets()->add([
            '/assets/css/style.css',
            '/assets/js/app.js',
        ]);
    }

    protected function menu(): array
    {
        $menu = [];
        $resources = [];

        foreach (config('menu', []) as $title => $items) {
            if (!is_string($items)) {
                [$title] = explode(':', $title);

                $pages = [];

                foreach ($items as $item) {
                    if (!is_string($item)) {
                        $pages[] = DocSection::make(
                            $item['title'] ?? $item['label'],
                            $item['slug'],
                        );
                    }
                }

                $slug = str($title)->slug()->value();
                $resources[$slug] = DocResource::make($pages, $title, $slug);
            }
        }

        foreach (config('menu', []) as $title => $items) {
            if (is_string($items)) {
                [$titleDivider] = explode(':', $items);
                $menu[] = MenuDivider::make($titleDivider);
            } else {
                [$title, $icon] = explode(':', $title);
                $slug = str($title)->slug()->value();

                $inner = [];

                foreach ($items as $item) {
                    if (is_string($item)) {
                        [$titleDivider] = explode(':', $item);

                        $inner[] = MenuDivider::make($titleDivider);
                    } else {
                        $page = DocSection::make(
                            $item['title'] ?? $item['label'],
                            $item['slug'],
                        )->setResource($resources[$slug]);

                        $inner[] = MenuItem::make($item['label'], $page)
                            ->badge(fn () => $item['badge'] ?? null)->translatable();
                    }
                }

                if (count($inner) === 1) {
                    $menu[] = array_shift($inner)
                        ->icon("heroicons.outline.$icon");
                } else {
                    $menu[] = MenuGroup::make($title, $inner)
                        ->icon("heroicons.outline.$icon")->translatable();
                }
            }
        }

        return $menu;
    }
}
