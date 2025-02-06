# Controllers  

  - [Generate controller](#generate-controller)  
  - [Show blade view](#show-blade-view)  
  - [Display page](#display-page)  
  - [Show notification](#show-notification)  
  - [Send notification](#send-notification)  
  - [Access a page or resource](#access-a-page-or-resource)  
  - [Json response](#json-response)  

MoonShine allows you to work in a familiar manner using controllers  

We provide you with our basic controller, which helps you conveniently work with the UI and render your views with MoonShine layout  

Useful for displaying your complex solutions or writing additional handlers  

<a name="generate-controller"></a>  
## Generate controller  

```shell
php artisan moonshine:controller
```

<a name="show-blade-view"></a>  
## Show blade view  

```php
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Illuminate\Contracts\View\View;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): View
    {
        return $this
            ->view('path_to_blade', ['param' => 'value'])
            //->setLayout('custom_layout')
            ->render();
    }
}
```

<a name="display-page"></a>  
## Display page  

```php
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
```

<a name="show-notification"></a>  
## Show notification  

```php
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
```

<a name="send-notification"></a>  
## Send notification  

```php
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
```

<a name="access-a-page-or-resource"></a>  
## Access a page or resource  

```php
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request)
    {
        // $request->getPage();
        // $request->getResource();
    }
}
```

<a name="json-response"></a>  
## Json response  

```php
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
```
