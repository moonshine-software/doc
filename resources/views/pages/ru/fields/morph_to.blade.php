<x-page title="MorphTo">

<x-extendby :href="to_page('fields-belongs_to')">
    BelongsTo
</x-extendby>

<x-p>Поле для отношений в Laravel типа MorphTo</x-p>

<x-p>То же самое что и <code>MoonShine\Fields\Relationships\BelongsTo</code> только для отношений MorphTo</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\MorphTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        MorphTo::make('Commentable')->types([
            Article::class => 'title'
        ]), // [tl! focus:-2]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/morph_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_dark.png') }}"></x-image>
<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Обязательный метод <code>types</code> с указанием доступных классов.
</x-moonshine::alert>

<x-p>Описание значения метода <code>types</code>:</x-p>
<x-p>Ключ — ссылка на модель<br>
Значение - строка или массив.<br>
<x-moonshine::alert type="default" icon="heroicons.information-circle">
Если значение передаётся как строка, то она должна указывать на название поля, которое нужно отобразить. Если же передаётся как массив, то первый элемент массива — это название поля для отображения, а второй — имя отношения вместо названия модели.
</x-moonshine::alert>
</x-p>

<x-code>
use MoonShine\Fields\Relationships\MorphTo; // [tl! focus]

//...

public function fields(): array
{
    return [
        MorphTo::make('Imageable')->types([
            Company::class => ['short_name', 'Organization']
        ]), // [tl! focus:-2]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/morph_to_array.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_array_dark.png') }}"></x-image>

</x-page>
