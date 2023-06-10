<x-page title="Стили таблицы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Через ресурсы есть возможность кастомизировать цвет для <code>tr</code> и <code>td</code> для таблиц с данными
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function trClass(Model $item, int $index): string // [tl! focus:start]
    {
        if($item->id === 1 || $index === 2) {
            return 'green';
        }

        return parent::trClass($item, $index);
    }

    public function tdClass(Model $item, int $index, int $cell): string
    {
        if($cell === 6) {
            return 'red';
        }

        return parent::tdClass($item, $index, $cell);
    } // [tl! focus:end]
    //...
}
</x-code>

@include('pages.ru.components.shared.colors')

<x-image theme="light" src="{{ asset('screenshots/table_class.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/table_class_dark.png') }}"></x-image>

<x-p>
    Также можно добавить кастомные стили
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function trStyles(Model $item, int $index): string // [tl! focus:start]
    {
        if ($item->id === 1 || $index === 2) {
            return 'background: rgba(128, 152, 253, .5);';
        }

        return parent::trStyles($item, $index);
    }

    public function tdStyles(Model $item, int $index, int $cell): string
    {
        if ($cell === 3) {
            return 'background: rgba(128, 253, 163, .5); text-align:center;';
        }

        return parent::tdStyles($item, $index, $cell);
    } // [tl! focus:end]
    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/table_style.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/table_style_dark.png') }}"></x-image>

</x-page>
