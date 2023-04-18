<x-page title="Spatie\MediaLibrary">

    <x-extendby :href="route('moonshine.custom_page', 'fields-image')">
        Image
    </x-extendby>

    <x-p class="font-bold text-pink">
        The field is placed in a separate package, before use it is necessary to perform the installation
    </x-p>

    <x-code language="shell">
        php composer require visual-ideas/moonshine-spatie-medialibrary
    </x-code>

    <x-p>
        The field is intended for work with the package
        <x-link link="https://github.com/spatie/laravel-medialibrary" target="_blank">Laravel-medialibrary</x-link>
        from
        <x-link link="https://spatie.be/open-source" target="_blank">Spatie</x-link>
    </x-p>

    <x-p>
        Before using the Spatie\MediaLibrary field, make sure that:
    </x-p>

    <x-ul :items="[
'The spatie/laravel-medialibrary package is installed and configured',
'The visual-ideas/moonshine-spatie-medialibrary package is installed',
'The field passed to Spatie\MediaLibrary is added as the name of the collection via ->addMediaCollection(\'Field\')'
]"></x-ul>

    <x-p>
        In the model:
    </x-p>
    <x-code language="php">
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ModelClass extends Model implements HasMedia
    //...
    use InteractsWithMedia;

    //...
    public function registerMediaCollections(): void
    {
        $this ->addMediaCollection('cover');
    }
    //...
    </x-code>

    <x-p>
        In MoonShine-resource:
    </x-p>
    <x-code language="php">
        use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;
        //...
        MediaLibrary::make('Cover', 'cover'),
        //...
    </x-code>

    <x-p>
        By default, the field works in single image mode
    </x-p>
    <x-code language="php">
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ModelClass extends Model implements HasMedia
//...
use InteractsWithMedia;
//...
public function registerMediaCollections(): void
{
    $this ->addMediaCollection('cover')->singleFile();
}
//...
    </x-code>
    <x-p>
        If you want to use a field to load multiple images, add the method ->multiple() to the field declaration
    </x-p>
    <x-code language="php">
//...
MediaLibrary::make('Gallery', 'gallery')->multiple(),
//...
    </x-code>


</x-page>
