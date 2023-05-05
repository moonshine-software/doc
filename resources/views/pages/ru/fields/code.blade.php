<x-page
    title="Код"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=1798&end=1843', 'title' => 'Screencasts: Поле Code'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-textarea')">
    Textarea
</x-extendby>

<x-p>Редактор кода</x-p>

<x-code language="php">
use MoonShine\Fields\Code;

//...
public function fields(): array
{
    return [
        Code::make('Код', 'code')
            ->language('js')
            ->lineNumbers()
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/code.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/code_dark.png') }}"></x-image>

</x-page>



