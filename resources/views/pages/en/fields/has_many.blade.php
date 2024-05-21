<x-page
    title="HasMany"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#fields', 'label' => 'Fields'],
            ['url' => '#creatable', 'label' => 'Creating a Relationship Object'],
            ['url' => '#limit', 'label' => 'Number of records'],
            ['url' => '#only-link', 'label' => 'Link only'],
            ['url' => '#parent-id', 'label' => 'Parent ID'],
            ['url' => '#modify', 'label' => 'Modify'],
            ['url' => '#advanced', 'label' => 'Advanced'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

@include('pages.en.fields.shared.relation_make', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="fields">Fields</x-sub-title>

<x-p>
    The <code>fields()</code> method allows you to set the fields that will be displayed in the <em>preview</em>.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->fields([
                BelongsTo::make('User'),
                Text::make('Text'),
            ]) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_fields_dark.png') }}"></x-image>

<x-sub-title id="creatable">Creating a Relationship Object</x-sub-title>

@include('pages.en.fields.shared.relation_creatable', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="limit">Number of records</x-sub-title>

<x-p>
    The <code>limit()</code> method allows you to limit the number of records displayed in <em>preview</em>.
</x-p>

<x-code language="php">
limit(int $limit)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->limit(1) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="only-link">Link only</x-sub-title>

<x-p>
    The <code>onlyLink()</code> method will allow you to display the relationship as a link with the number of elements.
</x-p>

<x-code language="php">
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
</x-code>

<x-p>
    You can pass optional parameters to the method:
    <x-ul>
        <li><code>linkRelation</code> - relation reference;</li>
        <li>
            <code>condition</code> - closure or boolean value,
            responsible for displaying the relationship as a link.
        </li>
    </x-ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_link_dark.png') }}"></x-image>

<x-moonshine::divider label="linkRelation"></x-moonshine::divider>

<x-p>
    To retrieve relation values for a parent resource,
    You must set the <code>$parentRelations</code> property in the relationship resource.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CommentResource extends ModelResource
{
    //...

    protected array $parentRelations = ['user'];

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    The route will be available:<br />
    <em>/resource/comment-resource/index-page/user-{id}</em>
</x-moonshine::alert>

<x-p>
    The <code>linkRelation</code> parameter allows you to create a link to a relation with a parent resource binding.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink('user') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="condition"></x-moonshine::divider>

<x-p>
    The <code>condition</code> parameter via a closure will allow you to change the display method depending on the conditions.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

@include('pages.en.fields.shared.parent_id')

<x-sub-title id="modify">Modify</x-sub-title>

<x-p>
    The <em>HasMany</em> field has methods that can be used to modify the edit (add) button,
    change <em>TableBuilder</em> for preview and form, and change <em>onlyLink</em> button.
</x-p>

<x-moonshine::divider label="modifyOnlyLinkButton()" />

<x-p>
    The <code>modifyOnlyLinkButton()</code> method allows you to change the <em>onlyLink</em> button.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink()
            ->modifyOnlyLinkButton(
                fn(ActionButton $button, bool $preview) => $button
                    ->when(
                        $preview,
                        fn(ActionButton $btn) => $btn->primary()
                        fn(ActionButton $btn) => $btn->secondary()
                    )
            ) // [tl! focus:-7]
    ];
}

//...
</x-code>

<x-moonshine::divider label="modifyCreateButton() / modifyEditButton()" />

<x-p>
    <code>modifyCreateButton()</code> and <code>modifyEditButton()</code> methods
    allow you to change the create and edit buttons.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyCreateButton(
                fn(ActionButton $button) => $button->setLabel('Custom create button')
            )
            ->modifyEditButton(
                fn(ActionButton $button) => $button->setLabel('Custom edit button')
            ) // [tl! focus:-5]
            ->creatable(true)
    ];
}

//...
</x-code>

<x-moonshine::divider label="modifyTable()" />

<x-p>
    The <code>modifyTable()</code> method allows you to change the <em>TableBuilder</em> for the preview and form.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyTable(
                fn(TableBuilder $table, bool $preview) => $table
                    ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
                    ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
            ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-sub-title id="advanced">Advanced</x-sub-title>

<x-moonshine::divider label="Relation via JSON field" />

<x-p>
    The <em>HasMany</em> field is displayed outside the main resource form by default.<br />
    If you need to display relation fields inside the main form,
    then you can use the <em>JSON</em> field in the <code>asRelation()</code> mode.
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource()) // [tl! focus]
            //...
    ]
}

//...
</x-code>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('fields-json') }}#relation">Json field</x-link>.
</x-moonshine::alert>

<x-moonshine::divider label="Relationship via Template field" />

<x-p>
    Using the <em>Template</em> field you can construct a field for <em>HasMany</em> relationships
    using fluent interface during the declaration process.
</x-p>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ to_page('fields-template') }}">Template field</x-link>.
</x-moonshine::alert>

<x-moonshine::divider label="HasMany field tabs" />

<x-p>
    In <strong>Moonshine</strong> you can customize the form page and place <em>HasMany</em> fields in
    tabs using the <em>Tabs</em> and <em>Tab</em> decorations.
</x-p>

<x-code language="php">
class PostFormPage extends FormPage
{
    public function components(): array
	{
        if(! $this->getResource()->getItemID()) {
            return parent::components();
        }

        $bottomComponents = $this->getLayerComponents(Layer::BOTTOM);
        $imagesComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'images')->first();
        $commentsComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'comments')->first();

        $tabLayer = [
            Block::make('', [
                Tabs::make([
                    Tab::make('Edit', $this->mainLayer()),
                    Tab::make('Images', [$imagesComponent]),
                    Tab::make('Comments', [$commentsComponent])
                ])
            ])
        ];

        return [
            ...$this->getLayerComponents(Layer::TOP),
            ...$tabLayer,
        ];
	}
}
</x-code>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    For more details you can read the article
    <x-link link="https://cutcode.dev/articles/kastomizaciia-stranicy-formy-moonshine-20">
        Form page customization. Moon Shine 2.0
    </x-link>.
</x-moonshine::alert>

</x-page>
