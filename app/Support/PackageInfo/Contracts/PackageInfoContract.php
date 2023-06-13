<?php

namespace App\Support\PackageInfo\Contracts;

use App\Support\PackageInfo\DTOs\PackageInfoDTO;
use App\Support\PackageInfo\Exception\RepositoryNotAvailableException;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;

interface PackageInfoContract
{
    /**
     * @throws RepositoryNotAvailableException
     * @throws RepositoryNotFoundException
     */
    public function get(string $url): PackageInfoDTO;
}
