<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return __('Welcome');
    }

    public function components(): array
	{
        return [
            TextBlock::make('', $this->getPageContent()),
        ];
	}

    private function getPageContent(): string
    {
        $view = "pages.".session('change-moonshine-locale', app()->getLocale()).".home";

        if (!view()->exists($view)) {
            $view = 'translation-in-progress';
        }

        return view($view)->render();
    }
}
