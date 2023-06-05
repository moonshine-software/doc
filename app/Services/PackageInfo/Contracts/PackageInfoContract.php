<?php

namespace App\Services\PackageInfo\Contracts;

use App\Services\PackageInfo\DTOs\PackageInfo;

interface PackageInfoContract
{
    public function getPackageInfo(): PackageInfo;
}
