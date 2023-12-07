<x-page title="MorphTo">

<x-extendby :href="route('moonshine.page', 'fields-belongs_to')">
    BelongsTo
</x-extendby>

<x-p>Поле для отношений в Laravel типа MorphTo</x-p>

<x-p>То же самое что и <code>MoonShine\Fields\BelongsTo</code> только для отношений MorphTo</x-p>

<x-code language="php">
use MoonShine\Fields\MorphTo; // [tl! focus]

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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Обязательный метод <code>types</code> с указанием доступных классов.<br/>
    Ключ — ссылка на модель, а значение — поле для отображения.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/morph_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/morph_to_dark.png') }}"></x-image>

</x-page>
