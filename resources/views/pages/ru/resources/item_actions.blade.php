<x-page title="Кастомные действия" :sectionMenu="[
    'Разделы' => [
        ['url' => '#register', 'label' => 'Регистрация'],
        ['url' => '#condition', 'label' => 'Условие отображения'],
        ['url' => '#view', 'label' => 'Способ отображения'],
        ['url' => '#confirm', 'label' => 'Подтверждение действия'],
    ]
]">

<x-sub-title id="register">Регистрация</x-sub-title>

<x-p>
    По умолчанию в панели MoonShine в таблице всего 2 действия над элементами - редактирование и удаление.
    Но также есть возможность добавить свои кастомные действия
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\ItemActions\ItemAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function itemActions(): array // [tl! focus:start]
    {
        return [
            ItemAction::make('Deactivating', function (Model $item) {
                $item->update(['active' => false]);
            }, 'Deactivated')->icon('app')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<p>
    Первый аргумент - Наименование экшена.
    Второй аргумент - callback с параметром текущего элемента.
    Третий аргумент - сообщение, которое отобразится после выполнения экшена
</p>

<x-sub-title id="condition">Условие отображения</x-sub-title>

<x-p>
    Отображать действие по условию
</x-p>

<x-code language="php">
...
public function itemActions(): array
{
    return [
        ItemAction::make('Restore', function (Model $item) {
            $item->restore();
        }, 'Retrieved')
            ->canSee(fn(Model $item) => $item->trashed()) // [tl! focus]
    ];
}
...
</x-code>

@include('pages.ru.resources.shared.actions_view', ['action' => 'ItemAction'])
@include('pages.ru.resources.shared.actions_confirm', ['action' => 'ItemAction'])

</x-page>
