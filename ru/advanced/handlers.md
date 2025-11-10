# Handlers

- [Основы](#basics)
- [Создание Handler](#create)
- [Регистрация](#registration)
- [Взаимодействие](#interaction)

---

<a name="basics"></a>
## Основы

`Handlers` в **MoonShine** - это переиспользуемые обработчики, которые позволяют легко добавлять пользовательские действия в ресурсы.

Основные преимущества:
- Не требуют создания контроллеров,
- Автоматическая обработка ошибок внутри **MoonShine**,
- Множество готовых методов для взаимодействия с системой,
- Простая интеграция с UI через автоматическую генерацию кнопок,
- После подключения автоматически отображаются в интерфейсе.

<a name="create"></a>
## Создание Handler

Для создания нового `Handler` используйте команду:

```shell
php artisan moonshine:handler MyCustomHandler
```

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#handler).

После выполнения команды будет создан класс `Handler` в директории `app\MoonShine\Handlers` со следующей структурой:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:8]
namespace App\MoonShine\Handlers;

use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\Crud\Handlers\Handler;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Exceptions\ActionButtonException;
use Symfony\Component\HttpFoundation\Response;

class MyCustomHandler extends Handler
{
    /**
     * @throws ActionButtonException
     */
    public function handle(): Response
    {
        if (! $this->hasResource()) {
            throw new ActionButtonException('Resource is required for action');
        }

        if ($this->isQueue()) {
            // Job here

            toast(
                __('moonshine::ui.resource.queued')
            );

            return back();
        }

        self::process();

        return back();
    }

    public static function process()
    {
        // Logic here
    }

    public function getButton(): ActionButtonContract
    {
        return ActionButton::make($this->getLabel(), $this->getUrl());
    }
}
```

<a name="registration"></a>
## Регистрация

Для регистрации `Handler` в `IndexPage` необходимо переопределить метод `handlers()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources\Post\Pages;

use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    protected function handlers(): ListOf
    {
        return parent::handlers()->add(new MyCustomHandler());
    }
}
```

После регистрации на индексной странице справа автоматически появится кнопка для запуска `Handler`.

<a name="interaction"></a>
## Взаимодействие

`Handler` тесно интегрирован с ресурсом и имеет доступ к:

- Текущему ресурсу через `$this->getResource()`,
- Возможностям запуска через очереди,
- Системе уведомлений и настройку пользователей, которые получат уведомления через `notifyUsers()`,
- Модификация кнопки через `modifyButton()`.
