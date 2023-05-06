<x-page title="File" :sectionMenu="[
    'Sections' => [
        ['url' => '#multiple', 'label' => 'Multiple'],
        ['url' => '#removable', 'label' => 'Removing files'],
        ['url' => '#download', 'label' => 'Disabling download'],
        ['url' => '#filename', 'label' => 'Original filename'],
    ]
]">

<x-p>
    Before using the file field,
    make sure that a symbolic link is set to the storage directory
</x-p>

<x-code language="shell">
    php artisan storage:link
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        // [tl! focus:start]
        File::make('File', 'file')
            ->dir('/') // The directory where the files will be stored in storage (by default /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Allowable extensions
        // [tl! focus:end]
        //...
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/file.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/file_dark.png') }}"></x-image>

<x-sub-title id="multiple">Multiple</x-sub-title>

<x-p>
    The <code>multiple</code> method is used to upload multiple files
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->multiple(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The field in the database must be of text or json type.<br>
    You also need to add cast for eloquent model - json or array or collection.
</x-moonshine::alert>

<x-sub-title id="removable">Removing files</x-sub-title>

<x-p>
    To be able to delete files, you must use the <code>removable</code> method
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->removable(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-sub-title id="download">Disabling download</x-sub-title>

<x-p>
    If you want to protect the file from download, you must use the <code>disableDownload</code> method
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->disableDownload(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-sub-title id="filename">Original filename</x-sub-title>

<x-p>
    If you want to keep the original filename received from the client, use the <code>keepOriginalFileName</code> method
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->keepOriginalFileName(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

</x-page>
