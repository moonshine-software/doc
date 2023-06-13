<?php

namespace App\Http\Controllers;

use App\Actions\ReadmeConversion;
use App\Support\PackageInfo\Contracts\PackageInfoContract;
use App\Support\PackageInfo\Exception\RepositoryNotAvailableException;
use App\Support\PackageInfo\Exception\RepositoryNotFoundException;
use Illuminate\Support\Arr;

class PackageInfoController extends Controller
{
    public function __invoke(PackageInfoContract $packageInfo, ReadmeConversion $convert, string $slug)
    {
        $packages = Arr::pluck(config('packages'), 'url', 'slug');

        try {
            if (!isset($packages[$slug])) {
                throw new RepositoryNotFoundException("Repository is not found");
            }

            $info = $packageInfo->get($packages[$slug]);
        } catch (RepositoryNotAvailableException|RepositoryNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return view('package-info', [
            'packageInfo' => $info,
            'readme' => $convert->handle($info->getReadme())
        ]);
    }
}
