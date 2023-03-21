<x-page title="Изображение">

<x-p>
    Прежде чем использовать файловое поле, необходимо убедиться что на директорию storage
    установлена символическая ссылка
</x-p>

<x-code language="shell">
php artisan storage:link
</x-code>

<x-code language="php">
use Leeto\MoonShine\Fields\Image;

//...

public function fields(): array
{
    return [
        // [tl! focus:start]
        Image::make('Аватар', 'avatar')
            ->dir('/') // Директория где будут хранится файлы в storage (по умолчанию /)
            ->disk('public') // filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Допустимые расширения
        // [tl! focus:end]
    ];
}

//...
</x-code>

<x-p>
    Для загрузки нескольких файлов используется метод <code>multiple</code>
</x-p>

<x-code language="php">
Image::make('Аватар', 'avatar')
    ->multiple()
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поле в базе необходимо типа text или json<br>.
    Также необходимо добавить cast для eloquent модели - json или array или collection.
</x-moonshine::alert>

<x-p>
    При множественной загрузке файлов, для возможности их удаления в последующем, необходимо воспользоваться методом <code>removable</code>
</x-p>

<x-code language="php">
Image::make('Аватар', 'avatar')
    ->multiple()
    ->removable() // [tl! focus]
</x-code>

<x-p>
    Если необходимо исключить возможность скачивания файла воспользуйтесь методом <code>disableDownload</code>
</x-p>

<x-code language="php">
Image::make('Аватар', 'avatar')
    ->disableDownload() // [tl! focus]
</x-code>

<x-p>
    Если необходимо сохранять оригинальное имя файла от клиента воспользуйтесь методом <code>keepOriginalFileName</code>
</x-p>

<x-code language="php">
Image::make('Аватар', 'avatar')
    ->keepOriginalFileName() // [tl! focus]
</x-code>

</x-page>
