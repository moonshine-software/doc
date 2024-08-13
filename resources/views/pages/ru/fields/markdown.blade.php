<x-page
    title="Markdown"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#toolbar', 'label' => 'Toolbar'],
            ['url' => '#options', 'label' => 'Опции'],
            ['url' => '#global-configuration', 'label' => 'Глобальная конфигурация'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <b><em>Markdown</em></b> облегчённый язык разметки, созданный с целью обозначения форматирования в простом тексте, с максимальным сохранением его читаемости человеком.
</x-p>

<x-code language="php">
use MoonShine\Fields\Markdown; // [tl! focus]

//...

public function fields(): array
{
    return [
        Markdown::make('Description') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-image theme="light" src="{{ asset('screenshots/markdown.png') }}"></x-image>
        <x-image theme="dark" src="{{ asset('screenshots/markdown_dark.png') }}"></x-image>
    </x-moonshine::column>
    <x-moonshine::column adaptiveColSpan="12" colSpan="6">
        <x-image theme="light" src="{{ asset('screenshots/markdown_preview.png') }}"></x-image>
        <x-image theme="dark" src="{{ asset('screenshots/markdown_preview_dark.png') }}"></x-image>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="toolbar">Toolbar</x-sub-title>

<x-p>
    Метод <code>toolbar()</code> позволяет изменить toolbar.
</x-p>

<x-code language="php">
toolbar(string|bool|array $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->toolbar(['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule']) // [tl! focus]
</x-code>

<x-sub-title id="options">Опции</x-sub-title>

<x-p>
    Метод <code>addOption()</code> позволяет добавить или изменить опции для markdown-редактора.
</x-p>

<x-code language="php">
addOption(string $name, string|int|float|bool|array $value)
</x-code>

<x-code language="php">
use MoonShine\Fields\Markdown;

//...

Markdown::make('Description')
    ->addOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote', 'horizontal-rule']) // [tl! focus]
</x-code>

<x-sub-title id="global-configuration">Глобальная конфигурация</x-sub-title>

<x-p>
    Если необходимо изменить настройки для редактора глобально,
    можно воспользоваться статическим методом <code>setDefaultOption()</code>.
</x-p>

<x-code language="php">
setDefaultOption(string $name, string|int|float|bool|array $value)
</x-code>

<x-code language="php">
namespace App\Providers;

use MoonShine\Fields\Markdown;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Markdown::setDefaultOption('toolbar',  ['bold', 'italic', 'strikethrough', 'code', 'quote']); // [tl! focus]
    }
}
</x-code>

</x-page>
