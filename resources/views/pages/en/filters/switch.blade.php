<x-page title="SwitchBooleanFilter">

<x-extendby :href="route('moonshine.custom_page', 'fields-switch')">
    Switch
</x-extendby>

<x-code language="php">
use MoonShine\Filters\SwitchBooleanFilter;

//...

public function filters(): array
{
    return [
        SwitchBooleanFilter::make('Active')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_switch.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_switch_dark.png') }}"></x-image>

</x-page>
