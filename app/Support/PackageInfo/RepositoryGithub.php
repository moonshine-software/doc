<?php

namespace App\Support\PackageInfo;

use App\Support\PackageInfo\DTOs\PackageInfoDTO;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;
use Exception;
use Illuminate\Support\Facades\Http;

class RepositoryGithub extends Repository
{
    const URL_API = 'https://api.github.com/repos/%s';
    const URL_README = 'https://api.github.com/repos/%s/contents/README.md';

    public function getInfo(): PackageInfoDTO
    {
        return PackageInfoDTO::fromArray([
            'repoUrl' => $this->url,
            'distUrl' => $this->data['downloads_url'] ?? null,
            'readme' => $this->getReadme()
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
            return $response->json();
        } else {
            return throw new RepositoryNotFoundException("Repository $repositoryName is not found");
        }
    }

    public function getReadme(): ?string
    {
        try {
            $response = Http::get(sprintf(self::URL_README, $this->getPackageName()));
        } catch (Exception $e) {
            return null;
        }

        return $response->successful() ? base64_decode($response->json('content')) : null;
    }
}
