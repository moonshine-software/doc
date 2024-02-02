<x-page title="Switch">

<x-extendby :href="to_page('fields-checkbox')">
    Checkbox
</x-extendby>

<x-p>
    The <em>Switcher</em> field is an extension of <em>Checkbox</em> with a different visual design.
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
