# Text

- [Создание](#make)
- [Значение по умолчанию](#default)
- [Только для чтения](#readonly)
- [Маска](#mask)
- [Placeholder](#placeholder)
- [Расширения](#extensions)
- [Теги](#tags)
- [Редактирование в предпросмотре](#update-on-preview)
- [Специальные символы](#unescape)

---

<a name="make"></a>
## Создание

Текстовое поле включает все базовые методы.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
    ];
}

//...
```

![input](https://moonshine-laravel.com/screenshots/input.png)
![input_dark](https://moonshine-laravel.com/screenshots/input_dark.png)

<a name="default"></a>
## Значение по умолчанию

Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->default('-')
    ];
}

//...
```

<a name="readonly"></a>
## Только для чтения

Если поле предназначено только для чтения, то вы должны использовать метод `readonly()`.

```php
readonly(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->readonly()
    ];
}

//…
```

<a name="mask"></a>
## Маска

Метод `mask()` используется для добавления маски к полю.

```php
mask(string $mask)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->mask('7 (999) 999-99-99')
    ];
}

//...
```

![mask](https://moonshine-laravel.com/screenshots/mask.png)
![mask_dark](https://moonshine-laravel.com/screenshots/mask_dark.png)

<a name="placeholder"></a>
## Placeholder

Метод `placeholder()` позволяет установить атрибут *placeholder* для поля.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="extensions"></a>
## Расширения

Для поля *Text* доступно несколько расширений:

+ возможность копирования значения с помощью кнопки

```php
copy(string $value = '{{value}}')
```

- `{{value}}` - значение поля.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy(),
        Text::make('Token')
            ->copy('https://domain.com?token={{value}}')
        ];
    }

//...
```
+ блокировка с запретом изменения

```php
locked()
```

+ отключение отображения значения

```php
eye()
```

+ подсказка формата

```php
expansion(string $ext)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy()
            ->locked()
            ->expansion('kg')
            ->eye()
        ];
    }

//...
```

![expansion](https://moonshine-laravel.com/screenshots/expansion.png)
![expansion_dark](https://moonshine-laravel.com/screenshots/expansion_dark.png)

> [!NOTE]
> Метод `copy` использует `Clipboard API`, который доступен только для HTTPS или localhost

Вы можете использовать пользовательские расширения. Для этого их необходимо добавить к полю через метод `extension()`.

```php
extension(InputExtension $extension)
```

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->extension(new InputCustomExtension())
        ];
    }

//...
```

<a name="tags"></a>
## Теги

Метод `tags()` позволяет вводить данные в виде тегов.

```php
tags(?int $limit = null)
```

- `$limit` - количество доступных тегов, по умолчанию не ограничено.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Keywords')
            ->tags()
        ];
    }

//...
```

<a name="update-on-preview"></a>
## Редактирование в предпросмотре

Метод `updateOnPreview()` позволяет редактировать поле *Text* в режиме *предпросмотра*.

```php
updateOnPreview(?Closure $url = null, ?ResourceContract $resource = null, mixed $condition = null)
```

- `$url` - url для обработки асинхронного запроса,
- `$resource` - ресурс модели, на который ссылается отношение,
- `$condition` - условие выполнения метода.


> [!NOTE]
> Настройки не обязательны и должны быть переданы, если поле работает вне ресурса.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make(Country)
            ->updateOnPreview()
    ];
}

//...
```

<a name="unescape"></a>
## Специальные символы

> [!WARNING]
> По умолчанию поле **Text** и его потомки преобразуют специальные символы в HTML-сущности при выводе значений.

Метод `unescape()` позволяет отменить преобразование специальных символов в HTML-сущности при выводе значений.

```php
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->unescape()
        ];
    }

//...
```
