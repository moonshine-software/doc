<?php

namespace App\Http\Controllers;

use App\Services\PackageInfo\Contracts\PackageInfoServiceManagerContract;
use Exception;

class PackageInfoController extends Controller
{
    public function __invoke()
    {
        $serviceManager = app(PackageInfoServiceManagerContract::class);

        try {
            $service = $serviceManager->make(request('url', ''));
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }

//        dump($service->getPackageInfo());

        return view('package-info', [
            'packageInfo' => $service->getPackageInfo()
        ]);
    }
}
