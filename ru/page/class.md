# Создание класса

-   [Основы](#basics)
-   [Создание класса](#create)
-   [Заголовок](#title)
-   [Компоненты](#components)
-   [Хлебные крошки](#breadcrumbs)
-   [Макет](#layout)
-   [Псевдоним](#alias)
-   [Рендеринг](#render)
-   [Перед рендерингом](#before-render)

<a name="basics"></a>
## Основы

*Page* является основой админ-панели **MoonShine**. Основное назначение *Page* - отображение компонентов.

Страницы с одинаковой логикой могут быть объединены в `Resource`.

<a name="create"></a>
## Создание класса

Для создания класса страницы можно использовать консольную команду:

```php
php artisan moonshine:page
```

После ввода имени класса будет создан файл, который является основой для страницы в админ-панели.  
По умолчанию он располагается в директории `app/MoonShine/Pages`.

Вы можете указать имя класса и директорию его расположения в команде.

```php
php artisan moonshine:page OrderStatistics --dir=Pages/Statistics
```

Файл `OrderStatistics` будет создан в директории `app/MoonShine/Pages/Statistics`.

<a name="title"></a>
## Заголовок

Заголовок страницы можно задать через свойство `title`, а `subtitle` задает подзаголовок.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $title = 'CustomPage';
    protected string $subtitle = 'Подзаголовок';

    //...
}
```

Если для заголовка и подзаголовка требуется какая-то логика, то методы `title()` и `subtitle()` позволяют ее реализовать.

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
        return $this->subtitle ?: 'Подзаголовок';
    }

    //...
}
```

<a name="components"></a>
## Компоненты

Страница строится из компонентов, которыми могут быть как декорации и компоненты самой админ-панели, [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder), [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder), так и просто *blade* компоненты, и даже компоненты *Livewire*.

Для регистрации компонентов страницы используется метод `components()`.

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
                        TextBlock::make('Заголовок 1', 'Текст 1')
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        TextBlock::make('Заголовок 2', 'Текст 2')
                    ])
                ])->columnSpan(6),
            ])
        ];
    }

    //...
}
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Компоненты](https://moonshine-laravel.com/docs/resource/components/components-index).

<a name="breadcrumbs"></a>
## Хлебные крошки

За генерацию хлебных крошек отвечает метод `breadcrumbs()`.

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
## Макет

По умолчанию страницы используют шаблон отображения _Layout_ по умолчанию, но вы можете его изменить через свойство `layout`.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $layout = 'moonshine::layouts.app';

    //...
}
```

*Layout* также можно переопределить с помощью метода `layout()`.

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
## Псевдоним

Если необходимо изменить псевдоним страницы, это можно сделать через свойство `alias`.

```php
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected ?string $alias = null;

    //...
}
```

Также можно переопределить метод `getAlias()`.

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
## Рендеринг

Вы можете отображать страницу вне MoonShine, просто вернув ее в Контроллере

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

Или с Fortify

```php
Fortify::loginView(static fn() => LoginPage::make());
```

<a name="before-render"></a>
## Перед рендерингом

Метод `beforeRender()` позволяет выполнить какие-либо действия перед отображением страницы.

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
