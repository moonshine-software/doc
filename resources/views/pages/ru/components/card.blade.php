<x-page
    title="Компонент Card"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#header', 'label' => 'Header'],
            ['url' => '#actions', 'label' => 'Кнопки'],
            ['url' => '#subtitle', 'label' => 'Подзаголовок'],
            ['url' => '#url', 'label' => 'Ссылка'],
            ['url' => '#thumbnail', 'label' => 'Изображения'],
            ['url' => '#values', 'label' => 'Список значений'],
            ['url' => '#overlay', 'label' => 'Режим overlay'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Card</em> позволяет создавать карточки элементов.
</x-p>

<x-p>
    Создать <em>Card</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Card</code>.
</x-p>

<x-code language="php">
make(
    Closure|string $title = '',
    Closure|string|array $thumbnail = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null
)
</x-code>

<x-ul>
    <li><code>$title</code> - заголовок карточки,</li>
    <li><code>$thumbnail</code> - изображения,</li>
    <li><code>$url</code> - ссылка,</li>
    <li><code>$values</code> - список значений,</li>
    <li><code>$subtitle</code> - подзаголовок.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Card; // [tl! focus]

//...

public function components(): array
{
    return [
        Card::make(
            title: fake()->sentence(3),
            thumbnail: '/images/image_1.jpg',
            url: fn() => 'https://cutcode.dev',
            values: ['ID' => 1, 'Author' => fake()->name()],
            subtitle: date('d.m.Y')
        ) // [tl! focus:-6]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
        url: fn() => 'https://cutcode.dev',
        values: ['ID' => 1, 'Author' => fake()->name()],
        subtitle: date('d.m.Y')
    )
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="header">Header</x-sub-title>

<x-p>
    Метод <code>header()</code> позволяет задать шапку у карточек.
</x-p>

<x-code language="php">
header(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> или замыкание возвращающее <em>html</em> код.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->header(static fn() => Badge::make('new', 'success')) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
    )
        ->header(static fn() => \MoonShine\Components\Badge::make('new', 'success'))
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="actions">Кнопки</x-sub-title>

<x-p>
    Для добавления кнопок в карточку можно воспользоваться методом <code>actions()</code>.
</x-p>

<x-code language="php">
actions(Closure|string $value)
</x-code>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->actions(
        static fn() => ActionButton::make('Edit', route('name.edit'))
    ) // [tl! focus:-4]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->actions(
            static fn() => \MoonShine\ActionButtons\ActionButton::make('Edit', route('async'))
        )
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="subtitle">Подзаголовок</x-sub-title>

<x-code language="php">
subtitle(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> или замыкание возвращающее подзаголовок.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->subtitle(static fn() => 'Subtitle') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
    )
        ->subtitle(static fn() => 'Subtitle')
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="url">Ссылка</x-sub-title>

<x-p>
    Метод <code>url()</code> позволяет задать ссылку для заголовка карточки.
</x-p>

<x-code language="php">
url(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> или замыкание.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->url(static fn() => 'https://cutcode.dev')
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="thumbnail">Изображения</x-sub-title>

<x-p>
    Для добавления к карточке карусели изображений можно воспользоваться методом <code>thumbnail()</code>.
</x-p>

<x-code language="php">
thumbnail(Closure|string|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> изображения, или массив <em>url-ов</em> изображений, или замыкание.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
)
    ->thumbnails(['/images/image_2.jpg','/images/image_1.jpg']) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Card::make(
                title: fake()->sentence(3),
            )
                ->thumbnail(['/images/image_2.jpg','/images/image_1.jpg'])
        !!}
    </x-moonshine::column>
</x-moonshine::grid>


<x-sub-title id="thumbnails">Изображения</x-sub-title>

<x-p>
    Для добавления к карточке карусели изображений можно воспользоваться методом <code>thumbnails()</code>.
</x-p>

<x-code language="php">
    thumbnails(Closure|string|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> изображения, или массив <em>url-ов</em>  изображений, или замыкание.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
)
->thumbnails(['/images/image_2.jpg','/images/image_1.jpg']) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Card::make(
                title: fake()->sentence(3),
            )
                ->thumbnails(['/images/image_2.jpg','/images/image_1.jpg'])
        !!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="values">Список значений</x-sub-title>

<x-p>
    Для добавления к карточке списка значений можно воспользоваться методом <code>values()</code>.
</x-p>

<x-code language="php">
    values(Closure|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - ассоциативный массив значений или замыкание.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->values([
        'ID' => 1,
        'Author' => fake()->name()
    ]) // [tl! focus:-3]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->values([
            'ID' => 1,
            'Author' => fake()->name()
        ])
!!}
    </x-moonshine::column>
</x-moonshine::grid>


<x-sub-title id="overlay">Режим overlay</x-sub-title>

<x-p>
    Режим <em>overlay</em> позволяет разместить шапку и заголовки поверх изображения карточки.<br/>
    Данный режим активируется одноименным методом <code>overlay()</code>.
</x-p>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
    url: fn() => 'https://cutcode.dev',
    values: ['ID' => 1, 'Author' => fake()->name()],
    subtitle: date('d.m.Y')
)
    ->header(static fn() => Badge::make('new', 'success'))
    ->overlay() // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
        url: fn() => 'https://cutcode.dev',
        values: ['ID' => 1, 'Author' => fake()->name()],
        subtitle: date('d.m.Y')
    )
        ->header(static fn() => \MoonShine\Components\Badge::make('new', 'success'))
        ->overlay()
!!}
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
