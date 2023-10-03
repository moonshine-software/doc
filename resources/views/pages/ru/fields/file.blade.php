<x-page
    title="Файл"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#disk', 'label' => 'Disk'],
            ['url' => '#dir', 'label' => 'Директория'],
            ['url' => '#allowed-extensions', 'label' => 'Допустимые расширения'],
            ['url' => '#multiple', 'label' => 'Мультизагрузка'],
            ['url' => '#removable', 'label' => 'Удаление файлов'],
            ['url' => '#download', 'label' => 'Запрет на скачивание'],
            ['url' => '#filename', 'label' => 'Оригинальное имя файла'],
            ['url' => '#customname', 'label' => 'Произвольное имя файла'],
        ]
    ]"
>

<x-moonshine::alert type="info" class="mt-8" icon="heroicons.information-circle">
    Перед использованием необходимо убедиться, что на директорию <strong>storage</strong>
    установлена символическая ссылка.<br />
    <code>php artisan storage:link</code>
</x-moonshine::alert>

<x-p>
    Поле <em>File</em> используется для загрузки файлов и включает в себя все базовые методы.
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
    Для правильной генерации URL-адреса файла вы должны определить переменную окружения <code>APP_URL</code> таким образом,
    чтобы она соответствовала URL-адресу вашего приложения.
</x-moonshine::alert>

<x-sub-title id="disk">Disk</x-sub-title>

<x-p>
    Метод <code>disk()</code> позволяет изменить <em>filesystems disk</em>.
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
    По умолчанию используется <em>disk</em> <code>public</code>.<br />
    Вы можете изменить его в файле
    <x-link :link="route('moonshine.page', 'resources-configuration')">
        конфигурации
    </x-link>.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    При использовании драйвера <code>local</code> возвращаемое значение <code>url</code> не представляет собой URL-адрес.
    По этой причине мы рекомендуем всегда хранить ваши файлы с именами, которые будут создавать действительные URL-адреса.
</x-moonshine::alert>

<x-sub-title id="dir">Директория</x-sub-title>

<x-p>
    По умолчанию файлы будут сохраняться в корневой директории диска.<br />
    Метод <code>dir()</code> позволяет указать директорию для сохранения файлов относительно корневой директории.
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

<x-sub-title id="allowed-extensions">Допустимые расширения</x-sub-title>

<x-p>
    Используя метод <code>allowedExtensions()</code> можно указать какие файлы будут доступны для загрузки.
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

<x-sub-title id="multiple">Мультизагрузка</x-sub-title>

<x-p>
    Для загрузки нескольких файлов используется метод <code>multiple()</code>.
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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поле в базе необходимо типа text или json.<br>
    Также необходимо добавить cast для eloquent модели - json, или array, или collection.
</x-moonshine::alert>

<x-sub-title id="removable">Удаление файлов</x-sub-title>

<x-p>
    Для возможности удаления файлов необходимо воспользоваться методом <code>removable()</code>.
</x-p>

<x-code language="php">
removable()
</x-code>

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

<x-p>
    Метод <code>disableDeleteFiles()</code> позволят удалить только запись в базе данных,
    но не удалять сам файл.
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

<x-p>
    Метод <code>enableDeleteDir()</code> удаляет директорию указанную в методе <code>dir()</code>, если она пуста.
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

<x-sub-title id="download">Запрет на скачивание</x-sub-title>

<x-p>
    Метод <code>disableDownload()</code> позволяет исключить возможность скачивания файла.
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

<x-sub-title id="filename">Оригинальное имя файла</x-sub-title>

<x-p>
    При загрузке по умолчанию генерируется имя файла.
    Метод <code>keepOriginalFileName()</code> позволяет сохранить файл с оригинальным именем.
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

<x-sub-title id="customname">Произвольное имя файла</x-sub-title>

<x-p>
    Метод <code>customName()</code> позволяет сохранить файл с произвольным именем.
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
            ->customName(fn(UploadedFile $file) =>  Str::random(10) . '.' . $file->extension()) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
