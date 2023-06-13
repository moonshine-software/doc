<?php

namespace App\Support\PackageInfo;

use App\Support\PackageInfo\Contracts\RepositoryContract;

abstract class Repository implements RepositoryContract
{
    public function __construct(
        protected string $url
    )
    {
    }

    protected function getPackageName(): string
    {
        $pieces = explode('/', trim(parse_url($this->url)['path'] ?? '', '/'));

        return implode('/', array_slice($pieces, -2));
    }
}
