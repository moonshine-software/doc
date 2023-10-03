<x-page
    title="Textarea"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#default', 'label' => 'Значение по умолчанию'],
        ]
    ]"
>

<x-p>
    Поле <em>Textarea</em> включает в себя все базовые методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Textarea; // [tl! focus]

//...

public function fields(): array
{
    return [
        Textarea::make('Text') // [tl! focus]
    ];
}

//...
</x-code>


<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Можно воспользоваться методом <code>default()</code>, если необходимо указать значение по умолчанию для поля.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Text')
            ->default('...') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
