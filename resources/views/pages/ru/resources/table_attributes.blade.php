<x-page title="Аттрибуты таблицы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Через ресурсы модели есть возможность кастомизировать <code>tr</code> и <code>td</code> у таблицы с данными.<br />
    Для это необходимо использовать соответствующие методы <code>trAttributes()</code> и <code>tdAttributes()</code>,
    которым нужно передать замыкание, возвращающее атрибуты для <x-link link="{{ route('moonshine.page', 'components-table') }}">компонента таблица</x-link>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use Closure;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function trAttributes(): Closure // [tl! focus:start]
    {
        return function (
            Model $item,
            int $row,
            ComponentAttributeBag $attr
        ): ComponentAttributeBag {
            if ($item->id === 1 | $row === 2) {
                $attr->setAttributes([
                    'class' => 'bgc-green'
                ]);
            }

            return $attr;
        };
    } // [tl! focus:start]

    public function tdAttributes(): Closure // [tl! focus:start]
    {
        return function (
            Model $item,
            int $row,
            int $cell,
            ComponentAttributeBag $attr = null
        ): ComponentAttributeBag {
            if ($cell === 6) {
                $attr->setAttributes([
                    'class' => 'bgc-red'
                ]);
            }

            return $attr;
        };
    } // [tl! focus:start]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/table_class.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/table_class_dark.png') }}"></x-image>

</x-page>
