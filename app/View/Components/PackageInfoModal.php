<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PackageInfoModal extends Component
{
    public function __construct(
        public string $route
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.package-info-modal');
    }
}
