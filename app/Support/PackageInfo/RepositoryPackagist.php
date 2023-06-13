<?php

namespace App\Support\PackageInfo;

use App\Support\PackageInfo\Contracts\PackageInfoContract;
use App\Support\PackageInfo\DTOs\PackageInfoDTO;
use App\Support\PackageInfo\Exception\RepositoryNotAvailableException;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RepositoryPackagist extends Repository
{
    const URL_API = 'https://packagist.org/packages/%s.json';

    /**
     * @throws RepositoryNotFoundException
     */
    public function getInfo(): PackageInfoDTO
    {
        $data = $this->getData();
        $release = $this->getMainBranch($data);
        $repoInfo = $this->getRepoInfo($data['repository']);

        return PackageInfoDTO::fromArray([
            'name' => $release['name'] ?? null,
            'description' => $release['description'] ?? null,
            'distUrl' => $release['dist']['url'] ?? null,
            'repoUrl' => $data['repository'] ?? null,
            'package' => $release['name'] ?? null,
            'readme' => $repoInfo->getReadme() ?? null
        ]);
    }

    /**
     * @throws RepositoryNotFoundException
     */
    private function getData(): array
    {
        $repositoryName = $this->getPackageName();

        try {
            $response = Http::get(sprintf(self::URL_API, $repositoryName));
        } catch (Exception $e) {
            return throw new RepositoryNotFoundException($e->getMessage());
        }

        if ($response->successful()) {
            return $response->json('package');
        } else {
            return throw new RepositoryNotFoundException("Repository $repositoryName is not found");
        }

    }

    private function getMainBranch(array $data): array
    {
        return Arr::first(
            $data['versions'],
            function ($value, $key) {
                return !Str::startsWith($key, 'dev-');
            },
            []
        );
    }

    private function getRepoInfo(string $url): PackageInfoDTO
    {
        $packageInfo = app(PackageInfoContract::class);

        try {
            return $packageInfo->get($url);
        } catch (RepositoryNotAvailableException|RepositoryNotFoundException $e) {
            return PackageInfoDTO::fromArray([
                'repoUrl' => $url
            ]);
        }
    }
}
