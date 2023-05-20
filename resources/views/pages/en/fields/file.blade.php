<x-page
    title="File"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#multiple', 'label' => 'Multiple'],
            ['url' => '#removable', 'label' => 'Removing files'],
            ['url' => '#download', 'label' => 'Disabling download'],
            ['url' => '#filename', 'label' => 'Original filename'],
            ['url' => '#customname', 'label' => 'Custom filename']
        ]
    ]"
>

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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    To correctly generate the file URL, you must define the environment variable <code>APP_URL</code> in this way,
    to match your app's URL.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    When using the <code>local</code> driver, the return value of <code>url</code> is not URL encoded.
    For this reason, we recommend always storing your files using names that will create valid URLs.
</x-moonshine::alert>

<x-sub-title id="multiple">Multiple</x-sub-title>

<x-p>
    The <code>multiple()</code> method is used to upload multiple files
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
    To be able to delete files, you must use the <code>removable()</code> method
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

<x-p>
    The <code>disableDeleteFiles()</code> method will allow you to delete only the record in the database,
    but not delete the file itself
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->removable()
            ->disableDeleteFiles(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-p>
    The <code>isDeleteDir()</code> method deletes the directory specified in the <code>dir()</code> method if it is empty
</x-p>

<x-code language="php">
use MoonShine\Fields\File;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->dir('/images/')
            ->removable()
            ->isDeleteDir(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-sub-title id="download">Disabling download</x-sub-title>

<x-p>
    If you want to protect the file from download, you must use the <code>disableDownload()</code> method
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
    If you want to keep the original filename received from the client, use the <code>keepOriginalFileName()</code> method
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

<x-sub-title id="customname">Custom file name</x-sub-title>

<x-p>
    If you need to save a custom file name, use the method <code>customName('file_name'))</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

//...
public function fields(): array
{
    return [
        //...
        File::make('File', 'file')
            ->customName(fn(UploadedFile $file) =>  Str::random(10) . '.' . $file->extension()), // [tl! focus]
        //...
    ];
}
//...
</x-code>

</x-page>
