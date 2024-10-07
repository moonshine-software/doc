# Системный компонент Footer

- [Создание](#make)
- [Авторские права](#copyright)
- [Меню](#menu)

---

<a name="make"></a>
## Создание

Системный компонент *Footer* используется для создания блока подвала в **MoonShine**.

Вы можете создать *Footer*, используя статический метод `make()` класса `Footer`.

```php
make(array $components = [])
```

- `$components` - массив компонентов, которые располагаются в подвале.

```php
namespace App\MoonShine;

use App\MoonShine\Components\MyComponent;
use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make([
                MyComponent::make(),
            ])
        ]);
    }
}
```

<a name="copyright"></a>
## Авторские права

Метод `copyright()` позволяет оформить блок авторских прав в подвале.

```php
copyright(string|Closure $text)
```

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make()
                ->copyright(fn (): string => <<<HTML
                    &copy; 2021-2023 Сделано с ❤️ от
                    <a href="https://cutcode.dev"
                        class="font-semibold text-primary hover:text-secondary"
                        target="_blank"
                    >
                        CutCode
                    </a>
                HTML
                )
        ]);
    }
}
```

<a name="menu"></a>
## Меню

Метод `menu()` позволяет оформить блок меню в подвале.

```php
menu(array $data)
```

- `$data` - массив элементов, где ключ - это url, а значение - название пункта меню.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\Footer;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            //...

            Footer::make()
                ->menu([
                    'https://moonshine-laravel.com/docs' => 'Документация',
                ])
        ]);
    }
}
```
