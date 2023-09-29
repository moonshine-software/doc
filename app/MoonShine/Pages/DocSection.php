<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Decorations\Heading;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;

class DocSection extends Page
{
    public function breadcrumbs(): array
    {
        if ($this->hasResource()) {
            return [
                $this->getResource()->url() => $this->getResource()->title(),
                '#' => $this->title(),
            ];
        }

        return [
            '#' => $this->title(),
        ];
    }

    public function components(): array
    {
        return [
            TextBlock::make('', $this->getPageContent($this->getAlias())),
        ];
    }

    private function getPageContent(string $slug): string
    {
        $view = "pages.".session('change-moonshine-locale', app()->getLocale()).".".str_replace('-', '.', $slug);

        if (!view()->exists($view)) {
            $view = 'translation-in-progress';
        }

        return view($view)->render();
    }
}
