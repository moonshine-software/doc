<?php

namespace App\Support\PackageInfo;

use App\Support\PackageInfo\Contracts\PackageInfoContract;
use App\Support\PackageInfo\Contracts\RepositoryContract;
use App\Support\PackageInfo\DTOs\PackageInfoDTO;
use App\Support\PackageInfo\Exception\RepositoryNotAvailableException;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;
use Illuminate\Support\Facades\Cache;

class PackageInfo implements PackageInfoContract
{
    const CACHE_TTL = 100;

    private array $availableRepository = [
        'github.com' => RepositoryGithub::class,
        'packagist.org' => RepositoryPackagist::class,
    ];

    public function get(string $url): PackageInfoDTO
    {
        return Cache::remember($url, self::CACHE_TTL, fn() => $this->getData($url));
    }

    /**
     * @throws RepositoryNotAvailableException
     * @throws RepositoryNotFoundException
     */
    private function getData(string $url): PackageInfoDTO
    {
        $repository = $this->getRepository($url);
        return $repository->getInfo();

    }

    /**
     * @throws RepositoryNotAvailableException
     */
    private function getRepository(string $url): RepositoryContract
    {
        $repositoryName = str_replace('www.', '', parse_url($url)['host'] ?? '');

        if (!array_key_exists($repositoryName, $this->availableRepository)) {
            throw new RepositoryNotAvailableException("Repository $repositoryName is not supported");
        }

        $repositoryClass = $this->availableRepository[$repositoryName];

        return (new $repositoryClass($url));
    }
}
