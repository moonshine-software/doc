<x-page
    title="Изображение"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=482&end=713', 'title' => 'Screencasts: Поле Image'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-file')">
    File
</x-extendby>

<x-p>
    Все то же самое как и <code>File</code>, меняется только отображение
</x-p>

<x-code language="php">
use MoonShine\Fields\Image;

//...
public function fields(): array
{
    return [
        //... [tl! focus:start]
        Image::make('Thumbnail', 'thumbnail')
            ->dir('/') // Директория где будут хранится файлы в storage (по умолчанию /)
            ->disk('public') // Filesystems disk
            ->allowedExtensions(['jpg', 'gif', 'png']) // Допустимые расширения
        //... [tl! focus:end]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/image_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для правильной генерации URL-адреса файла вы должны определить переменную окружения <code>APP_URL</code> таким образом,
    чтобы она соответствовала URL-адресу вашего приложения.
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    При использовании драйвера <code>local</code> возвращаемое значение <code>url</code> не представляет собой URL-адрес.
    По этой причине мы рекомендуем всегда хранить ваши файлы с именами, которые будут создавать действительные URL-адреса.
</x-moonshine::alert>

</x-page>
