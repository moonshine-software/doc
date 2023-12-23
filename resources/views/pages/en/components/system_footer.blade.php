<x-page
    title="System component Footer"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#copyright', 'label' => 'Copyright'],
            ['url' => '#menu', 'label' => 'Menu'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Footer</em> system component is used to create a footer block in <strong>MoonShine</strong>.
</x-p>

<x-p>
    You can create a <em>Footer</em> using the static <code>make()</code> method
    class <code>Footer</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-ul>
    <li></li><code>$components</code> - an array of components that are located in the footer.</li>
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
    The <code>copyright()</code> method allows you to design a copyright block in the footer.
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
    The <code>menu()</code> method allows you to design a block in a menu in the footer.
</x-p>

<x-code language="php">
menu(array $data)
</x-code>

<x-ul>
    <li><code>$data</code> - an array of elements, where the key is the url and the value is the name of the menu item.</li>
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
