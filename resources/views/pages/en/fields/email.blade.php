<x-page title="E-mail">

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Email</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=email</code>.
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
