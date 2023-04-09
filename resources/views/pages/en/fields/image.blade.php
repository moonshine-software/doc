<x-page title="Image">

<x-extendby :href="route('moonshine.custom_page', 'fields-file')">
    File
</x-extendby>

<x-p>
    Before using the file field, make sure that a symbolic link is set to the storage directory
</x-p>

<x-code language="shell">
php artisan storage:link
</x-code>

<x-code language="php">
use MoonShine\Fields\Image;

//...

public function fields(): array
{
    return [
        // [tl! focus:start]
        Image::make('Avatar', 'avatar')
            ->dir('/') // The directory where the files will be stored in storage (by default /)
            ->disk('public') // filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Allowable extensions
        // [tl! focus:end]
    ];
}

//...
</x-code>

<x-p>
    The <code>multiple</code> method is used to upload multiple files.
</x-p>

<x-code language="php">
Image::make('Avatar', 'avatar')
    ->multiple()
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The field in the database must be of type text or json<br>.
    You also need to add cast for eloquent model - json or array or collection.
</x-moonshine::alert>

<x-p>
    If you download multiple files, you must use the <code>removable</code> method to be able to delete them later
</x-p>

<x-code language="php">
Image::make('Avatar', 'avatar')
    ->multiple()
    ->removable() // [tl! focus]
</x-code>

<x-p>
    If you want to exclude the possibility of downloading a file, use the method <code>disableDownload</code>.
</x-p>

<x-code language="php">
Image::make('Avatar', 'avatar')
    ->disableDownload() // [tl! focus]
</x-code>

<x-p>
    If you want to keep the original file name from the client, use the <code>keepOriginalFileName</code> method
</x-p>

<x-code language="php">
Image::make('Avatar', 'avatar')
    ->keepOriginalFileName() // [tl! focus]
</x-code>

</x-page>
