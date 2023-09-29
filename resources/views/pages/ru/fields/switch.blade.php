<x-page title="Переключатель">

<x-extendby :href="route('moonshine.page', 'fields-checkbox')">
    Checkbox
</x-extendby>

<x-p>
    Поле <em>Switch</em> является расширением <em>Checkbox</em> с другим визуальным оформлением.
</x-p>

<x-code language="php">
use MoonShine\Fields\Switch; // [tl! focus]

//...

public function fields(): array
{
    return [
        Switch::make('Publish', 'is_publish') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/switch.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/switch_dark.png') }}"></x-image>

</x-page>
