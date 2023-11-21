<x-page
    title="Системный компонент Layout"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#blade', 'label' => 'Blade'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Системный компонент <em>Layout</em> служит основой для построения любой страницы в <strong>MoonShine</strong>.<br />
    Он включает в себя тег <code>body</code> и основные элементы разметки, а также необходимые классы и скрипты.
</x-p>

<x-p>
    Создать <em>Layout</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>LayoutBuilder</code>.
</x-p>

<x-code language="php">
make(array $components = [])
</x-code>

<x-code language="php">
use MoonShine\Components\LayoutBuilder
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([ // [tl! focus]
            // ...
        ]); // [tl! focus]
    }
}
</x-code>

<x-sub-title id="blade">Blade</x-sub-title>

<x-p>
    Компонент можно использовать в <em>html</em> разметке:
</x-p>

<x-code language="blade" file="resources/views/examples/components/system/layout.blade.php"></x-code>

</x-page>
