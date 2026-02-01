# Контроллеры

- [Генерация контроллера](#generate-controller)
- [Отображение blade-представления](#show-blade-view)
- [Отображение страницы](#display-page)
- [Показать уведомление](#show-notification)
- [Отправить уведомление](#send-notification)
- [Доступ к странице или ресурсу](#access-a-page-or-resource)
- [JSON-ответ](#json-response)

---

**MoonShine** позволяет работать привычным образом, используя контроллеры.

Мы предоставляем вам наш базовый контроллер, который помогает удобно работать с UI и отображать ваши представления с макетом **MoonShine**.

Это полезно для отображения ваших сложных решений или написания дополнительных обработчиков.

> [!NOTE]
> Наследовать `MoonshineController` не является обязательным, мы всего лишь предоставляем удобные готовые методы.

<a name="generate-controller"></a>
## Генерация контроллера

```shell
php artisan moonshine:controller
```

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#controller).

<a name="show-blade-view"></a>
## Отображение blade-представления

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
## Отображение страницы

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
## Показать уведомление

Метод `toast()` вызывает стандартное [всплывающее уведомление](/docs/{{version}}/advanced/toasts) админ-панели.

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
## Отправить уведомление

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
## Доступ к странице или ресурсу

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
## JSON-ответ

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

`BelongsToManyPivotController` — это новый контроллер, который обрабатывает операции для режима модального окна в полях `BelongsToMany`. Он предоставляет конечные точки для управления записями в таблице связей через интерфейс модального окна.

### Конечные точки

- **Компонент формы**: Отображает форму для создания или редактирования записи.
- **Сохранение**: Обрабатывает создание новой записи.
- **Обновление**: Обрабатывает обновления существующей записи.
- **Удаление**: Удаляет запись.
- **Компонент списка**: Отображает список записей.

Эти конечные точки регистрируются автоматически и не требуют ручной настройки.
