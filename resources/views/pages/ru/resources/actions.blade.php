<x-page title="Действия" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#view', 'label' => 'Способ отображения']
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Часто необходимо что-либо сделать со списком раздела, и для этих целей служат "Действия".
    На данный момент в MoonShine всего один Action класс, который отвечает за экспорт данных,
    но действия расширяются, и вы можете легко написать собственные.
</x-p>

<x-p>
    Добавлять новые действия также крайне просто, и все выполнено в едином стиле! Достаточно в методе <code>actions</code>, который возвращает массив,
    вернуть все необходимые действия, а как устроенны действия, мы рассмотрим в разделе <x-link link="{{ route('moonshine.custom_page', 'actions-index') }}">"Действия"</x-link>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод отсутствует либо возвращает пустой массив, то действия не будут отображаться
</x-moonshine::alert>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\Actions\ExportAction; // [tl! focus]

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

<x-image theme="light" src="{{ asset('screenshots/export.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/export_dark.png') }}"></x-image>

@include('pages.ru.resources.shared.actions_view', ['action' => 'ExportAction'])

</x-page>
