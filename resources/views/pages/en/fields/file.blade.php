<x-page
    title="File"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#disk', 'label' => 'Disk'],
            ['url' => '#dir', 'label' => 'Directory'],
            ['url' => '#allowed-extensions', 'label' => 'Valid extensions'],
            ['url' => '#multiple', 'label' => 'Multiload'],
            ['url' => '#removable', 'label' => 'Deleting files'],
            ['url' => '#download', 'label' => 'Ban on downloading'],
            ['url' => '#filename', 'label' => 'Original file name'],
            ['url' => '#customname', 'label' => 'Custom file name'],
            ['url' => '#names', 'label' => 'Element names'],
            ['url' => '#item-attributes', 'label' => 'Item attributes'],
            ['url' => '#helper-methods', 'label' => 'Helper methods'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-moonshine::alert type="info" class="mt-8" icon="heroicons.information-circle">
    Before use, you must make sure that the <strong>storage</strong> directory
    a symbolic link has been set.<br />
    <code>php artisan storage:link</code>
</x-moonshine::alert>

<x-p>
    The <em>File</em> field is used to upload files and includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\File; // [tl! focus]

//...

public function fields(): array
{
    return [
        File::make('File') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/file.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/file_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    To generate the file URL correctly, you must define the <code>APP_URL</code> environment variable in this way,
    so that it matches your application's URL.
</x-moonshine::alert>

<x-sub-title id="disk">Disk</x-sub-title>

<x-p>
    The <code>disk()</code> method allows you to change the <em>filesystems disk</em>.
</x-p>

<x-code language="php">
disk(string $disk)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->disk('public') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    The default is <em>disk</em> <code>public</code>.<br />
    You can change it in the file
    <x-link :link="to_page('configuration')">
         configurations
    </x-link>.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    When using the <code>local</code> driver, the <code>url</code> value returned is not a URL.
    For this reason, we recommend that you always store your files with names that will create valid URLs.
</x-moonshine::alert>

<x-sub-title id="dir">Directory</x-sub-title>

<x-p>
    By default, files will be saved in the root directory of the disk.<br />
    The <code>dir()</code> method allows you to specify the directory to save files relative to the root directory.
</x-p>

<x-code language="php">
dir(string $dir)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->dir('docs') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="allowed-extensions">Valid extensions</x-sub-title>

<x-p>
    Using the <code>allowedExtensions()</code> method you can specify which files will be available for download.
</x-p>

<x-code language="php">
allowedExtensions(array $allowedExtensions)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->allowedExtensions(['pdf', 'doc', 'txt']) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="multiple">Multiload</x-sub-title>

<x-p>
    To load multiple files, use the <code>multiple()</code> method.
</x-p>

<x-code language="php">
multiple(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        //...
        File::make('File')
            ->multiple(), // [tl! focus]
        //...
    ];
}

//...
</x-code>

<x-moonshine::alert type="error" icon="heroicons.information-circle">
    The field in the database must be of <em>text</em> or <em>json</em> type.<br>
    You also need to add a cast for the eloquent model - <em>json</em>, or <em>array</em>, or <em>collection</em>.
</x-moonshine::alert>

<x-sub-title id="removable">Deleting files</x-sub-title>

<x-p>
    To be able to delete files, you must use the <code>removable()</code> method.
</x-p>

<x-code language="php">
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
</x-code>

<x-ul>
    <li><code>$condition</code> - condition for executing the method,</li>
    <li><code>$attributes</code> - additional button attributes.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="Attributes" />

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable(
                attributes: ['@click.prevent' => '$event.target.closest(`.x-removeable`).remove()']
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::divider label="disableDeleteFiles()" />

<x-p>
    The <code>disableDeleteFiles()</code> method will allow you to delete only a record in the database,
    but do not delete the file itself.
</x-p>

<x-code language="php">
disableDeleteFiles()
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable()
            ->disableDeleteFiles() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="enableDeleteDir()" />

<x-p>
    The <code>enableDeleteDir()</code> method deletes the directory specified in the <code>dir()</code> method if it is empty.
</x-p>

<x-code language="php">
enableDeleteDir()
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->dir('docs')
            ->removable()
            ->enableDeleteDir() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="download">Ban on downloading</x-sub-title>

<x-p>
    The <code>disableDownload()</code> method allows you to exclude the possibility of downloading a file.
</x-p>

<x-code language="php">
disableDownload(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->disableDownload() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="filename">Original file name</x-sub-title>

<x-p>
    When loading, a file name is generated by default.
    The <code>keepOriginalFileName()</code> method allows you to save the file with the original name.
</x-p>

<x-code language="php">
keepOriginalFileName()
</x-code>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->keepOriginalFileName() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="customname">Custom file name</x-sub-title>

<x-p>
    The <code>customName()</code> method allows you to save a file with a custom name.
</x-p>

<x-code language="php">
customName(Closure $name)
</x-code>

<x-code language="php">
use MoonShine\Fields\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->customName(fn(UploadedFile $file, Field $field) =>  Str::random(10) . '.' . $file->extension()) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="names">Element names</x-sub-title>

<x-p>
    The <code>names()</code> method allows you to change the display name without changing the file name.
</x-p>

<x-code language="php">
names(Closure $closure)
</x-code>

<x-ul>
    <li><code>$closure</code> - the closure takes the file name and file index.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->names(fn(string $filename, int $index = 0) => 'File ' . $index + 1) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="item-attributes">Item attributes</x-sub-title>

<x-p>
    The <code>itemAttributes()</code> method allows you to add additional attributes to elements.
</x-p>

<x-code language="php">
itemAttributes(Closure $closure)
</x-code>

<x-ul>
    <li><code>$closure</code> - the closure takes the file name and file index.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->itemAttributes(fn(string $filename, int $index = 0) => [
                'style' => 'width: 250px; height: 250px;'
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="helper-methods">Helper methods</x-sub-title>

<x-moonshine::divider label="getRemainingValues()" />

<x-p>
    The <code>getRemainingValues()</code> method allows you to get the values that remained in the form,
    taking into account the deletion.
</x-p>

<x-code language="php">
getRemainingValues()
</x-code>

<x-moonshine::divider label="removeExcludedFiles()" />

<x-p>
    The <code>removeExcludedFiles()</code> method allows you to physically remove files during the process.
</x-p>

<x-code language="php">
removeExcludedFiles()
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Recipe: <x-link link="{{ to_page('recipes') }}#images-in-linked-table">saving images</x-link>
    in the linked table.
</x-moonshine::alert>

</x-page>
