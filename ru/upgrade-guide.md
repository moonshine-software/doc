# UPGRADE MoonShine 2.x → 3.0 (черновик)

- [Обновление пакета](#update)
- [Первоначальная настройка](#install)
- [Список изменений](#refactor)
  - [Namespace](#namespace)
  - [Методы](#methods)
  - [Переменные](#vars)

---
<a name="update"></a>
## Обновление пакета

### Обновить `composer.json`
`"moonshine/moonshine": "^2.x",` → `"moonshine/moonshine": "^3.0",`

### Отредактировать `config/app.php`
Удалить строку `App\Providers\MoonShineServiceProvider::class,`.

После запуска команды `moonshine:install` сервис-провайдер добавится снова автоматически.

### Сделать бэкапы config/moonshine.php, MoonShineServiceProvider.php и Dashboard.php
Они понадобятся для переноса информации
- `mv config/moonshine.php config/moonshine_old.php`
- `mv app/Providers/MoonShineServiceProvider.php app/Providers/MoonShineServiceProvider_old.php`
- `mv app/MoonShine/Pages/Dashboard.php app/MoonShine/Pages/Dashboard_old.php`
 
### Запустить обновление composer
`composer update`

<a name="install"></a>
## Первоначальная настройка

### Запустить команду `moonshine:install`
Команда `moonshine:install` создает новый сервис-провайдер, конфигурацию, Layout и Dashboard.

`php artisan moonshine:install`

### Обновляем конфиг из бэкапа
- Параметры `'logo'` и `'logo_small'` нужно удалить, так как настройка Logo переместилась в MoonShineLayout _(смотрите документацию по Layout)_.

### Перенести меню в MoonShineLayout и обновить
- Изменения:
    - Пространства имен меню изменены на `MoonShine\MenuManager\*`.
    - Экземпляры ресурсов заменены на строковые классы, смотрите раздел [Переменные](#vars)
    - Иконки `heroicons.outline.` теперь верхнего уровня.
- Открыть `app/MoonShine/Layouts/MoonShineLayout.php` и вставить старое меню из `app/Providers/MoonShineServiceProvider_old.php` в метод `menu`
- Все экземпляры ресурсов нужно заменить на строковые классы, пример:
  - `MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical')` → `MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical')`


### Зарегистрировать все классы в MoonShineServiceProvider.php
Все ресурсы и страницы регистрируются в новом провайдере (экземпляры заменены на строковые классы, смотрите раздел [Переменные](#vars)):
```
    protected function resources(): array
    {
        return [
            MoonShineUserResource::class,
            MoonShineUserRoleResource::class,
        ];
    }
```
Сгенерировать список всех классов для импорта в пространство имен можно так:
```
find app/MoonShine/Resources -type f | sed "s/app/use App/" | sed "s|/|\\\|g" | sed "s/.php/;/" | sort
```
Сгенерировать cписок всех классов для добавления в `resources()`:
```
find app/MoonShine/Resources -type f -exec basename {} \; | sed "s/.php/::class,/" | sort
```
### Обновить Dashboard 
Перенести нужные функции в `app/MoonShine/Pages/Dashboard.php` из `app/MoonShine/Pages/Dashboard_old.php` (смотрите раздел [Список изменений](#refactor))

### Удалить файлы
- старый Layout, если был:
```
rm app/MoonShine/MoonShineLayout.php
```
- бэкапы файлов от 2.x
```
rm config/moonshine_old.php
rm app/Providers/MoonShineServiceProvider_old.php
rm app/MoonShine/Pages/Dashboard_old.php
```

<a name="refactor"></a>
## Список изменений

<a name="namespace"></a>
### Namespace
#### Изменить
- `MoonShine\Resources\` → `MoonShine\Laravel\Resources\`
- `MoonShine\Fields\Relationships\` → `MoonShine\Laravel\Fields\Relationships\`
- `MoonShine\Fields\Slug` → `MoonShine\Laravel\Fields\Slug`
- `MoonShine\Fields\` → `MoonShine\UI\Fields\`
- `MoonShine\Decorations\Block` → `MoonShine\UI\Components\Layout\Block`
- `MoonShine\Decorations\` → `MoonShine\UI\Components\Layout\*` _(некоторые на `MoonShine\UI\Components\`, проверьте вручную)_
- `MoonShine\Enums\` → `MoonShine\Support\Enums\`
- `MoonShine\Pages\` → `MoonShine\Laravel\Pages\`
- `MoonShine\Models\` → `MoonShine\Laravel\Models\`
- `MoonShine\QueryTags\` → `MoonShine\Laravel\QueryTags\`
- `MoonShine\Attributes\` → `MoonShine\Support\Attributes\`
- `MoonShine\Components\` → `MoonShine\UI\Components\`
- `MoonShine\Metrics\` → `MoonShine\UI\Components\Metrics\Wrapped\`
- `MoonShine\ActionButtons\` → `MoonShine\UI\Components\`
- `MoonShine\Http\Responses\` → `MoonShine\Laravel\Http\Responses\`
- `MoonShine\Http\Controllers\` → `MoonShine\Laravel\Http\Controllers\`
- `MoonShine\MoonShineAuth` → `MoonShine\Laravel\MoonShineAuth`

#### По необходимости установить дополнительные пакеты и обновить namespace для:
- https://github.com/moonshine-software/import-export
  - Обработчик `MoonShine\Laravel\Handlers\ExportHandler`
  - Обработчик `MoonShine\Laravel\Handlers\ImportHandler`
- https://github.com/moonshine-software/apexcharts
  - Компонент `MoonShine\UI\Components\Metrics\Wrapped\DonutChartMetric`
  - Компонент `MoonShine\UI\Components\Metrics\Wrapped\LineChartMetric`
- https://github.com/moonshine-software/ace
  - Поле `MoonShine\Fields\Code`
- https://github.com/moonshine-software/easymde
  - Поле `MoonShine\Fields\Markdown`

<a name="methods"></a>
### Методы
#### Изменить
- Если нужно создать экземпляр: `new NameResource()` → `app(NameResource::class)`
- `public function components(): array` → `protected function components(): iterable`
- `public function title(): string` → `public function getTitle(): string`
- `public function breadcrumbs(): string` → `public function getBreadcrumbs(): string`
- `public function rules(Model $item): array` → `protected function rules($item): array`
- `protected function afterUpdated(Model $user): Model` → `protected function afterUpdated($user): Model`
- `public function detailButtons(): array` → `public function detailButtons(): ListOf` (добавить `MoonShine\Support\ListOf`)
- `public function modifyListComponent(MoonShineRenderable|TableBuilder $table): MoonShineRenderable` → `public function modifyListComponent(ComponentContract $table): ComponentContract`
- `pages()` теперь принимает массив названий классов:
  ```
      protected function pages(): array
      {
          return [
              SettingPage::class,
          ];
      }
  ```
- `getActiveActions()` теперь меняется на `activeActions()`, смотрите раздел [Активные действия](#/docs/{{version}}/model-resource/index.md).
- `detailPageUrl` → `getDetailPageUrl`,
- `MoonShineAuth::guard()` → `MoonShineAuth::getGuard()`
- `$field->getData()` → `$field->getData()->getOriginal()`
- `public function fields(): array` → `protected function indexFields(): iterable` и добавить
  - ```
    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function formFields(): iterable
    {
        return $this->indexFields();
    }
    ```
  - удалить `Block::` и прочие декорации из indexFields
- `trAttributes` `tdAttributes` для `TableBuilder` теперь должны возвращать значения такие же как для вызова `customAttributes` и вместо `ComponentAttributeBag $attributes` теперь `TableBuilder $table`:
  ```
  TableBuilder::make()
    ->tdAttributes(fn(mixed $data, int $row, TableBuilder $table): array => ($row == 3) ? ['class' => 'bgc-yellow'] : []) 
    ->tdAttributes(fn(mixed $data, int $row, int $cell, TableBuilder $table): array => ($cell == 3) ? ['align' => 'right'] : []) 
  ```
- Хелпер `to_page` → `toPage`
- Вместо метода `columnSpan` у компонентов использовать метод компонента `Column`: `Column::make([...])->columnSpan(..)` 

#### Удалить
- Удалить методы полей `hideOn*` и `showOn*` _(сразу настроить indexFields/detailFields/formFields, смотрите в документации метод exceptElements для Fields, он позволяет гибко исключать поля)_
    - `hideOnIndex`
    - `showOnIndex`
    - `hideOnForm`
    - `showOnForm`
    - `hideOnCreate`
    - `showOnCreate`
    - `hideOnUpdate`
    - `showOnUpdate`
    - `hideOnDetail`
    - `showOnDetail`
    - `hideOnAll`
    - `hideOnExport`
    - `showOnExport`
   - А также `useOnImport` (использовать пакет https://github.com/moonshine-software/import-export)
- Хелперы `form`, `table`, `actionBtn` (используйте классы `TableBuilder`, `FormBuilder`, `ActionButton`)

<a name="vars"></a>
### Переменные
#### Изменить
- Во всех методах нужно удалить префикс `heroicons.outline` и `heroicons.outline.solid` из всех файлов (эти иконки и outline теперь по-умолчанию).
- Все экземпляры ресурсов нужно заменить на строковые классы, пример:
  - `MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical')` → `MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical')`
- `->async(asyncUrl: ..., asyncEvents: ...)` → `->async(url: ..., events: ...)`
  - поменялся формат наименования событий со строкового на генерацию хелпером:
    - `table-updated-{name}` → `AlpineJs::event(JsEvent::TABLE_UPDATED, {name})`
    - смотрите файл `src/Support/src/Enums/JsEvent.php` со списком всех событий
- `protected string $sortDirection = 'ASC';` → `protected SortDirection $sortDirection = SortDirection::ASC;` (также `DESC`)  
- `$assets` теперь вместо строк принимает `AssetElementContract`, такие как `Css`, `InlineCss`, `Js`, `InlineJs` 
#### Удалить
  - `protected bool $isAsync = true;` (теперь по умолчанию)
  
