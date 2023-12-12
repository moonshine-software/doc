<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Decorations\Fragment;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;

class DocSection extends Page
{
    public function breadcrumbs(): array
    {
        if ($this->hasResource() && $this->getResource()->getPages()->count() > 1) {
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
            Fragment::make([
                TextBlock::make('', $this->getPageContent($this->getAlias())),
            ])->withName('doc-content')
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

    public function title(): string
    {
        return __($this->title);
    }
}
