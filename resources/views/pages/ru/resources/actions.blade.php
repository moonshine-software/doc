<x-page title="Действия" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Часто необходимо что-либо сделать со списком раздела и для этих целей служат "Действия".
    На данный момент в moonShine всего один Action класс, который отвечает за экспорт данных,
    но действия расширяются и вы можете легко написать собственные.
</x-p>

<x-p>
    Добавлять новые действия также крайне просто и все выполнено в единном стиле! Досточно в методе <code>actions</code> который возвращает массив,
    вернуть все необходимые действия, а как устроенны действия мы рассмотрим в разделе <x-link link="{{ route('section', 'actions-index') }}">"Действия"</x-link>.
</x-p>

<x-alert>
    Если метод отсутствует, либо возвращает пустой массив, то действия не будут отображаться
</x-alert>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Actions\ExportAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    public function actions(): array // [tl! focus:start]
    {
        return [
            ExportAction::make('Экспорт')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image src="{{ asset('screenshots/export.png') }}"></x-image>

</x-page>
