<x-page
    title="Текстовое поле"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#default', 'label' => 'Значение по умолчанию'],
            ['url' => '#readonly', 'label' => 'Только для чтения'],
            ['url' => '#mask', 'label' => 'Маска'],
            ['url' => '#extensions', 'label' => 'Расширения'],
        ]
    ]"
>

<x-p>
    Текстовое поле включает в себя все базовые методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Title')  // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/input_dark.png') }}"></x-image>

<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Можно воспользоваться методом <code>default()</code>, если необходимо указать значение по умолчанию для поля.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->default('-') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="readonly">Только для чтения</x-sub-title>

<x-p>
    Если поле доступно только для чтения, то необходимо воспользоваться методом <code>readonly()</code>.
</x-p>

<x-code language="php">
readonly(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->readonly() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="mask">Маска</x-sub-title>

<x-p>
    Метод <code>mask()</code> служит для добавления маски у поля.
</x-p>

<x-code language="php">
mask(string $mask)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->mask('7 (999) 999-99-99') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/mask.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/mask_dark.png') }}"></x-image>

<x-sub-title id="extensions">Расширения</x-sub-title>

<x-p>Для поля <em>Text</em> доступно несколько расширений:</x-p>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> возможность скопировать значение по кнопке</x-p>

<x-code language="php">
copy()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> замок с блокировкой изменений</x-p>

<x-code language="php">
locked()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> отключение отображения значения</x-p>

<x-code language="php">
eye()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> подсказка формата</x-p>

<x-code language="php">
expansion(string $ext)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy() // [tl! focus]
            ->locked() // [tl! focus]
            ->expansion('kg') // [tl! focus]
            ->eye() // [tl! focus]
        ];
    }

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/expansion.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/expansion_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Метод <code>copy</code> использует <code>Clipboard API</code> который доступен только для HTTPS или localhost
</x-moonshine::alert>

<x-p>
    Вы можете использоваться кастомные расширения,
    для этого их необходимо добавить полю через метод <code>extension()</code>.
</x-p>

<x-code language="php">
extension(InputExtension $extension)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->extension(new InputCustomExtension()) // [tl! focus]
        ];
    }

//...
</x-code>

</x-page>
