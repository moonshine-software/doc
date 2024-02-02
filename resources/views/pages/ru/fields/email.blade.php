<x-page title="E-mail">

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Email</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=email</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Email; // [tl! focus]

//...

public function fields(): array
{
    return [
        Email::make('Email') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
