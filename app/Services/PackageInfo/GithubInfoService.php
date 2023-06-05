<?php

namespace App\Services\PackageInfo;

use App\Services\PackageInfo\DTOs\PackageInfo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GithubInfoService extends PackageInfoService
{
    const URL_API = 'https://api.github.com/repos/%s';
    const URL_README = 'https://api.github.com/repos/%s/contents/README.md';

    public function getPackageInfo(): PackageInfo
    {
        return PackageInfo::fromArray([
            'repoUrl' => $this->url,
            'distUrl' => $this->data['downloads_url'] ?? null,
            'readme' => $this->getReadme()
        ]);
    }

    protected function getInfo(): array
    {
        $response = Http::get(sprintf(self::URL_API, $this->getPackageName()));

        if ($response->failed()) {
            return [];
        }

        return $response->json();
    }

    public function getReadme(): ?string
    {
        $response = Http::get(sprintf(self::URL_README, $this->getPackageName()));

        if ($response->failed()) {
            return null;
        }

        $content = Str::markdown(
            base64_decode($response->json('content'))
        );

        $content = preg_replace('/("https:\/\/github.com\/.+?\.(?:jpe?g|png|gif))/', '${1}?raw=true', $content);
        $content = preg_replace_callback(
            '/<pre><code(\s*class="language-(.*?)"|(.*?))>(.*?)<\/code><\/pre>/ius',
            function ($matches) {
                $language =  $matches[2] ?? 'php';

                return view('components.code', [
                    'language' => $language,
                    'slot' => $matches[4]]
                )->render();
            },
            $content
        );

        return $content;
    }
}
