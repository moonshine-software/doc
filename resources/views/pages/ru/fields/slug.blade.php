<x-page
    title="Slug"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#from', 'label' => 'Генерация slug'],
            ['url' => '#separator', 'label' => 'Разделитель'],
            ['url' => '#locale', 'label' => 'Локаль'],
            ['url' => '#unique', 'label' => 'Уникальное значение'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    С помощью данного поля вы можете генерировать slug на основе выбранного поля,
    а также сохранять только уникальные значения.
</x-p>

<x-code language="php">
use MoonShine\Fields\Slug; // [tl! focus]

//...

public function fields(): array
{
    return [
        Slug::make('Slug') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slug.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slug_dark.png') }}"></x-image>

<x-sub-title id="from">Генерация slug</x-sub-title>

<x-p>
    Через метод <code>from()</code> можно указать на основе какого поля модели генерировать slug,
    при отсутствии значения.
</x-p>

<x-code language="php">
from(string $from)
</x-code>

<x-code language="php">
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->from('title') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="separator">Разделитель</x-sub-title>

<x-p>
    По умолчанию в качестве разделителя слов при генерации slug используется <x-moonshine::badge color="gray">-</x-moonshine::badge>,
    метод <code>separator()</code> позволяет изменить это значение.
</x-p>

<x-code language="php">
separator(string $separator)
</x-code>

<x-code language="php">
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->separator('_') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="locale">Локаль</x-sub-title>

<x-p>
    По умолчанию генерация <em>slug</em> учитывается заданная локаль приложения,
    метод <code>locale()</code> позволяет изменить данное поведения для поля.
</x-p>

<x-code language="php">
locale(string $local)
</x-code>

<x-code language="php">
use MoonShine\Fields\Slug;

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->locale('ru') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="unique">Уникальное значение</x-sub-title>

<x-p>
    Если необходимо сохранять только уникальные slug, то необходимо воспользоваться методом <code>unique()</code>.
</x-p>

<x-code language="php">
unique()
</x-code>

<x-code language="php">
use MoonShine\Fields\Slug; // [tl! focus]

//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->unique() // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
