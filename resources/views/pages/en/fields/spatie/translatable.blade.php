<x-page title="Spatie\Translatable" :sectionMenu="[
    'Sections' => [
        ['url' => '#fields', 'label' => 'With a set of fields'],
        ['url' => '#required', 'label' => 'Mandatory translations'],
        ['url' => '#priority', 'label' => 'Recommended translations'],
    ]
]">

<x-extendby :href="route('moonshine.page', 'fields-json')">
    Json
</x-extendby>

<x-p class="font-bold text-pink">
    This field belongs to a separate package, you have to complete the installation before using it
</x-p>

<x-code language="shell">
    composer require visual-ideas/moonshine-spatie-translatable
</x-code>

<x-p>
    The field is purposed for work with the
    <x-link link="https://github.com/spatie/laravel-translatable" target="_blank">Laravel-translatable</x-link>
    package made by
    <x-link link="https://spatie.be/open-source" target="_blank">Spatie</x-link>
</x-p>

<x-p>
    Before using the Spatie\Translatable field, make sure that:
</x-p>

<x-ul :items="[
'The spatie/laravel-translatable package is installed and configured',
'The field passed to the Spatie\Translatable is added to the $translatable array of the model'
]"></x-ul>

<x-code language="php">
use VI\MoonShineSpatieTranslatable\Fields\Translatable;
//...
Translatable::make('Title', 'name')
//...
</x-code>

<x-sub-title id="required">Mandatory translations</x-sub-title>

<x-p>
    The ->requiredLanguages(array $languages) method is used to specify the languages required by the validator for creating/saving a record.
</x-p>

<x-p>
    It is recommended to pass the config('app.fallback_locale') value to this method
</x-p>


<x-code language="php">
use VI\MoonShineSpatieTranslatable\Fields\Translatable;
//...
Translatable::make('Title', 'name')
    ->requiredLanguages([config('app.fallback_locale'), 'ru'])
//...
</x-code>

<x-sub-title id="priority">Recommended translations</x-sub-title>

<x-p>
    If you specify this array, the language codes in the forms for adding/modifying a specific translation will be placed at the beginning of the list of all possible languages.
</x-p>

<x-code language="php">
use VI\MoonShineSpatieTranslatable\Fields\Translatable;
//...
Translatable::make('Title', 'name')
    ->priorityLanguages([config('app.fallback_locale'), config('app.locale'), 'de', 'fr', 'uk'])
//...
</x-code>

<x-sub-title id="removable">Deleting</x-sub-title>

<x-p>
    You can delete specific translations from out of the entered ones
</x-p>

<x-code language="php">
Translatable::make('Field', 'field')
    ->removable() // [tl! focus]
</x-code>

<x-p>
    If you leave the translation text blank, it will be deleted!
</x-p>

<x-p>
    If there are two translations into the same language, the translation that comes first will be deleted (replaced)!
</x-p>

</x-page>



