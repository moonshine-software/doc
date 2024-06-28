<x-page
    title="Buttons"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#create', 'label' => 'Create button'],
            ['url' => '#detail', 'label' => 'Detail button'],
            ['url' => '#edit', 'label' => 'Edit button'],
            ['url' => '#delete', 'label' => 'Delete button'],
            ['url' => '#mass-delete', 'label' => 'Bulk delete button'],
            ['url' => '#form', 'label' => 'Form buttons'],
            ['url' => '#actions', 'label' => 'Buttons on the index page'],
            ['url' => '#buttons', 'label' => 'Element buttons'],
            ['url' => '#indexButton', 'label' => 'Index table'],
            ['url' => '#formButtons', 'label' => 'Form page'],
            ['url' => '#detailButtons', 'label' => 'Detail page'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Buttons are displayed on resource pages: index page, form pages (create/edit)
    and detail page.<br />
    They are responsible for basic actions with elements and are components
    <x-link link="{{ to_page('action_button') }}"><code>ActionButton</code></x-link>.
</x-p>

<x-p>
    In the <strong>MoonShine</strong> admin panel there are many methods that allow you to override the resource
    as a separate <x-link link="{{ to_page('action_button') }}">button</x-link>,
    and the whole <x-link link="{{ to_page('action_button') }}#group">group</x-link>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    More detailed information about the <x-link link="{{ to_page('action_button') }}">ActionButton</x-link> component.
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.book-open">
    The buttons for creating, viewing, editing, deleting and mass deleting are placed in separate classes,
    in order to apply all the necessary methods to them and thereby eliminate duplication,
    since these buttons are also used in HasMany, BelongsToMany, etc.
</x-moonshine::alert>

<x-sub-title id="create">Create button</x-sub-title>

<x-moonshine::divider label="Modification" />

<x-p>
    The <code>modifyCreateButton()</code> method allows you to modify the button for creating a new element.
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

<x-moonshine::divider label="Override" />

<x-p>
    The <code>getCreateButton()</code> method allows you to override the button for creating a new element.
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

<x-sub-title id="detail">Detail button</x-sub-title>

<x-moonshine::divider label="Modification" />

<x-p>
    The <code>modifyDetailButton()</code> method allows you to modify the detail view button of an element.
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

<x-moonshine::divider label="Override" />

<x-p>
    The <code>getDetailButton()</code> method allows you to override the element's detail view button.
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

<x-sub-title id="edit">Edit button</x-sub-title>

<x-moonshine::divider label="Modification" />

<x-p>
    The <code>modifyEditButton()</code> method allows you to modify the element's edit button.
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

<x-moonshine::divider label="Override" />

<x-p>
    The <code>getEditButton()</code> method allows you to override an element's edit button.
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

<x-sub-title id="delete">Delete button</x-sub-title>

<x-moonshine::divider label="Modification" />

<x-p>
    The <code>modifyDeleteButton()</code> method allows you to modify the button to delete an element.
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

<x-moonshine::divider label="Override" />

<x-p>
    The <code>getDeleteButton()</code> method allows you to override the element's delete button.
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

<x-sub-title id="mass-delete">Bulk delete button</x-sub-title>

<x-moonshine::divider label="Modification" />

<x-p>
    The <code>modifyMassDeleteButton()</code> method allows you to modify the mass delete button.
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

<x-moonshine::divider label="Override" />

<x-p>
    The <code>getMassDeleteButton()</code> method allows you to override the mass delete button.
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

<x-sub-title id="form">Form buttons</x-sub-title>

<x-p>
    The <code>getFormBuilderButtons()</code> method allows you to add additional <x-link link="{{ to_page('action_button') }}">buttons</x-link>
    into the create or edit form.
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

<x-sub-title id="actions">Buttons on the index page</x-sub-title>

<x-p>
    By default, the model resource index page only has a button to create.<br />
    The <code>actions()</code> method allows you to add additional <x-link link="{{ to_page('action_button') }}">buttons</x-link>.
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

<x-sub-title id="buttons">Element buttons</x-sub-title>

<x-p>
    The <code>buttons()</code> method allows you to specify additional buttons,
    which will be displayed in the index table, in the creation and editing forms,
    as well as on the detailed page, if they are not overridden for pages by the corresponding methods
    <x-link link="{{ to_page('resources-buttons') }}#indexButton"><code>indexButton()</code></x-link>,
    <x-link link="{{ to_page('resources-buttons') }}#formButtons"><code>formButtons()</code></x-link> and
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

<x-sub-title id="indexButton">Buttons in the index table</x-sub-title>

<x-p>
    To add buttons to the index table, use the <code>indexButtons()</code> method.
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
            ActionButton::make(
                'Link',
                fn(Model $item) => '/endpoint?id=' . $item->getKey()
            )
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_index.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_index_dark.png') }}"></x-image>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    An example of creating custom buttons for the index table in the section
    <x-link link="{{ to_page('recipes') }}#custom-buttons">Recipes</x-link>
</x-moonshine::alert>

<x-p>
    For bulk actions with elements, you need to add the <code>bulk()</code> method
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

<x-moonshine::divider label="Group override" />

<x-p>
    If you want to completely change all the item buttons in the index table,
    then you need to override the <code>getIndexItemButtons()</code> method in the resource.
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

<x-sub-title id="formButtons">Buttons on the form page</x-sub-title>

<x-p>
    To add buttons to a page with a form, use the <code>formButtons()</code> method.
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
            ActionButton::make('Link')->method('updateSomething')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_buttons_form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_buttons_form_dark.png') }}"></x-image>

<x-moonshine::divider label="Group override" />

<x-p>
    If you want to completely change all the buttons on an element on a form page,
    then you need to override the <code>getFormItemButtons()</code> method in the resource.
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

<x-sub-title id="detailButtons">Buttons on the detail page</x-sub-title>

<x-p>
    To add buttons on a detail page, use the <code>detailButtons()</code> method.
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

<x-moonshine::divider label="Group override" />

<x-p>
    If you want to completely change all the element buttons on the detail page,
    then you need to override the <code>getDetailItemButtons()</code> method in the resource.
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
