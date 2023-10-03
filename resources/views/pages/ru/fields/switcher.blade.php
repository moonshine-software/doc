<x-page title="Переключатель">

<x-extendby :href="route('moonshine.page', 'fields-checkbox')">
    Checkbox
</x-extendby>

<x-p>
    Поле <em>Switcher</em> является расширением <em>Checkbox</em> с другим визуальным оформлением.
</x-p>

<x-code language="php">
use MoonShine\Fields\Switcher; // [tl! focus]

//...

public function fields(): array
{
    return [
        Switcher::make('Publish', 'is_publish') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/switcher.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/switcher_dark.png') }}"></x-image>

</x-page>
