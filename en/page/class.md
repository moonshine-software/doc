https://moonshine-laravel.com/docs/resource/page/page-class

------

# Create class

    -   [Basics](#basics)
    -   [Creating a class](#create)
    -   [Heading](#title)
    -   [Components](#components)
    -   [bread crumbs](#breadcrumbs)
    -   [Layout](#layout)
    -   [Alias](#alias)
    -   [Render](#render)
    -   [beforeRender](#before-render)

<a name="basics"></a>
## Basics

*Page* is the basis of the **MoonShine** admin panel. The main purpose of *Page* is to display components.

Pages with the same logic can be combined into `Resource`.

<a name="create"></a>
## Creating a class

To create a page class, you can use the console command:

```php
php artisan moonshine:page
```

After entering the name of the class, a file will be created, which is the basis for the page in the admin panel.  
It is located by default in the `app/MoonShine/Pages` directory.

You can specify the name of the class and the directory of its location in the command.

```php
php artisan moonshine:page OrderStatistics --dir=Pages/Statistics
```

The file `OrderStatistics` will be created in the `app/MoonShine/Pages/Statistics` directory.

<a name="title"></a>
## Heading

The page title can be set through the `title` property, and `subtitle` sets the subtitle.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $title = 'CustomPage';
    protected string $subtitle = 'Subtitle';

    //...
}
```

If some logic is required for the title and subtitle, then the `title()` and `subtitle()` methods allow you to implement it.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function title(): string
    {
        return $this->title ?: 'CustomPage';
    }

    public function subtitle(): string
    {
        return $this->subtitle ?: 'Subtitle';
    }

    //...
}
```

<a name="components"></a>
## Components

The page is built from components, which can be both decorations and components of the admin panel itself, [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder) , [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder) , and just *blade* components, and even *Livewire* components.

To register page components, use the `components()` method.

```php
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function components(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        TextBlock::make('Title 1', 'Text 1')
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        TextBlock::make('Title 2', 'Text 2')
                    ])
                ])->columnSpan(6),
            ])
        ];
    }

    //...
}
```

> [!NOTE]
> For more detailed information, please refer to the section [Components](https://moonshine-laravel.com/docs/resource/components/components-index).

<a name="breadcrumbs"></a>
## Bread crumbs

The `breadcrumbs()` method is responsible for generating bread crumbs.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    //...
}
```

<a name="layout"></a>
## Layout

By default, pages use a default _Layout_ display template, but you can modify it through the `layout` property.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $layout = 'moonshine::layouts.app';

    //...
}
```

*Layout* can also be overridden using `layout()` method.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function layout(): string
    {
        return $this->layout;
    }

    //...
}
```

<a name="alias"></a>
## Alias

If you need to change the page alias, this can be done through the `alias` property.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected ?string $alias = null;

    //...
}
```

It is also possible to override the `getAlias()` method.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function getAlias(): ?string
    {
        return 'custom_page';
    }

    //...
}
```

<a name="render"></a>
## Render

You can display the page outside of MoonShine by simply returning it to the Controller

```php
use MoonShine\Pages\Page;

class ProfileController extends Controller
{
    public function __invoke(): Page
    {
        return ProfilePage::make();
    }
}
```

Or with Fortify

```php
Fortify::loginView(static fn() => LoginPage::make());
```

<a name="before-render"></a>
## beforeRender

The `beforeRender()` method allows you to perform some actions before displaying the page.

```php
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function beforeRender(): void
    {
        if (auth()->user()->moonshine_user_role_id !== MoonshineUserRole::DEFAULT_ROLE_ID) {
            abort(403);
        }
    }
}
```
