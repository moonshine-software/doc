<?php

namespace App\Services\PackageInfo\Contracts;

interface PackageInfoServiceManagerContract
{
    public function make(string $url): PackageInfoContract;
}
