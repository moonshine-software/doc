<x-page title="Image">

<x-extendby :href="route('moonshine.custom_page', 'fields-file')">
    File
</x-extendby>

<x-p>
    Everything is the same as <code>File</code>, only the display changes
</x-p>

<x-code language="php">
use MoonShine\Fields\Image;

//...
public function fields(): array
{
    return [
        //... [tl! focus:start]
        Image::make('Thumbnail', 'thumbnail')
            ->dir('/') // The directory where the files will be stored in storage (by default /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Allowable extensions
        //... [tl! focus:end]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/image_dark.png') }}"></x-image>

</x-page>
