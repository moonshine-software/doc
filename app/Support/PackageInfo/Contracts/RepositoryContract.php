<?php

namespace App\Support\PackageInfo\Contracts;

use App\Support\PackageInfo\DTOs\PackageInfoDTO;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;

interface RepositoryContract
{
    /**
     * @throws RepositoryNotFoundException
     */
    public function getInfo(): PackageInfoDTO;
}
