# Импорт / Экспорт

- [Основы](#basics)
- [Импорт](#import)
  - [Поля](#import-fields)
  - [Настройки импорта](#import-settings)
  - [События](#import-events)
- [Экспорт](#export)
  - [Поля](#export-fields)
  - [Настройки экспорта](#export-settings)
- [Общие методы](#methods)
- [Кастомная реализация](#custom)

---

<a name="basics"></a>
## Основы

Чтобы пользоваться импортом и экспортом в ресурсах MoonShine, необходимо установить зависимость через `composer`.

```shell
composer require moonshine/import-export
```

Далее, в ресурсе добавьте трейт `ImportExportConcern` и реализуйте интерфейс `HasImportExportContract`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Resources;

use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\Traits\ImportExportConcern; // [tl! collapse:end]

class CategoryResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    // ...
}
```

Все готово! Далее просто объявляйте поля.

<a name="import"></a>
## Импорт

<a name="import-fields"></a>
### Поля

Для импорта необходимо в ресурсе объявить поля, которые будут участвовать в импорте.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

protected function importFields(): iterable
{
    return [
        ID::make(),
        Text::make('Name'),
    ];
}
```

> [!WARNING]
> Обязательно добавляйте в импорт `ID`, иначе записи будут только добавляться, без обновления существующих.

Если вам необходимо модифицировать значение при импорте, необходимо воспользоваться методом поля `fromRaw()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\Enums\StatusEnum;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;

protected function importFields(): iterable
{
    return [
        ID::make(),
        Enum::make('Status')
            ->attach(StatusEnum::class)
            ->fromRaw(static fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw)),
    ];
}
```

<a name="import-settings"></a>
### Настройки импорта

Для настройки импорта доступны опциональные методы.
Чтобы ими воспользоваться необходимо добавить метод `import()`, который возвращает `ImportHandler`.

- `notifyUsers()` - указать id пользователей, которые получат уведомление об окончании операции,
- `disk()` - выбор диска,
- `dir()` - выбор директории для сохранения файла импорта,
- `deleteAfter()` - Удалять файл после импорта,
- `delimiter()` - разделитель для CSV,
- `modifyButton()` - модификация кнопки.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\ImportHandler;
use MoonShine\UI\Components\ActionButton;

protected function import(): ?Handler
{
    return ImportHandler::make(__('moonshine::ui.import'))
        ->notifyUsers(fn(ImportHandler $ctx) => [auth()->id()])
        ->disk('public')
        ->dir('/imports')
        ->deleteAfter()
        ->delimiter(',')
        ->modifyButton(fn(ActionButton $btn) => $btn->class('my-class'));
}
```

> [!NOTE]
> Если метод `import()` вернет `NULL`, то кнопка импорта не будет отображаться на индексной странице.

<a name="import-events"></a>
### События

Для изменения логики работы импорта можно воспользоваться событиями ресурса модели.

```php
public function beforeImportFilling(array $data): array
{
    return $data;
}

public function beforeImported(mixed $item): mixed
{
    return $item;
}

public function afterImported(mixed $item): mixed
{
    return $item;
}
```

<a name="export"></a>
## Экспорт

В админ-панели **MoonShine** можно реализовать экспорт всех данных с учетом текущей фильтрации и сортировки.

> [!NOTE]
> По умолчанию данные экспортируются в формате XLSX, но существует возможность изменить формат на CSV через метод `csv()` класса `ExportHandler`.

<a name="export-fields"></a>
### Поля

Для экспорта необходимо в ресурсе объявить поля, которые будут участвовать в экспорте.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

protected function exportFields(): iterable
{
    return [
        ID::make(),
        Text::make('Name'),
    ];
}
```

Если вам необходимо модифицировать значение при экспорте, необходимо воспользоваться методом поля `modifyRawValue()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\Enums\StatusEnum;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;

protected function exportFields(): iterable
{
    return [
        ID::make(),
        Enum::make('Status')
            ->attach(StatusEnum::class)
            ->modifyRawValue(static fn(StatusEnum $raw, Order $data, Enum $ctx) => $raw->value),
    ];
}
```

<a name="export-settings"></a>
### Настройки экспорта

Для настройки экспорта доступны опциональные методы.
Чтобы ими воспользоваться необходимо добавить метод `export()`, который возвращает `ExportHandler`.

- `notifyUsers()` - указать id пользователей, которые получат уведомление об окончании операции,
- `disk()` - выбор диска,
- `filename()` - наименование файла,
- `dir()` - выбор директории сохранения файла экспорта,
- `csv()` - экспортировать в формате CSV (по умолчанию XLSX),
- `delimiter()` - разделитель для CSV,
- `withConfirm()` - экспорт с подтверждением,
- `modifyButton()` - модификация кнопки.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\UI\Components\ActionButton;

protected function export(): ?Handler
{
    return ExportHandler::make(__('moonshine::ui.export'))
        ->notifyUsers(fn() => [auth()->id()])
        ->disk('public')
        ->filename(sprintf('export_%s', date('Ymd-His')))
        ->dir('/exports')
        ->csv()
        ->delimiter(',')
        ->withConfirm()
        ->modifyButton(fn(ActionButton $btn) => $btn->class('my-class'));
}
```

> [!NOTE]
> Если метод `export()` вернет `NULL`, то кнопка экспорта не будет отображаться на индексной странице.

<a name="methods"></a>
## Общие методы

`ImportHandler` и `ExportHandler` расширяют базовый класс `Handler`, который реализует дополнительные методы.

### icon

Иконка для кнопки:

```php
icon(string $icon)
```

### queue

Запускать процессы в фоне:

```php
queue()
```

### modifyButton

Модификация кнопки:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\ActionButton;

modifyButton(
    fn(ActionButton $btn) => $btn->class('my-class')
)
```

### notifyUsers

Выбор пользователей для уведомления:

```php
notifyUsers(
    fn() => [auth()->id()]
)
```

### when

Методы по условию:

```php
when(
    $value = null,
    callable $callback = null,
    callable $default = null,
)
```

- `$value` - условие,
- `$callback` - `callback` функция, которая будет выполнена, если условие имеет значение `TRUE`,
- `$default` - `callback` функция, которая будет выполнена, если условие имеет значение `FALSE`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Crud\Handlers\Handler;
use MoonShine\ImportExport\ImportHandler;

protected function import(): ?Handler
{
    return ImportHandler::make('Import')
        ->when(
            true,
            fn($handler) => $handler->delimiter(','),
            fn($handler) => $handler->delimiter(';')
        );
}
```

### unless

Методы по условию:

```php
unless(
    $value = null,
    callable $callback = null,
    callable $default = null,
)
```

- `$value` - условие,
- `$callback` - `callback` функция, которая будет выполнена, если условие имеет значение `FALSE`,
- `$default` - `callback` функция, которая будет выполнена, если условие имеет значение `TRUE`.

> [!NOTE]
> Метод `unless()` является обратным методу `when()`.

<a name="custom"></a>
## Кастомная реализация

Может возникнуть ситуация, когда вы захотите изменить реализацию импорта или экспорта.
Для этого необходимо реализовать свой класс расширяющий `ImportHandler` или `ExportHandler`.

Класс можно сгенерировать, воспользовавшись следующей консольной командой:

```shell
php artisan moonshine:handler
```

После выполнения команды будет создан базовый класс `Handler` в директории `app/MoonShine/Handlers`.

> [!NOTE]
> Не забудьте заменить наследование с `Handler` на `ImportHandler` или `ExportHandler`.
