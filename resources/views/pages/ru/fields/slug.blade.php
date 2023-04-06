<x-page title="Slug">

<x-p>
    С помощью данного поля вы можете генерировать slug на основе выбранного поля, а также сохранять его уникальным
</x-p>

<x-code language="php">
//...
use Leeto\MoonShine\Fields\Slug;

public function fields(): array
{
    return [
        Slug::make('Slug')->from('title')->separator('-')->unique(),
    ];
}

//...
</x-code>

</x-page>
