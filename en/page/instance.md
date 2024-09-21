https://moonshine-laravel.com/docs/resource/page/page-instance?change-moonshine-locale=en

------
# Make instance

  - [Make](#make)
  - [Announcement](#define)
  - [Heading](#title)
  - [Layout](#layout)
  - [Breadcrumbs](#breadcrumbs)
  - [Alias](#alias)
  - [Quick page](#view-page)
  - [Render](#render)

You can create instances of pages from classes and register them in the admin panel.

<a name="make"></a>
## Make

To create a page instance, use the static `make()` method:

```php
make(
    ?string $title = null,
    ?string $alias = null,
    ?ResourceContract $resource = null
)
```

-`title` - page title;
-`alias` - alias for page url;
-`resource` - the resource to which the page belongs.

```php
use App\MoonShine\Pages\CustomPage;
//...

CustomPage::make('Custom page', 'custom_page')
//...
```

<a name="define"></a>
## Declaring pages in the system


To register the page in the system and immediately add its link in the navigation menu, use the service provider `MoonShineServiceProvider`:

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
            MenuItem::make('Custom page', CustomPage::make('Custom page', 'custom_page'))
        ];
    }

    //...
}
```

> [!TIP]
> You can learn about advanced settings in the section [Menu](https://moonshine-laravel.com/docs/resource/menu/menu) .

If you only need to register the page in the system without adding it to the navigation menu, then you need to use the `pages()` method:

```php
namespace App\Providers;

use App\MoonShine\Pages\CustomPage;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function pages(): array
    {
        return [
            CustomPage::make('Title page', 'custom_page')
        ];
    }

    //...
}
```

<a name="title"></a>
## Title/Subtitle

The `setTitle()` method allows you to change the page title, and the `setSubTitle()` method consequently the subtitle.

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
        CustomPage::make('Title page', 'custom_page')
            ->setTitle('New title')
            ->setSubTitle('Subtitle')
    ];
}

//...
```

<a name="layout"></a>
## Layout

The `setLayout()` method allows you to change the Layout template of a page instance.

```php
setLayout(string $layout)
```

```php
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page', 'custom_page')
            ->setLayout('custom_layouts.app')
    ];
}

//...
]
```

<a name="breadcrumbs"></a>
## Breadcrumbs

The `setBreadcrumbs()` method allows you to change the breadcrumbs of a page.

```php
use App\MoonShine\Pages\CustomPage;

//...
public function pages(): array
{
    return [
        CustomPage::make('Title page', 'custom_page')
            ->setBreadcrumbs([
                '#' => $this->title()
            ])
    ];
}

//...
```

<a name="alias"></a>
## Alias

The `alias()` method allows you to change the alias for a page instance.

```php
alias(string $alias)
```

```php
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page')
            ->alias('custom-page')
    ];
}

//...
```

<a name="view-page"></a>
## Quick page

If you need to add a page without creating a class, but simply specifying a blade view, we recommend using `ViewPage`.

```php
MenuItem::make(
    'Custom',
    ViewPage::make()
        ->setTitle('Hello')
        ->setLayout('custom_layout')
        ->setContentView('my-form', ['param' => 'value'])
),
```

<a name="render"></a>
## Render

You can display the quick page outside of MoonShine by simply returning it to the Controller.

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
            ->setTitle('Welcome')
            ->setLayout('layouts.app')
            ->setContentView('welcome', ['articles' => $articles]);
    }
}
```
