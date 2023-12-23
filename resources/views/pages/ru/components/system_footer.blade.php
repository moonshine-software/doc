<x-page
    title="Системный компонент Footer"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#copyright', 'label' => 'Copyright'],
            ['url' => '#menu', 'label' => 'Menu'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>Footer</em> служит для создания блока футера в <strong>MoonShine</strong>.
</x-p>

<x-p>
    Создать <em>Footer</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Footer</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-ul>
    <li><code>$components</code> - массив компонентов которые располагаются в футере.</li>
</x-ul>

<x-code language="php">
namespace App\MoonShine;

use App\MoonShine\Components\MyComponent;
use MoonShine\Components\Layout\Footer; // [tl! focus]
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
            ]) // [tl! focus:-2]
        ]);
    }
}
</x-code>

<x-sub-title id="copyright">Copyright</x-sub-title>

<x-p>
    Метод <code>copyright()</code> позволяет оформить блок copyright в футуре.
</x-p>

<x-code language="php">
copyright(string|Closure $text)
</x-code>

<x-code language="php">
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
                ->copyright(fn (): string => <<<'HTML'
                    &copy; 2021-2023 Made with ❤️ by
                    <a href="https://cutcode.dev"
                        class="font-semibold text-primary hover:text-secondary"
                        target="_blank"
                    >
                        CutCode
                    </a>
                HTML) // [tl! focus:-8]
        ]);
    }
}
</x-code>

<x-sub-title id="menu">Menu</x-sub-title>

<x-p>
    Метод <code>menu()</code> позволяет оформить блок в меню в футуре.
</x-p>

<x-code language="php">
menu(array $data)
</x-code>

<x-ul>
    <li><code>$data</code> - массив элементов, где ключ - url, а значение - название пункта меню.</li>
</x-ul>

<x-code language="php">
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
                    'https://moonshine-laravel.com/docs' => 'Documentation',
                ]) // [tl! focus:-2]
        ]);
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/footer.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/footer_dark.png') }}"></x-image>

</x-page>
