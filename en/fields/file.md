# File

- [Basics](#basics)
- [Disk](#disk)
- [Directory](#dir)
- [Allowed Extensions](#allowed-extensions)
- [Multiple Upload](#multiple)
- [File Removal](#removable)
- [Disable Download](#download)
- [Original File Name](#filename)
- [Custom File Name](#customname)
- [Element Names](#name)
- [Sorting with dragging](#reorderable)
- [Element Attributes](#item-attributes)
- [Helper Methods](#helper-methods)

---

<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

> [!TIP]
> Before using, ensure that a symbolic link is set up for the **storage** directory. \
> `php artisan storage:link`

The `File` field is used for file uploads and includes all basic methods.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\File;

File::make('File')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="File">
    <x-moonshine::form.file
        name="file"
    />
</x-moonshine::form.wrapper>
```
~~~

@preview('fields.file')

> [!NOTE]
> To correctly generate the file URL, you must set the environment variable `APP_URL` to match your application's URL.

<a name="disk"></a>
## Disk

The `disk()` method allows you to change the _filesystems disk_.

```php
disk(string $disk)
```

```php
File::make('File')
    ->disk('public')
```

> [!NOTE]
> By default, the _disk_ `public` is used.
> You can change it in the [configuration file](https://moonshine-laravel.com/docs/resource/getting-started/configuration).

> [!NOTE]
> When using the `local` driver, the returned `url` is not a valid URL.
> For this reason, we recommend always naming your files in a way that will create valid URLs.

<a name="dir"></a>
## Directory

By default, files will be saved in the root directory of the disk.
The `dir()` method allows you to specify a directory for saving files relative to the root directory.

```php
dir(string $dir)
```

```php
File::make('File')
    ->dir('docs')
```

<a name="allowed-extensions"></a>
## Allowed Extensions

`File` and `Image` inherit the global `allowed_extensions` list from [configuration](/docs/{{version}}/configuration#allowed-extensions).
By default, the list is empty (`[]`), so extensions are unrestricted.

Use `allowedExtensions()` to replace the global list for an individual field. Specify extensions without a leading dot.

```php
allowedExtensions(array|string $allowedExtensions)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\File;

File::make('Document')
    ->allowedExtensions(['pdf', 'doc', 'txt'])
```

This field accepts its own list even if the global list only allows images. The lists are not merged.
An explicit empty list (`[]`), the string `'*'`, or the array `['*']` allows all extensions and overrides any global restriction.

```php
File::make('Attachment')->allowedExtensions([]);
File::make('Attachment')->allowedExtensions('*');
File::make('Attachment')->allowedExtensions(['*']);
```

The effective list provides the default HTML `accept` attribute and is checked on the server during uploads.
The server checks both the extension detected from the uploaded file's MIME type and the extension of the stored filename,
including names supplied by `keepOriginalFileName()` or `customName()`.

To customize only the browser's file picker, use `accept()` or an explicit `accept` attribute.
This does not change the server-side allowed extensions.

```php
File::make('Document')
    ->allowedExtensions(['pdf'])
    ->accept('application/pdf')
```

> [!NOTE]
> When using `<x-moonshine::form.file>` directly in Blade, set `accept` explicitly and validate uploads in your handler.
> The global setting is applied by the PHP `File` and `Image` fields.

<a name="multiple"></a>
## Multiple Upload

To upload multiple files, use the `multiple()` method.

```php
multiple(Closure|bool|null $condition = null)
```

```php
File::make('File')
    ->multiple()
```

@include('_includes/note-about-multiple-cast')

<a name="removable"></a>
## File Removal

To enable file removal, you need to use the `removable()` method.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

- `$condition` - the condition for executing the method,
- `$attributes` - additional attributes for the button.

```php
File::make('File')
    ->removable()
```

> [!NOTE]
> The delete button will be available in the editing mode of the field.

> [!NOTE]
> When deleting a resource, the files are also deleted.

> [!WARNING]
> When mass deleting resource items, files are not deleted. You need to implement file deletion for mass resource item deletion yourself.

### Attributes

```php
File::make('File')
    ->removable(
        attributes: ['@click.prevent' => '$event.target.closest(`.x-removeable`).remove()']
    )
```

### disableDeleteFiles()

The `disableDeleteFiles()` method allows you to delete only the database record but not the actual file.

```php
disableDeleteFiles()
```

```php
File::make('File')
    ->removable()
    ->disableDeleteFiles()
```

### enableDeleteDir()

The `enableDeleteDir()` method deletes the directory specified in the `dir()` method if it is empty.

```php
enableDeleteDir()
```

```php
File::make('File')
    ->dir('docs')
    ->removable()
    ->enableDeleteDir()
```

<a name="download"></a>
## Disable Download

The `disableDownload()` method allows you to exclude the ability to download the file.

```php
disableDownload(Closure|bool|null $condition = null)
```

```php
File::make('File', 'file')
    ->disableDownload()
```

<a name="filename"></a>
## Original File Name

When uploading, a file name is generated by default. The `keepOriginalFileName()` method allows you to keep the original file name.

```php
keepOriginalFileName()
```

```php
File::make('File')
    ->keepOriginalFileName()
```

<a name="customname"></a>
## Custom File Name

The `customName()` method allows you to save a file with a custom name.

```php
customName(Closure $name)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

File::make('File', 'file')
    ->customName(fn(UploadedFile $file, Field $field) =>  Str::random(10) . '.' . $file->extension())
```

<a name="names"></a>
## Element Names

The `names()` method allows you to change the displayed name without altering the file name.

```php
names(Closure $closure)
```

- `$closure` - a closure that takes the file name and the file index as parameters.

```php
File::make('File', 'file')
    ->names(fn(string $filename, int $index = 0) => 'File ' . $index + 1)
```

<a name="reorderable"></a>
## Sorting with dragging

You can specify a *URL* that will process the positions and save the new ones.

```php
File::make('Files')
    ->reorderable(fn(File $ctx) => "/reorder/" . $ctx->getData()->getKey())
    ->multiple(),
```

<a name="item-attributes"></a>
## Element Attributes

The `itemAttributes()` method allows you to add additional attributes to the elements.

```php
itemAttributes(Closure $closure)
```

- `$closure` - a closure that takes the file name and the file index as parameters.

```php
File::make('File', 'file')
    ->itemAttributes(fn(string $filename, int $index = 0) => [
        'style' => 'width: 250px; height: 250px;'
    ])
```

### Dropzone attributes

```php
File::make('Files')
    ->dropzoneAttributes(fn(File $ctx) => ['class' => 'custom-class'])
    ->multiple(),
```

<a name="helper-methods"></a>
## Helper Methods

### getRemainingValues()

The `getRemainingValues()` method allows you to get the values that remain in the form, taking into account deletions.

```php
getRemainingValues()
```

### removeExcludedFiles()

The `removeExcludedFiles()` method allows you to physically delete files during the process.

```php
removeExcludedFiles()
```
