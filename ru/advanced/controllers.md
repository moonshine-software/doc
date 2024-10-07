# Контроллеры

  - [Генерация контроллера](#generate-controller)
  - [Отображение blade-представления](#show-blade-view)
  - [Отображение страницы](#display-page)
  - [Показать уведомление](#show-notification)
  - [Отправить уведомление](#send-notification)
  - [Доступ к странице или ресурсу](#access-a-page-or-resource)
  - [JSON-ответ](#json-response)

---

MoonShine позволяет работать привычным образом, используя контроллеры

Мы предоставляем вам наш базовый контроллер, который помогает удобно работать с UI и отображать ваши представления с макетом MoonShine

Это полезно для отображения ваших сложных решений или написания дополнительных обработчиков

<a name="generate-controller"></a>
## Генерация контроллера

```php
php artisan moonshine:controller
```

<a name="show-blade-view"></a>
## Отображение blade-представления

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
## Отображение страницы

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
## Показать уведомление

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
## Отправить уведомление

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
## Доступ к странице или ресурсу

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
## JSON-ответ

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
