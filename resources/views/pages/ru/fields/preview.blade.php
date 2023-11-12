<x-page title="Preview" :sectionMenu="[
    'Разделы' => [
        ['url' => '#make', 'label' => 'Make'],
        ['url' => '#badge', 'label' => 'Badge'],
        ['url' => '#boolean', 'label' => 'Boolean'],
        ['url' => '#link', 'label' => 'Link'],
    ]
]">

<x-moonshine::alert class="mt-8" type="warning" icon="heroicons.information-circle">
    Поле не предназначено для ввода/изменения данных!
</x-moonshine::alert>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    С помощью поля <em>Preview</em> вы можете вывести текстовые данные из любого поля модели,
    либо сгенерировать текст.
</x-p>

<x-code language="php">
use MoonShine\Fields\Preview; // [tl! focus]

//...

public function fields(): array
{
    return [
        Preview::make('Preview', 'preview', static fn() => fake()->realText())  // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/preview_dark.png') }}"></x-image>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    Метод <code>badge()</code> позволяет отобразить поле в виде значка, например для отображения статуса заказа.<br/>
    Метод принимает параметр в виде строки или замыкания с цветом значка.
</x-p>

<x-code language="php">
badge(string|Closure|null $color = null)
</x-code>

@include('pages.ru.ui.shared.colors')

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Status')
            ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="boolean">Boolean</x-sub-title>

<x-p>
    Метод <code>boolean()</code> позволяет отобразить поле в виде метки (зеленой или красной) для boolean значений.
</x-p>

<x-code language="php">
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
</x-code>

<x-p>
    Параметры <code>hideTrue</code> и <code>hideFalse</code> позволяют скрыть метку для значений.
</x-p>

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Active')
            ->boolean(hideTrue: false, hideFalse: false) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="link">Link</x-sub-title>

<x-p>
    Метод <code>link()</code> позволяет отобразить поле в виде ссылки.
</x-p>

<x-code language="php">
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false,
)
</x-code>

<x-p>
    <ul>
        <li><code>$link</code> - url ссылки,</li>
        <li><code>$name</code> - текст ссылки,</li>
        <li><code>$icon</code> - наименовании иконки,</li>
        <li><code>$withoutIcon</code> - не отображать иконку у ссылки,</li>
        <li><code>$blank</code> - открывать ссылку в новой вкладке.</li>
    </ul>
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open" class="my-4">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'appearance-icons') }}">Icons</x-link>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Link')
            ->link('https://moonshine-laravel.com', blank: false), // [tl! focus]
        Preview::make('Link')
            ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Go') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/preview_all.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/preview_all_dark.png') }}"></x-image>

</x-page>
