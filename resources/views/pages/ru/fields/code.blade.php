<x-page
    title="Код"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#language', 'label' => 'Language'],
            ['url' => '#line-numbers', 'label' => 'Нумерация строк'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-textarea')">
    Textarea
</x-extendby>

<x-p>
    Поле <em>Code</em> является расширением <em>Textarea</em> с визуальным оформлением редактируемого кода.
</x-p>

<x-code language="php">
use MoonShine\Fields\Code; // [tl! focus]

//...

public function fields(): array
{
    return [
        Code::make('Code') // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/code.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/code_dark.png') }}"></x-image>

<x-sub-title id="language">Language</x-sub-title>

<x-p>
    По-умолчанию используется оформление для PHP, но с помощью метода <code>language()</code>
    можно изменить оформление для другого языка программирования.
</x-p>

<x-code language="php">
language(string $language)
</x-code>

<x-p>
    Поддерживаемые языки:
    <x-moonshine::badge color="gray">HTML</x-moonshine::badge>,
    <x-moonshine::badge color="gray">XML</x-moonshine::badge>,
    <x-moonshine::badge color="gray">CSS</x-moonshine::badge>,
    <x-moonshine::badge color="gray">PHP</x-moonshine::badge>,
    <x-moonshine::badge color="gray">JavaScript</x-moonshine::badge>
    и многие другие.
</x-p>

<x-code language="php">
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->language('js') // [tl! focus]
    ];
}
//...
</x-code>

<x-sub-title id="line-numbers">Нумерация строк</x-sub-title>

<x-p>
    Метод <code>lineNumbers()</code> позволяет отобразить нумерацию строк.
</x-p>

<x-code language="php">
lineNumbers()
</x-code>

<x-code language="php">
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->lineNumbers() // [tl! focus]
    ];
}
//...
</x-code>

</x-page>
