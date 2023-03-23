<x-page title="Поля" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Поля в большинстве случаев относятся к полям таблицы из базы данных. В рамках CRUD будут выводиться
    на главной странице раздела (ресурса) со списком и на странице создания и редактирования записей.
    В административной панеле MoonShine существует множество видов полей которые покрывают все возможные требования!
    Также охватывают и все возможные связи в Laravel и для удобства называются также как и методы отношений
    <code>BelongsTo</code>, <code>BelongsToMany</code>, <code>HasOne</code>, <code>HasMany</code>,
    <code>HasOneThrough</code>, <code>HasManyThrough</code>, <code>MorphOne</code>, <code>MorphMany</code>
</x-p>

<x-p>
    Добавлять новые поля крайне просто! Досточно в методе <code>fields</code> который возвращает массив,
    вернуть все необходимые поля, а как устроенны поля мы рассмотрим в разделе <x-link link="{{ route('moonshine.custom_page', 'fields-index') }}">"Поля"</x-link>.
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Fields\ID; // [tl! focus]
use Leeto\MoonShine\Fields\Text; // [tl! focus]
use Leeto\MoonShine\Decorations\Block;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    public function fields(): array // [tl! focus:start]
    {
        return [
            Block::make('Block title', [
                ID::make(),
                Text::make('Заголовок', 'title'),
            ])
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_dark.png') }}"></x-image>

</x-page>
