<x-page
    title="Файл"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#multiple', 'label' => 'Мультизагрузка'],
            ['url' => '#removable', 'label' => 'Удаление файлов'],
            ['url' => '#download', 'label' => 'Запрет на скачивание'],
            ['url' => '#filename', 'label' => 'Оригинальное имя файла'],
            ['url' => '#customname', 'label' => 'Произвольное имя файла'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=1429&end=1604', 'title' => 'Screencasts: Поле File'],
    ]"
>

<x-p>
    Прежде чем использовать файловое поле необходимо убедиться, что на директорию storage
    установлена символическая ссылка
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
            ->dir('/') // Директория где будут хранится файлы в storage (по умолчанию /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Допустимые расширения
        // [tl! focus:end]
        //...
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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    При использовании драйвера <code>local</code> возвращаемое значение <code>url</code> не представляет собой URL-адрес.
    По этой причине мы рекомендуем всегда хранить ваши файлы с именами, которые будут создавать действительные URL-адреса.
</x-moonshine::alert>

<x-sub-title id="multiple">Мультизагрузка</x-sub-title>

<x-p>
    Для загрузки нескольких файлов используется метод <code>multiple()</code>
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
    Поле в базе необходимо типа text или json.<br>
    Также необходимо добавить cast для eloquent модели - json, или array, или collection.
</x-moonshine::alert>

<x-sub-title id="removable">Удаление файлов</x-sub-title>

<x-p>
    Для возможности удаления файлов необходимо воспользоваться методом <code>removable()</code>
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
    Метод <code>disableDeleteFiles()</code> позволят удалить только запись в базе данных,
    но не удалять сам файл
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
    Метод <code>enableDeleteDir()</code> удаляет директорию указанную в методе <code>dir()</code>, если она пуста
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
            ->enableDeleteDir(), // [tl! focus]
        //...
    ];
}
//...
</x-code>

<x-sub-title id="download">Запрет на скачивание</x-sub-title>

<x-p>
    Если необходимо исключить возможность скачивания файла воспользуйтесь методом <code>disableDownload()</code>
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

<x-sub-title id="filename">Оригинальное имя файла</x-sub-title>

<x-p>
    Если необходимо сохранять оригинальное имя файла от клиента воспользуйтесь методом <code>keepOriginalFileName()</code>
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

<x-sub-title id="customname">Произвольное имя файла</x-sub-title>

<x-p>
    Если необходимо сохранять произвольное имя файла воспользуйтесь методом <code>customName('file_name'))</code>
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
