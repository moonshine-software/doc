<x-page
    title="Число"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=827&end=913', 'title' => 'Screencasts: Поле Number'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Input с типом number и дополнительными методами  <code>stars</code>, <code>min</code>, <code>max</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Рейтинг', 'rating')
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

<x-p>
    Для отображения числового значения в виде звезд (например для рейтинга), необходим метод  <code>stars</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Рейтинг', 'rating')
            ->stars() // [tl! focus]
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

</x-page>
