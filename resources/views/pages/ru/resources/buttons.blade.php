<x-page
    title="Кнопки"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#create', 'label' => 'Кнопка создания'],
            ['url' => '#detail', 'label' => 'Кнопка просмотра'],
            ['url' => '#edit', 'label' => 'Кнопка редактирования'],
            ['url' => '#delete', 'label' => 'Кнопка удаления'],
            ['url' => '#mass-delete', 'label' => 'Кнопка массового удаления'],
            ['url' => '#form', 'label' => 'Кнопки формы'],
            ['url' => '#actions', 'label' => 'Кнопки на индексной странице'],
            ['url' => '#buttons', 'label' => 'Кнопки элемента'],
            ['url' => '#indexButton', 'label' => 'Индексная таблица'],
            ['url' => '#formButtons', 'label' => 'Страница с формой'],
            ['url' => '#detailButtons', 'label' => 'Детальная страница'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Кнопки отображаются на страницах ресурса: индексная страница, страницы с формой (создание / редактирование)
    и детальная страница.<br />
    Они отвечают за основные действия с элементами и являются компонентами
    <x-link link="{{ to_page('action_button') }}"><code>ActionButton</code></x-link>.
</x-p>

<x-p>
    В админ-панели <strong>MoonShine</strong> есть множество методов позволяющих переопределить у ресурса
    как отдельную <x-link link="{{ to_page('action_button') }}">кнопку</x-link>,
    так и целую <x-link link="{{ to_page('action_button') }}#group">группу</x-link>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Более подробная информация о компоненте <x-link link="{{ to_page('action_button') }}">ActionButton</x-link>.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.book-open">
    Кнопки создания, просмотра, редактирования, удаления и массового удаления вынесены в отдельные классы,
    чтобы применить к ним все необходимые методы и тем самым исключить дублирование,
    так как эти кнопки еще используются в HasMany, BelongsToMany и тд.
</x-moonshine::alert>

<x-sub-title id="create">Кнопка создания</x-sub-title>

<x-moonshine::divider label="Модификация" />

<x-p>
    Метод <code>modifyCreateButton()</code> позволяет модифицировать кнопку создания нового элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;

protected function modifyCreateButton(ActionButton $button): ActionButton
{
    return $button->error();
} // [tl! focus:-3]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_button_create.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_button_create_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение" />

<x-p>
    Метод <code>getCreateButton()</code> позволяет переопределить кнопку создания нового элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\CreateButton;

public function getCreateButton(?string $componentName = null, bool $isAsync = false): ActionButton
{
    return CreateButton::for(
        $this,
        componentName: $componentName,
        isAsync: $isAsync
    );
} // [tl! focus:-7]
</x-code>

<x-sub-title id="detail">Кнопка просмотра</x-sub-title>

<x-moonshine::divider label="Модификация" />

<x-p>
    Метод <code>modifyDetailButton()</code> позволяет модифицировать кнопку детального просмотра элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;

protected function modifyDetailButton(ActionButton $button): ActionButton
{
    return $button->warning();
} // [tl! focus:-3]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_button_detail.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_button_detail_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение" />

<x-p>
    Метод <code>getDetailButton()</code> позволяет переопределить кнопку детального просмотра элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\DetailButton;

public function getDetailButton(bool $isAsync = false): ActionButton
{
    return DetailButton::for(
        $this,
        isAsync: $isAsync
    );
} // [tl! focus:-6]
</x-code>

<x-sub-title id="edit">Кнопка редактирования</x-sub-title>

<x-moonshine::divider label="Модификация" />

<x-p>
    Метод <code>modifyEditButton()</code> позволяет модифицировать кнопку редактирования элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;

protected function modifyEditButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.pencil-square');
} // [tl! focus:-3]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_button_edit.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_button_edit_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение" />

<x-p>
    Метод <code>getEditButton()</code> позволяет переопределить кнопку редактирования элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\EditButton;

public function getEditButton(?string $componentName = null, bool $isAsync = false): ActionButton
{
    return EditButton::for(
        $this,
        componentName: $componentName,
        isAsync: $isAsync
    );
} // [tl! focus:-7]
</x-code>

<x-sub-title id="delete">Кнопка удаления</x-sub-title>

<x-moonshine::divider label="Модификация" />

<x-p>
    Метод <code>modifyDeleteButton()</code> позволяет модифицировать кнопку удаления элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;

protected function modifyDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
} // [tl! focus:-3]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_button_delete.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_button_delete_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение" />

<x-p>
    Метод <code>getDeleteButton()</code> позволяет переопределить кнопку удаления элемента.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\DeleteButton;

public function getDeleteButton(
    ?string $componentName = null,
    string $redirectAfterDelete = '',
    bool $isAsync = false
): ActionButton {
    return DeleteButton::for(
        $this,
        componentName: $componentName,
        redirectAfterDelete: $isAsync ? '' : $redirectAfterDelete,
        isAsync: $isAsync
    );
} // [tl! focus:-11]
</x-code>

<x-sub-title id="mass-delete">Кнопка массового удаления</x-sub-title>

<x-moonshine::divider label="Модификация" />

<x-p>
    Метод <code>modifyMassDeleteButton()</code> позволяет модифицировать кнопку массового удаления.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;

protected function modifyMassDeleteButton(ActionButton $button): ActionButton
{
    return $button->icon('heroicons.x-mark');
} // [tl! focus:-3]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_button_mass_delete.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_button_mass_delete_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение" />

<x-p>
    Метод <code>getMassDeleteButton()</code> позволяет переопределить кнопку массового удаления.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Buttons\MassDeleteButton;

public function getMassDeleteButton(
    ?string $componentName = null,
    string $redirectAfterDelete = '',
    bool $isAsync = false
): ActionButton {
    return MassDeleteButton::for(
        $this,
        componentName: $componentName,
        redirectAfterDelete: $isAsync ? '' : $redirectAfterDelete,
        isAsync: $isAsync
    );
} // [tl! focus:-11]
</x-code>

<x-sub-title id="form">Кнопки формы</x-sub-title>

<x-p>
    Метод <code>getFormBuilderButtons()</code> позволяет добавить дополнительные <x-link link="{{ to_page('action_button') }}">кнопки</x-link>
    в форму создания или редактирования.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getFormBuilderButtons(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Back', fn() => $this->indexPageUrl())->customAttributes(['class' => 'btn-lg'])
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_form_builder.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_form_builder_dark.png') }}"></x-image>

<x-sub-title id="actions">Кнопки на индексной странице</x-sub-title>

<x-p>
    По умолчанию на индексной странице ресурса модели присутствует только кнопка для создания.<br />
    Метод <code>actions()</code> позволяет добавить дополнительные <x-link link="{{ to_page('action_button') }}">кнопки</x-link>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function actions(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Refresh', '#')
                ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'))
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_actions.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_actions_dark.png') }}"></x-image>

<x-sub-title id="buttons">Кнопки элемента</x-sub-title>

<x-p>
    Метод <code>buttons()</code> позволяет задать дополнительные кнопки,
    которые будут отображаться в индексной таблице, в формах создания и редактирования,
    а так же на детальной странице, если они не переопределены для страниц соответствующими методами
    <x-link link="{{ to_page('resources-buttons') }}#indexButton"><code>indexButton()</code></x-link>,
    <x-link link="{{ to_page('resources-buttons') }}#formButtons"><code>formButtons()</code></x-link> и
    <x-link link="{{ to_page('resources-buttons') }}#detailButtons"><code>detailButtons()</code></x-link>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function buttons(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="indexButton">Кнопки в индексной таблице</x-sub-title>

<x-p>
    Для добавления кнопок в индексную таблицу используется метод <code>indexButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function indexButtons(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_index.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_index_dark.png') }}"></x-image>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Пример создания кастомных кнопок у индексной таблицы в разделе
    <x-link link="{{ to_page('recipes') }}#custom-buttons">Recipes</x-link>
</x-moonshine::alert>

<x-p>
    Для массовых действий с элементами, необходимо добавить метод <code>bulk()</code>
</x-p>

<x-code language="php">
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')
            ->bulk() // [tl! focus]
    ];
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_bulk.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_bulk_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение группы" />

<x-p>
    Если требуется полностью изменить все кнопки элемента в индексной таблице,
    то необходимо в ресурсе переопределить метод <code>getIndexItemButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getIndexItemButtons(): array // [tl! focus:start]
    {
        return [
            ...$this->getIndexButtons(),
            $this->getDetailButton(
                isAsync: $this->isAsync()
            ),
            $this->getEditButton(
                isAsync: $this->isAsync()
            ),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: $this->isAsync()
            ),
            $this->getMassDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: $this->isAsync()
            ),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="formButtons">Кнопки на странице с формой</x-sub-title>

<x-p>
    Для добавления кнопок страницу с формой используется метод <code>formButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function formButtons(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_form_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение группы" />

<x-p>
    Если требуется полностью изменить все кнопки элемента на странице формы,
    то необходимо в ресурсе переопределить метод <code>getFormItemButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getFormItemButtons(): array
    {
        return [
            ...$this->getFormButtons(),
            $this->getDetailButton(),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: false
            ),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="detailButtons">Кнопки на детальной странице</x-sub-title>

<x-p>
    Для добавления кнопок на детальной странице используется метод <code>detailButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\ActionButtons\ActionButton; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function detailButtons(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Link', '/endpoint')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_detail.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_detail_dark.png') }}"></x-image>

<x-moonshine::divider label="Переопределение группы" />

<x-p>
    Если требуется полностью изменить все кнопки элемента на детальной странице,
    то необходимо в ресурсе переопределить метод <code>getDetailItemButtons()</code>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    public function getDetailItemButtons(): array
    {
        return [
            ...$this->getDetailButtons(),
            $this->getEditButton(
                isAsync: $this->isAsync(),
            ),
            $this->getDeleteButton(
                redirectAfterDelete: $this->redirectAfterDelete(),
                isAsync: false
            ),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
