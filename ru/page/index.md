---
video: https://youtu.be/pC-wVnpypVI?si=kHFtuTn_cfLWAy4I
---

# Страницы

- [Основы](#basics)
- [Создание страницы](#create)
- [Заголовок](#title)
- [Компоненты](#components)
- [Меню](#menu)
- [Хлебные крошки](#breadcrumbs)
- [Шаблон](#layout)
    - [Модификация шаблона](#modify-layout)
- [Псевдоним](#alias)
- [Рендеринг](#render)
- [Перед рендерингом](#before-render)
- [Модификатор ответа](#modify-response)
- [Жизненный цикл](#lifecycle)
    - [Активная страница](#on-load)
    - [Создание экземпляра](#on-boot)
- [Создание ссылки на страницу в ресурсе](#link-from-resource)
- [Assets](#assets)

---

<a name="basics"></a>
## Основы

`Page` является основой админ-панели **MoonShine**. Основное назначение `Page` - отображение компонентов.

Страницы с одинаковой логикой могут быть объединены в `Resource`.

<a name="create"></a>
## Создание страницы

Для создания класса страницы можно использовать консольную команду:

```php
php artisan moonshine:page
```

После ввода имени класса будет создан файл, который является основой для страницы в админ-панели.
По умолчанию он располагается в директории `app/MoonShine/Pages`.

> [!NOTE]
> О всех поддерживаемых опциях можно узнать в разделе [Команды](/docs/{{version}}/advanced/commands#page).

> [!NOTE]
> Страницы при выполнении команды автоматически регистрируются в системе, но если вы создаете страницу вручную,
> то её необходимо самостоятельно [зарегистрировать](/docs/{{version}}/model-resource/index#declaring-in-the-system)
> в `MoonShineServiceProvider` в методе `$core->pages()`.

<a name="title"></a>
## Заголовок

Заголовок страницы можно задать через свойство `$title`, а подзаголовок — через `$subtitle`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    protected string $title = 'CustomPage';

    protected string $subtitle = 'Subtitle';

    // ...
}
```

Если для заголовка и подзаголовка требуется какая-то логика, то методы `title()` и `subtitle()` позволяют её реализовать.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function getTitle(): string
    {
        return $this->title ?: 'CustomPage';
    }

    public function getSubtitle(): string
    {
        return $this->subtitle ?: 'Subtitle';
    }
}
```

<a name="components"></a>
## Компоненты

Для регистрации компонентов страницы используется метод `components()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;

protected function components(): iterable
{
    return [
        Grid::make([
            Column::make([
                Box::make([
                    // ...
                ])
            ])->columnSpan(6),
            Column::make([
                Box::make([
                    // ...
                ])
            ])->columnSpan(6),
        ])
    ];
}
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Компоненты](/docs/{{version}}/components/index).

<a name="menu"></a>
## Меню

Метод `menu()` позволяет определить дополнительное меню для страницы, которое будет отображаться в компоненте `SecondBar`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\MenuManager\MenuItem;

protected function menu(): array
{
    return [
        MenuItem::make('Section 1', '/section1'),
        MenuItem::make('Section 2', '/section2'),
        MenuItem::make('Section 3', '/section3'),
    ];
}
```

Для отображения меню необходимо включить `SecondBar` в вашем лейауте, установив свойство `$secondBar = true`.

> [!TIP]
> Для более подробной информации о компоненте `SecondBar` обратитесь к разделу [SecondBar](/docs/{{version}}/components/second-bar).

<a name="breadcrumbs"></a>
## Хлебные крошки

За генерацию хлебных крошек отвечает метод `getBreadcrumbs()`.

```php
public function getBreadcrumbs(): array
{
    return [
        '#' => $this->getTitle()
    ];
}
```

<a name="layout"></a>
## Шаблон

По умолчанию страницы используют шаблон отображения `AppLayout`.
Подробнее про шаблоны читайте в разделе [Layout](/docs/{{version}}/appearance/layout).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    protected ?string $layout = AppLayout::class;

    // ...
}
```

Вы также можете указать шаблон через атрибут.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Core\Attributes\Layout;
use MoonShine\Laravel\Layouts\AppLayout;

#[Layout(AppLayout::class)]
class CustomPage extends Page
```

<a name="modify-layout"></a>
### Модификация шаблона

При разработке административной панели с использованием **MoonShine** часто возникает потребность в гибком управлении шаблонами.
Вместо создания множества отдельных шаблонов для различных ситуаций, **MoonShine** предоставляет возможность динамически модифицировать существующий шаблон.
Это достигается с помощью метода `modifyLayout()`.

Метод `modifyLayout()` позволяет получить доступ к шаблону после создания его экземпляра и внести в него необходимые изменения.
Это особенно полезно, когда вам нужно адаптировать шаблон под конкретные условия или добавить динамический контент.

#### Пример использования

Рассмотрим пример из пакета `moonshine-software/two-factor`, который демонстрирует, как можно использовать `modifyLayout()` для настройки шаблона аутентификации:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\LayoutContract;

/**
 * @param  LoginLayout  $layout
 */
protected function modifyLayout(LayoutContract $layout): LayoutContract
{
    return $layout->title(
        __('moonshine-two-factor::ui.2fa')
    )->description(
        __('moonshine-two-factor::ui.confirm')
    );
}
```

<a name="alias"></a>
## Псевдоним

Если необходимо изменить псевдоним страницы, это можно сделать через свойство `$alias`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    protected ?string $alias = null;

    // ...
}
```

Также можно переопределить метод `getAlias()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;

class CustomPage extends Page
{
    public function getAlias(): ?string
    {
        return 'custom_page';
    }

    // ...
}
```

<a name="render"></a>
## Рендеринг

Вы можете отображать страницу вне **MoonShine**, просто вернув её в контроллере.

```php
class ProfileController extends Controller
{
    // ...

    public function __invoke(ProfilePage $page): ProfilePage
    {
        return $page;
    }
}
```

Или с **Fortify**

```php
Fortify::loginView(static fn() => app(ProfilePage::class));
```

<a name="before-render"></a>
## Перед рендерингом

Метод `prepareBeforeRender()` позволяет выполнить какие-либо действия перед отображением страницы.

```php
protected function prepareBeforeRender(): void
{
    parent::prepareBeforeRender();

    if (auth()->user()->moonshine_user_role_id !== MoonshineUserRole::DEFAULT_ROLE_ID) {
        abort(403);
    }
}
```

<a name="modify-response"></a>
## Модификатор ответа

По умолчанию страница рендерится через `PageController`, вызывая метод `render()`.
Однако иногда возникает необходимость изменить стандартный ответ, например, выполнить редирект при определенных условиях.
В таких случаях можно использовать метод `modifyResponse()`.

Метод `modifyResponse()` позволяет модифицировать ответ страницы перед его отправкой.
Вот пример его использования:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use Symfony\Component\HttpFoundation\Response;

protected function modifyResponse(): ?Response
{
    if (request()->has('id')) {
        return redirect()->to('/admin/article-resource/index-page');
    }

    return null;
}
```

Использование `modifyResponse()` предоставляет гибкий способ управления ответом страницы,
позволяя реализовать сложную логику обработки запросов и ответов в административной панели.

<a name="lifecycle"></a>
## Жизненный цикл

`Page` имеет несколько различных методов подключения к различным частям своего жизненного цикла. Давайте пройдемся по ним:

<a name="on-load"></a>
### Активная страница

Метод `onLoad()` дает возможность интегрироваться в момент когда страница загружена и в данный момент является активной.

```php
protected function onLoad(): void
{
    parent::onLoad();

    // ...
}
```

<a name="on-boot"></a>
### Создание экземпляра

Метод `booted()` дает возможность интегрироваться в момент, когда **MoonShine** создает экземпляр страницы в системе.

```php
protected function booted(): void
{
    parent::booted();

    // ...
}
```

<a name="link-from-resource"></a>
## Создание ссылки на страницу в ресурсе

В данном примере для создания ссылки на новую страницу будем использовать компонент [ActionButton](/docs/{{version}}/components/action-button)
и метод ресурса [getPageUrl](/docs/{{version}}/model-resource/routes).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

public function buttons(): ListOf
{
    return parent::buttons()
        ->add(
            ActionButton::make('To custom page',
                url: fn($model) => $this->getResource()?->getPageUrl(
                    PostPage::class, params: ['resourceItem' => $model->getKey()]
                ),
            ),
        );
}
```

<a name="assets"></a>
## Assets

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    parent::onLoad();

    $this->getAssetManager()
        ->add(Css::make('/css/app.css'))
        ->append(Js::make('/js/app.js'));
}
```
