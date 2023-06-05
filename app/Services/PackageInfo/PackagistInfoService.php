<?php

namespace App\Services\PackageInfo;

use App\Services\PackageInfo\Contracts\PackageInfoServiceManagerContract;
use App\Services\PackageInfo\DTOs\PackageInfo;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PackagistInfoService extends PackageInfoService
{
    const URL_API = 'https://packagist.org/packages/%s.json';

    public function getPackageInfo(): PackageInfo
    {
        $repositoryInfo = $this->getRepositoryInfo($this->data['repository']);

        $release = $this->getMainBranch();

        return PackageInfo::fromArray([
            'name' => $release['name'] ?? null,
            'description' => $release['description'] ?? null,
            'distUrl' => $release['dist']['url'] ?? null,
            'repoUrl' => $this->data['repository'] ?? null,
            'package' => $release['name'] ?? null,
            'readme' => $repositoryInfo->getReadme() ?? null
        ]);
    }

    protected function getInfo(): array
    {
        $response = Http::get(sprintf(self::URL_API, $this->getPackageName()));

        if ($response->failed()) {
            return [];
        }

        return $response->json('package');
    }

    private function getMainBranch(): array
    {
        return Arr::first(
            $this->data['versions'],
            function ($value, $key) {
                return !Str::startsWith($key, 'dev-');
            },
            []
        );
    }

    private function getRepositoryInfo($url): ?PackageInfo
    {
        $serviceManager = app(PackageInfoServiceManagerContract::class);

        try {
            $service = $serviceManager->make($url);
        } catch (Exception $e) {
            return null;
        }

        return $service->getPackageInfo();
    }
}
