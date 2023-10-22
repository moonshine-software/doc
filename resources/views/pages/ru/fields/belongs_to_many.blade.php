<x-page
    title="BelongsToMany"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#pivot', 'label' => 'Pivot'],
            ['url' => '#creatable', 'label' => 'Создание объекта отношения'],
            ['url' => '#select', 'label' => 'Select'],
            ['url' => '#tree', 'label' => 'Tree'],
            ['url' => '#preview', 'label' => 'Preview'],
            ['url' => '#onlycount', 'label' => 'onlyCount'],
            ['url' => '#inline', 'label' => 'inLine'],
            ['url' => '#values-query', 'label' => 'Запрос для значений'],
            ['url' => '#async-search', 'label' => 'Асинхронный поиск'],
            ['url' => '#with-image', 'label' => 'Значения с изображением'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

@include('pages.ru.fields.shared.relation_make', ['field' => 'BelongsToMany', 'label' => 'Categories'])

<x-sub-title id="pivot">Pivot</x-sub-title>

<x-p>
    Метод <code>fields()</code> используется для реализации <em>pivot</em> полей у отношения BelongsToMany.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', resource: new ContactResource())
            ->fields([
                Text::make('Contact', 'text'),
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_pivot.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_pivot_dark.png') }}"></x-image>

<x-sub-title id="creatable">Создание объекта отношения</x-sub-title>

@include('pages.ru.fields.shared.relation_creatable', ['field' => 'BelongsToMany', 'label' => 'Categories'])

<x-sub-title id="select">Select</x-sub-title>

<x-p>
    Поле <em>BelongsToMany</em> можно отобразить в виде выпадающего списка,
    для этого необходимо воспользоваться методом <code>selectMode()</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->selectMode() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_select_dark.png') }}"></x-image>


<x-sub-title id="tree">Tree</x-sub-title>

<x-p>
    Метод <code>tree()</code> позволять отобразить значения в виде дерева с чекбоксами,
    например для категорий, которые имеют вложенность.
    Методу необходимо передать столбец в базе данных по которому будет строиться дерево.
</x-p>

<x-code language="php">
tree(string $parentColumn)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->tree('parent_id') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_tree.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_tree_dark.png') }}"></x-image>

<x-sub-title id="preview">Preview</x-sub-title>

<x-p>
    По умолчанию в <em>preview</em> поле будет отображаться в виде таблицы.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_dark.png') }}"></x-image>

<x-p>
    Для того чтобы изменить отображение в <em>preview</em> можно воспользоваться следующими методами.
</x-p>

<x-moonshine::divider label="onlyCount" />

<x-p>
    Метод <code>onlyCount()</code> позволяет отобразить в <em>preview</em> только количество выбранных значений.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyCount() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview_count.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_count_dark.png') }}"></x-image>

<x-moonshine::divider label="inLine" />

<x-p>
    Метод <code>inLine()</code> позволяет отобразить значения поля в виде строки.
</x-p>

<x-code language="php">
inLine(string $separator = '', bool $badge = false)
</x-code>

<x-p>
    Методу можно передать необязательные параметры:
    <ul>
        <li><code>separator</code> - разделитель между элементами;</li>
        <li><code>badge</code> - отображать элементы в виде badge.</li>
    </ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->inLine(separator: ' ', badge: true) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_many_preview_in_line.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_many_preview_in_line_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.values_query', ['field' => 'BelongsToMany'])

@include('pages.ru.fields.shared.async_search', ['field' => 'BelongsToMany'])

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Запросы необходимо кастомизировать через метод <code>asyncSearch()</code>.
    Не используйте <code>valuesQuery()</code>!
</x-moonshine::alert>

@include('pages.ru.fields.shared.with_image', ['field' => 'BelongsToMany'])

</x-page>
