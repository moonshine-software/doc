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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    To correctly generate the file URL, you must define the environment variable <code>APP_URL</code> in this way,
    to match your app's URL.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    When using the <code>local</code> driver, the return value of <code>url</code> is not URL encoded.
    For this reason, we recommend always storing your files using names that will create valid URLs.
</x-moonshine::alert>

</x-page>
