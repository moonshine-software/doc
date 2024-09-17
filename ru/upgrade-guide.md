# UPGRADE MoonShine 2.x → 3.x (черновик)

- [Обновление пакета](#update)
- [Первоначальная настройка](#install)
- [Список изменений](#refactor)
  - [Namespace](#namespace)
  - [Методы](#methods)
  - [Переменные](#vars)

---
<a name="update"></a>
## [Обновление пакета](#update)

#### Обновить `composer.json`
`"moonshine/moonshine": "^2.9",` → `"moonshine/moonshine": "3.x-dev",`

#### Отредактировать `config/app.php`
Новый сервис провайдер сменил namespace `MoonShine\Providers\MoonShineApplicationServiceProvider` → `MoonShine\Laravel\Providers\MoonShineApplicationServiceProvider`

Поэтому для корректного обновления нужно удалить строку `App\Providers\MoonShineServiceProvider::class,`.

#### Сделать бэкапы MoonShineServiceProvider.php и config/moonshine.php
Они понадобятся для переноса
- `mv app/Providers/MoonShineServiceProvider.php app/Providers/MoonShineServiceProvider_2.php`
- `mv config/moonshine.php config/moonshine_2.php`
 
#### Запустить обновление composer
`composer update`

<a name="install"></a>
## [Первоначальная настройка](#install)

#### Запустить команду `moonshine:install` (опция --u означает without-user)
Команда `moonshine:install` добавляет новый провайдер, конфигурацию, Layout и Dashboard.

`php artisan moonshine:install --u`

- `Install migrations? - yes` (там нечего обновлять, но нужно для генерации сервис провайдера)

#### Обновляем конфиг из бэкапа
Параметры `'logo'` и `'logo_small'` нужно удалить, так как настройка Logo переместилась в MoonShineLayout _(пример: https://github.com/orgs/moonshine-software/discussions/1255#discussioncomment-10580920)_

#### Удаляем бэкап конфига
`rm config/moonshine_2.php`

#### Перенести меню в MoonShineLayout и обновить
- Изменения:
    - Пространства имен меню изменены на `MoonShine\MenuManager\*`.
    - Экземпляры ресурсов заменены на строковые классы.
    - Иконки `heroicons.outline.` теперь верхнего уровня.
- Открыть `app/MoonShine/Layouts/MoonShineLayout.php` и вставить старое меню из `app/Providers/MoonShineServiceProvider_2.php` в метод `menu`
- Все экземпляры ресурсов нужно заменить на строковые классы, пример:
  - `MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical')` → `MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical')`


#### Зарегистрировать все классы в MoonShineServiceProvider.php
Все ресурсы и страницы регистрируются в новом провайдере.
```
    protected function resources(): array
    {
        return [
            MoonShineUserResource::class,
            MoonShineUserRoleResource::class,
        ];
    }
```
Сгенерировать список всех классов можно так _(только те что в корне Resources)_:
```
find app/MoonShine/Resources -type f | sed "s/.*\///" | sed "s/.php/::class,/ | sort"
find app/MoonShine/Resources -type f | sed "s/.*\///" | sed "s/.php//" | awk '{print "App\\MoonShine\\Resources\\"$1"\;"} | sort'
```
#### Удалить старый сервис провайдер
`rm app/Providers/MoonShineServiceProvider_2.php`
#### Удалить старый Layout, если был
`rm app/MoonShine/MoonShineLayout.php`

#### Обновить Dashboard (создан новый)
`app/MoonShine/Pages/Dashboard.php`

<a name="refactor"></a>
## [Список изменений](#refactor)

<a name="namespace"></a>
### [Namespace](#namespace)
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

##### Удалить
- `MoonShine\Laravel\Handlers\ExportHandler` (меняется на пакет https://github.com/moonshine-software/import-export)
- `MoonShine\Laravel\Handlers\ImportHandler` (меняется на пакет https://github.com/moonshine-software/import-export)
- ```
    /**
     * @return list<MoonShineComponent|Field>
     */
  ```
  
<a name="methods"></a>
### [Методы](#methods)
- Если нужно создать ресурс: `app(NameResource::class)`
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
- `getActiveActions()` теперь меняется на `activeActions()`, было
  ```
    public function getActiveActions(): array
    {
        return ['view','update'];
    }
  ```
  стало так
  ```
    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::DELETE, Action::MASS_DELETE);
    }
  ```
  или так
  ```
    protected function activeActions(): ListOf
    {
        return new ListOf(Action::class, [Action::VIEW, Action::UPDATE]);
    }
  ```
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
 - Удалить методы полей `hideOn*` и `showOn*` (сразу настроить indexFields/detailFields/formFields)
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
<a name="vars"></a>
### [Переменные](#vars)
- Во всех методах нужно удалить префикс `heroicons.outline` и `heroicons.outline.solid` из всех файлов (эти иконки и outline теперь по-умолчанию).
- Все экземпляры ресурсов нужно заменить на строковые классы, пример:
  - `MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical')` → `MenuItem::make('Settings', SettingResource::class, 'adjustments-vertical')`
##### Удалить
  - `protected bool $isAsync = true;` (теперь по умолчанию)
  
