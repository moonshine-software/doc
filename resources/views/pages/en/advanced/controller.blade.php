<x-page title="Controllers" :sectionMenu="null">
<x-p>
    MoonShine allows you to work in a familiar manner using controllers
</x-p>

<x-p>
    We provide you with our basic controller, which helps you conveniently work with the UI and
     render your views with MoonShine layout
</x-p>

<x-p>
    Useful for displaying your complex solutions or writing additional handlers
</x-p>

<x-sub-title>Generate controller</x-sub-title>

<x-code>
php artisan moonshine:controller
</x-code>

<x-sub-title>Show blade view</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        return $this
            ->view('path_to_blade', ['param' => 'value'])
            //->setLayout('custom_layout')
            ->render();
    }
}
</x-code>

<x-sub-title>Display page</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use MoonShine\Pages\Page;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Page
    {
        return MyPage::make();
    }
}
</x-code>

<x-sub-title>Show notification</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        $this->toast('Hello world');

        return back();
    }
}
</x-code>

<x-sub-title>Send notification</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        $this->notification('Message');

        return back();
    }
}
</x-code>

<x-sub-title>Access a page or resource</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        // $request->getPage();
        // $request->getResource();
    }
}
</x-code>

<x-sub-title>Json response</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        return $this->json(message: 'Message', data: [], redirect: null);
    }
}
</x-code>
</x-page>
