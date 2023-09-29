<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Resources\Resource;
use MoonShine\Traits\Makeable;

class DocResource extends Resource
{
    use Makeable;

    public function __construct(protected array $pages, string $title, string $alias)
    {
        $this->title = $title;
        $this->alias = $alias;
    }

    protected function pages(): array
    {
        return $this->pages;
    }
}
