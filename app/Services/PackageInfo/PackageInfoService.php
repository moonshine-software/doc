<?php

namespace App\Services\PackageInfo;

use App\Services\PackageInfo\Contracts\PackageInfoContract;
use Illuminate\Support\Facades\Cache;

abstract class PackageInfoService implements PackageInfoContract
{
    const CACHE_TTL = 0;

    protected string $url;
    protected array $data;

    abstract protected function getInfo(): array;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->setData();
    }

    private function setData(): void
    {
        $this->data = Cache::remember($this->url, self::CACHE_TTL, function () {
            return $this->getInfo();
        });
    }

    protected function getPackageName(): string
    {
        $pieces = explode('/', trim(parse_url($this->url)['path'] ?? '', '/'));

        return implode('/', array_slice($pieces, -2));
    }
}
