<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Resources\Resource;
use MoonShine\Traits\Makeable;

class DocResource extends Resource
{
    use Makeable;

    public function __construct(protected array $docPages, string $title, string $alias)
    {
        $this->title = $title;
        $this->alias = $alias;
    }

    protected function pages(): array
    {
        return $this->docPages;
    }

    public function title(): string
    {
        return __($this->title);
    }
}
