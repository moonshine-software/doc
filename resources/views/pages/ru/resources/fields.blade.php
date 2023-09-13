<x-page
    title="Поля"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#override', 'label' => 'Переопределение полей'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поля в большинстве случаев относятся к полям таблицы из базы данных. В рамках <strong>CRUD</strong> будут выводиться
    на главной странице раздела (ресурса) со списком и на странице создания и редактирования записей.
    В административной панели MoonShine существует множество видов полей, которые покрывают все возможные требования!
    Также охватывают и все возможные связи в Laravel и для удобства называются так же, как и методы отношений
    <code>BelongsTo</code>, <code>BelongsToMany</code>, <code>HasOne</code>, <code>HasMany</code>,
    <code>HasOneThrough</code>, <code>HasManyThrough</code>, <code>MorphOne</code>, <code>MorphMany</code>
</x-p>

<x-p>
    Добавлять новые поля крайне просто! Достаточно в методе <code>fields()</code>, который возвращает массив,
    вернуть все необходимые поля, а как устроенны поля, мы рассмотрим в разделе
    <x-link link="{{ route('moonshine.custom_page', 'fields-index') }}">"Поля"</x-link>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title', 'title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_dark.png') }}"></x-image>


<x-sub-title id="override">Переопределение полей</x-sub-title>

<x-p>
    Иногда возникает потребность исключить или поменять порядок некоторых полей в индексной или детальной странице.
    Для этого можно воспользоваться методами которые позволяют переопределить поля для соответствующих страниц:
    <code>indexFields()</code>, <code>formFields()</code> или <code>detailFields()</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title', 'title'),
            Text::make('Subtitle', 'title'),
        ];
    }

    public function indexFields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title', 'title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
