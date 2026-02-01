# Controllers

- [Generate Controller](#generate-controller)
- [Show Blade View](#show-blade-view)
- [Display Page](#display-page)
- [Show Notification](#show-notification)
- [Send Notification](#send-notification)
- [Access a Page or Resource](#access-a-page-or-resource)
- [JSON Response](#json-response)

---

**MoonShine** allows you to work in a familiar way using controllers.

We provide you with our base controller, which helps to conveniently interact with the UI and display your views with the **MoonShine** layout.

This is useful for showcasing your complex solutions or writing additional handlers.

> [!NOTE]
> Inheriting from `MoonshineController` is not mandatory; we merely provide convenient ready-made methods.

<a name="generate-controller"></a>
## Generate Controller

```shell
php artisan moonshine:controller
```

> [!NOTE]
> You can learn about all supported options in the section [Commands](/docs/{{version}}/advanced/commands#controller).

<a name="show-blade-view"></a>
## Show Blade View

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Controllers;

use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class CustomViewController extends MoonShineController
{
    public function __invoke(): PageContract
    {
        return $this->view(
            'path_to_blade',
            ['param' => 'value']
        );
    }
}
```

<a name="display-page"></a>
## Display Page

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Controllers;

use App\MoonShine\Pages\MyPage;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class CustomViewController extends MoonShineController
{
    public function __invoke(MyPage $page): MyPage
    {
        return $page;
    }
}
```

<a name="show-notification"></a>
## Show Notification

The `toast()` method triggers a standard [toast notification](/docs/{{version}}/advanced/toasts) of the admin panel.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Controllers;

use MoonShine\Laravel\Http\Controllers\MoonShineController;
use MoonShine\Support\Enums\ToastType;
use Symfony\Component\HttpFoundation\Response; // [tl! collapse:end]

final class CustomViewController extends MoonShineController
{
    public function __invoke(): Response
    {
        $this->toast('Hello world', ToastType::SUCCESS);

        return back();
    }
}
```

<a name="send-notification"></a>
## Send Notification

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Controllers;

use MoonShine\Laravel\Http\Controllers\MoonShineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonShineController
{
    public function __invoke(): Response
    {
        $this->notification('Message');

        return back();
    }
}
```

<a name="access-a-page-or-resource"></a>
## Access a Page or Resource

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Controllers;

use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Laravel\Http\Controllers\MoonShineController;
use Symfony\Component\HttpFoundation\Response; // [tl! collapse:end]

final class CustomViewController extends MoonShineController
{
    public function __invoke(CrudRequestContract $request)
    {
        // $request->getPage();
        // $request->getResource();
    }
}
```

<a name="json-response"></a>
## JSON Response

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Controllers;

use MoonShine\Laravel\Http\Controllers\MoonShineController;
use Symfony\Component\HttpFoundation\Response; // [tl! collapse:end]

final class CustomViewController extends MoonShineController
{
    public function __invoke(): Response
    {
        return $this->json(message: 'Message', data: []);
    }
}
```

<a name="belongs-to-many-pivot-controller"></a>
## BelongsToManyPivotController

The `BelongsToManyPivotController` is a new controller that handles the operations for the pivot modal mode in `BelongsToMany` fields. It provides endpoints for managing pivot records through a modal interface.

### Endpoints

- **Form Component**: Renders the form for creating or editing a pivot record.
- **Store**: Handles the creation of a new pivot record.
- **Update**: Handles updates to an existing pivot record.
- **Destroy**: Deletes a pivot record.
- **List Component**: Renders the list of pivot records.

These endpoints are automatically registered and do not require manual setup.
