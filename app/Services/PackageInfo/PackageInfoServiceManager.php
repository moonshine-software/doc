<?php

namespace App\Services\PackageInfo;

use App\Services\PackageInfo\Contracts\PackageInfoContract;
use App\Services\PackageInfo\Contracts\PackageInfoServiceManagerContract;
use App\Services\PackageInfo\Exception\InfoServiceNotAvailableException;

class PackageInfoServiceManager implements PackageInfoServiceManagerContract
{
    protected static array $availableInfoService = [
        'github.com' => GithubInfoService::class,
        'packagist.org' => PackagistInfoService::class,
    ];

    /**
     * @throws InfoServiceNotAvailableException
     */
    public function make(string $url): PackageInfoContract
    {
        $serviceName = self::getServiceNameFromUrl($url);

        if (!array_key_exists($serviceName, self::$availableInfoService)) {
            throw new InfoServiceNotAvailableException("Service $serviceName is not supported");
        }

        $serviceClass = self::$availableInfoService[$serviceName];

        return (new $serviceClass($url));
    }

    private static function getServiceNameFromUrl($url): string
    {
        return str_replace('www.', '', parse_url($url)['host'] ?? '');
    }
}
