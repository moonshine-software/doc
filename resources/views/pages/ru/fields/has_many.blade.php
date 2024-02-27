<x-page
    title="HasMany"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#creatable', 'label' => 'Создание объекта отношения'],
            ['url' => '#limit', 'label' => 'Количество записей'],
            ['url' => '#only-link', 'label' => 'Только ссылка'],
            ['url' => '#parent-id', 'label' => 'ID родителя'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

@include('pages.ru.fields.shared.relation_make', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Метод <code>fields()</code> позволят задать поля, которые будут отображаться в <em>preview</em>.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->fields([
                BelongsTo::make('User'),
                Text::make('Text'),
            ]) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_fields_dark.png') }}"></x-image>

<x-sub-title id="creatable">Создание объекта отношения</x-sub-title>

@include('pages.ru.fields.shared.relation_creatable', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="limit">Количество записей</x-sub-title>

<x-p>
    Метод <code>limit()</code> позволяет ограничить количество записей отображаемых в <em>preview</em>.
</x-p>

<x-code language="php">
limit(int $limit)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->limit(1) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="only-link">Только ссылка</x-sub-title>

<x-p>
    Метод <code>onlyLink()</code> позволят отобразить отношение в виде ссылки с количеством элементов.
</x-p>

<x-code language="php">
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
</x-code>

<x-p>
    Методу можно передать необязательные параметры:
    <x-ul>
        <li><code>linkRelation</code> - ссылка на отношение;</li>
        <li>
            <code>condition</code> - замыкание или булево значение,
            отвечающее за отображение отношения как ссылки.
        </li>
    </x-ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_link_dark.png') }}"></x-image>

<x-moonshine::divider label="linkRelation"></x-moonshine::divider>

<x-p>
    Для выборки значений отношения для родительского ресурса,
    необходимо в ресурсе отношения задать свойство <code>$parentRelations</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CommentResource extends ModelResource
{
    //...

    protected array $parentRelations = ['user'];

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Будет доступен маршрут:<br />
    <em>/resource/comment-resource/index-page/user-{id}</em>
</x-moonshine::alert>

<x-p>
    Параметр <code>linkRelation</code> позволяет создать ссылку на отношение с привязкой родительского ресурса.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink('user') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="condition"></x-moonshine::divider>

<x-p>
    Параметр <code>condition</code> через замыкание позволят изменять способ отображения в зависимости от условий.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

@include('pages.ru.fields.shared.parent_id')

</x-page>
