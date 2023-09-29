<x-page title="Phone">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Everything is the same as the "Text field", the only difference is input type = tel
</x-p>

<x-code language="php">
use MoonShine\Fields\Phone;

Phone::make('Phone', 'tel')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">To mask the telephone number, use the mask('7 999 999-99-99') method</x-moonshine::alert>

</x-page>
