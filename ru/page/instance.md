# Создание экземпляра

  - [Создание](#make)
  - [Объявление](#define)
  - [Заголовок](#title)
  - [Макет](#layout)
  - [Хлебные крошки](#breadcrumbs)
  - [Псевдоним](#alias)
  - [Быстрая страница](#view-page)
  - [Рендеринг](#render)

---

Вы можете создавать экземпляры страниц из классов и регистрировать их в админ-панели.

<a name="make"></a>
## Создание

Для создания экземпляра страницы используйте статический метод `make()`:

```php
make(
    ?string $title = null,
    ?string $alias = null,
    ?ResourceContract $resource = null
)
```

-`title` - заголовок страницы;
-`alias` - псевдоним для URL страницы;
-`resource` - ресурс, к которому принадлежит страница.

```php
use App\MoonShine\Pages\CustomPage;
//...

CustomPage::make('Пользовательская страница', 'custom_page')
//...
```

<a name="define"></a>
## Объявление страниц в системе

Для регистрации страницы в системе и сразу добавления ее ссылки в навигационное меню используйте сервис-провайдер `MoonShineServiceProvider`:

```php
namespace App\Providers;

use App\MoonShine\Pages\CustomPage;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function menu(): array
    {
        return [
            MenuItem::make('Пользовательская страница', CustomPage::make('Пользовательская страница', 'custom_page'))
        ];
    }

    //...
}
```

> [!TIP]
> О расширенных настройках вы можете узнать в разделе [Меню](https://moonshine-laravel.com/docs/resource/menu/menu).

Если вам нужно только зарегистрировать страницу в системе без добавления ее в навигационное меню, то необходимо использовать метод `pages()`:

```php
namespace App\Providers;

use App\MoonShine\Pages\CustomPage;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function pages(): array
    {
        return [
            CustomPage::make('Заголовок страницы', 'custom_page')
        ];
    }

    //...
}
```

<a name="title"></a>
## Заголовок/Подзаголовок

Метод `setTitle()` позволяет изменить заголовок страницы, а метод `setSubTitle()` - подзаголовок.

```php
setTitle(string $title)
```

```php
setSubTitle(string $subtitle)
```

```php
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Заголовок страницы', 'custom_page')
            ->setTitle('Новый заголовок')
            ->setSubTitle('Подзаголовок')
    ];
}

//...
```

<a name="layout"></a>
## Макет

Метод `setLayout()` позволяет изменить шаблон Layout экземпляра страницы.

```php
setLayout(string $layout)
```

```php
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Заголовок страницы', 'custom_page')
            ->setLayout('custom_layouts.app')
    ];
}

//...
]
```

<a name="breadcrumbs"></a>
## Хлебные крошки

Метод `setBreadcrumbs()` позволяет изменить хлебные крошки страницы.

```php
use App\MoonShine\Pages\CustomPage;

//...
public function pages(): array
{
    return [
        CustomPage::make('Заголовок страницы', 'custom_page')
            ->setBreadcrumbs([
                '#' => $this->title()
            ])
    ];
}

//...
```

<a name="alias"></a>
## Псевдоним

Метод `alias()` позволяет изменить псевдоним для экземпляра страницы.

```php
alias(string $alias)
```

```php
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Заголовок страницы')
            ->alias('custom-page')
    ];
}

//...
```

<a name="view-page"></a>
## Быстрая страница

Если вам нужно добавить страницу без создания класса, а просто указав blade-представление, рекомендуем использовать `ViewPage`.

```php
MenuItem::make(
    'Пользовательская',
    ViewPage::make()
        ->setTitle('Привет')
        ->setLayout('custom_layout')
        ->setContentView('my-form', ['param' => 'value'])
),
```

<a name="render"></a>
## Рендеринг

Вы можете отображать быструю страницу вне MoonShine, просто вернув ее в Контроллере.

```php
class HomeController extends Controller
{
    public function __invoke(Request $request): Page
    {
        $articles = Article::query()
            ->published()
            ->latest()
            ->take(6)
            ->get();

        return ViewPage::make()
            ->setTitle('Добро пожаловать')
            ->setLayout('layouts.app')
            ->setContentView('welcome', ['articles' => $articles]);
    }
}
```
