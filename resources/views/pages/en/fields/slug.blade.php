<x-page
    title="Slug"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#from', 'label' => 'Slug generation'],
            ['url' => '#separator', 'label' => 'Delimiter'],
            ['url' => '#locale', 'label' => 'Locale'],
            ['url' => '#unique', 'label' => 'Unique value'],
            ['url' => '#live', 'label' => 'Live slug'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-moonshine::alert type="info">
    Field depends on Eloquent Model
</x-moonshine::alert>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Using this field you can generate a slug based on the selected field,
    and also store only unique values.
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

<x-sub-title id="from">Slug generation</x-sub-title>

<x-p>
    Using the <code>from()</code> method, you can specify based on which model field to generate a slug,
    if there is no value.
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

<x-sub-title id="separator">Delimiter</x-sub-title>

<x-p>
    By default, <x-moonshine::badge color="gray">-</x-moonshine::badge> is used as a word separator when generating a slug.
    The <code>separator()</code> method allows you to change this value.
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

<x-sub-title id="locale">Locale</x-sub-title>

<x-p>
    By default, <em>slug</em> generation takes into account the specified application locale,
    The <code>locale()</code> method allows you to change this behavior for a field.
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

<x-sub-title id="unique">Unique value</x-sub-title>

<x-p>
    If you need to save only unique slugs, you need to use the <code>unique()</code> method.
</x-p>

<x-code language="php">
unique()
</x-code>

<x-code language="php">
use MoonShine\Fields\Slug;

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

<x-sub-title id="live">Live slug</x-sub-title>

<x-p>
    The <code>live()</code> method allows you to create a live field that will track changes to the original field.
</x-p>

<x-code language="php">
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->reactive(), // [tl! focus]
        Slug::make('Slug')
            ->from('title')
            ->live() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    Lives is based on
    <x-link link="{{ to_page('fields-index') }}#reactive">field reactivity</x-link>.
</x-moonshine::alert>

</x-page>
