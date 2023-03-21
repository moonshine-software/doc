<?php

namespace App\MoonShine;

use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Dashboard\DashboardScreen;
use Leeto\MoonShine\Dashboard\TextBlock;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
		return [
            DashboardBlock::make([
                TextBlock::make(
                    'Добро пожаловать',
                    view($this->getPageView('home'))->render()
                )
            ])
        ];
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
