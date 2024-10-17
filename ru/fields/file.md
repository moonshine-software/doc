# File
  - [Основы](#basics)  
  - [Диск](#disk)  
  - [Директория](#dir)  
  - [Допустимые расширения](#allowed-extensions)  
  - [Мультизагрузка](#multiple)  
  - [Удаление файлов](#removable)  
  - [Запрет на скачивание](#download)
  - [Оригинальное имя файла](#filename)
  - [Пользовательское имя файла](#customname)
  - [Имена элементов](#name)
  - [Атрибуты элемента](#item-attributes)
  - [Вспомогательные методы](#helper-methods)

---

<a name="basics"></a>
### Основы

> [!TIP]
> Перед использованием необходимо убедиться, что для директории **storage** установлена символическая ссылка.  
> `php artisan storage:link`

Поле _File_ используется для загрузки файлов и включает все базовые методы.

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
    ];
}

//...
```

![File Dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/file_dark.png)

> [!NOTE]
> Чтобы корректно генерировать URL файла, необходимо определить переменную окружения `APP_URL` таким образом, чтобы она соответствовала URL вашего приложения.

<a name="disk"></a>
### Диск

Метод `disk()` позволяет изменить _диск файловой системы_.

```php
disk(string $disk)
```

```php
use MoonShine\Fields\File;
 
//...
 
public function fields(): array
{
    return [
        File::make('File')
            ->disk('public') 
    ];
}
 
//...
```

> [!NOTE]
> По умолчанию используется диск `public`. Вы можете изменить его в файле [конфигурации](https://moonshine-laravel.com/docs/resource/getting-started/configuration).

> [!NOTE] 
> При использовании драйвера `local` возвращаемое значение `url` не является URL. По этой причине мы рекомендуем всегда хранить ваши файлы с именами, которые будут создавать допустимые URL.

<a name="dir"></a>
### Директория

По умолчанию файлы будут сохраняться в корневой директории диска.
Метод `dir()` позволяет указать директорию для сохранения файлов относительно корневой директории.

```php
dir(string $dir)
```

```php
use MoonShine\Fields\File;
 
//...
 
public function fields(): array
{
    return [
        File::make('File')
            ->dir('docs') 
    ];
}
 
//...
```

<a name="allowed-extensions"></a>
### Допустимые расширения

Используя метод `allowedExtensions()`, вы можете указать, какие файлы будут доступны для загрузки.

```php
allowedExtensions(array $allowedExtensions)
```

```php
use MoonShine\Fields\File;
 
//...
 
public function fields(): array
{
    return [
        File::make('File')
            ->allowedExtensions(['pdf', 'doc', 'txt']) 
    ];
}
 
//...
```

<a name="multiple"></a>
### Мультизагрузка

Для загрузки нескольких файлов используйте метод `multiple()`.

```php
multiple(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\File;
 
//...
 
public function fields(): array
{
    return [
        //...
        File::make('File')
            ->multiple(), 
        //...
    ];
}
 
//...
```

> [!ERROR]
> Поле в базе данных должно быть типа _text_ или _json_.
> Также необходимо добавить приведение типа для eloquent модели - *json*, или *array*, или *collection*.

<a name="removable"></a>
### Удаление файлов
Чтобы иметь возможность удалять файлы, необходимо использовать метод `removable()`.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

-`$condition` - условие для выполнения метода
-`$attributes` - дополнительные атрибуты кнопки

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable()
    ];
}

//...
```

### Атрибуты

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable(
                attributes: ['@click.prevent' => '$event.target.closest(`.x-removeable`).remove()']
            )
    ];
}

//...
```
### disableDeleteFiles()
Метод `disableDeleteFiles()` позволит удалить только запись в базе данных, но не удалять сам файл.

```php
disableDeleteFiles()
```
```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->removable()
            ->disableDeleteFiles()
    ];
}

//...
```

### enableDeleteDir()
Метод `enableDeleteDir()` удаляет директорию, указанную в методе `dir()`, если она пуста.

```php
enableDeleteDir()
```

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->dir('docs')
            ->removable()
            ->enableDeleteDir()
    ];
}

//...
```

<a name="download"></a>
### Запрет на скачивание
Метод `disableDownload()` позволяет исключить возможность скачивания файла.

```php
disableDownload(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->disableDownload()
    ];
}

//...
```

<a name="filename"></a>
### Оригинальное имя файла

По умолчанию при загрузке генерируется имя файла. Метод `keepOriginalFileName()` позволяет сохранить файл с оригинальным именем.

```php
keepOriginalFileName()
```

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File')
            ->keepOriginalFileName()
    ];
}

//...
```

<a name="customname"></a>
### Пользовательское имя файла

Метод `customName()` позволяет сохранить файл с пользовательским именем.

```php
customName(Closure $name)
```

```php
use MoonShine\Fields\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->customName(fn(UploadedFile $file, Field $field) =>  Str::random(10) . '.' . $file->extension())
    ];
}

//...
```

<a name="names"></a>
### Имена элементов
Метод `names()` позволяет изменить отображаемое имя без изменения имени файла.

```php 
names(Closure $closure)
```

- `$closure` - замыкание принимает имя файла и индекс файла.

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->names(fn(string $filename, int $index = 0) => 'File ' . $index + 1)
    ];
}

//...
```

<a name="item-attributes"></a>
### Атрибуты элемента

Метод `itemAttributes()` позволяет добавить дополнительные атрибуты к элементам.

```php
itemAttributes(Closure $closure)
```

- `$closure` - замыкание принимает имя файла и индекс файла.

```php
use MoonShine\Fields\File;

//...

public function fields(): array
{
    return [
        File::make('File', 'file')
            ->itemAttributes(fn(string $filename, int $index = 0) => [
                'style' => 'width: 250px; height: 250px;'
            ])
    ];
}

//...
```
<a name="helper-methods"></a>
### Вспомогательные методы

### getRemainingValues()

Метод `getRemainingValues()` позволяет получить значения, которые остались в форме, с учетом удаления.

```php
getRemainingValues()
```

### removeExcludedFiles()

Метод `removeExcludedFiles()` позволяет физически удалить файлы в процессе.

```php
removeExcludedFiles()
```

> [!TIP]
> Рецепт: [сохранение изображений](https://moonshine-laravel.com/docs/resource/recipes/recipes#images-in-linked-table) в связанной таблице.
