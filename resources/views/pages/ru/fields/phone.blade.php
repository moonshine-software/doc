<x-page title="Телефон">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Phone</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=tel</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Phone; // [tl! focus]

//...

public function fields(): array
{
    return [
        Phone::make('Phone') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Для маски телефона воспользуйтесь методом <code>mask('7 999 999-99-99')</code>
</x-moonshine::alert>

</x-page>
