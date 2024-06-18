<x-page
    title="HasMany"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#creatable', 'label' => 'Создание объекта отношения'],
            ['url' => '#limit', 'label' => 'Количество записей'],
            ['url' => '#only-link', 'label' => 'Только ссылка'],
            ['url' => '#parent-id', 'label' => 'ID родителя'],
            ['url' => '#change-edit-button', 'label' => 'Кнопка редактирования'],
            ['url' => '#without-modals', 'label' => 'Модальные окна'],
            ['url' => '#modify', 'label' => 'Модификация'],
            ['url' => '#advanced', 'label' => 'Продвинутое применение'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

@include('pages.ru.fields.shared.relation_make', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Метод <code>fields()</code> позволят задать поля, которые будут отображаться в <em>preview</em>.
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

<x-sub-title id="creatable">Создание объекта отношения</x-sub-title>

@include('pages.ru.fields.shared.relation_creatable', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="limit">Количество записей</x-sub-title>

<x-p>
    Метод <code>limit()</code> позволяет ограничить количество записей отображаемых в <em>preview</em>.
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

@include('pages.ru.fields.shared.only_link', ['field' => 'HasMany', 'label' => 'Comments'])

@include('pages.ru.fields.shared.parent_id')

<x-sub-title id="change-edit-button">Кнопка редактирования</x-sub-title>

<x-p>
    Метод <code>changeEditButton()</code> позволяет полностью переопределить кнопку редактирования.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
    ->changeEditButton(
        ActionButton::make(
            'Edit',
            fn(Comment $comment) => (new CommentResource())->formPageUrl($comment)
        )
    ) // [tl! focus:-5]
</x-code>

<x-sub-title id="without-modals">Модальные окна</x-sub-title>

<x-p>
    По умолчанию создание и редактирование записи поля <em>HasMany</em> происходит в модальном окне,
    метод <code>withoutModals()</code> позволяет отключить такое поведение.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
    ->withoutModals() // [tl! focus]
</x-code>

<x-sub-title id="modify">Модификация</x-sub-title>

<x-p>
    У поля <em>HasMany</em> существуют методы с помощью которых можно модифицировать кнопки,
    изменить <em>TableBuilder</em> для превью и формы, а также изменить <em>onlyLink</em> кнопку.
</x-p>

<x-moonshine::divider label="modifyItemButtons()" />

<x-p>
    Метод <code>modifyItemButtons()</code> позволяет изменить кнопки просмотра, редактирования,
    удаления и массового удаления.
</x-p>

<x-code language="php">
/**
 * @param  Closure(ActionButton $detail, ActionButton $edit, ActionButton $delete, ActionButton $massDelete, self $field): array  $callback
 */
modifyItemButtons(Closure $callback)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyItemButtons(
                fn(ActionButton $detail, $edit, $delete, $massDelete, $ctx HasMany) => [$detail])
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::divider label="modifyOnlyLinkButton()" />

<x-p>
    Метод <code>modifyOnlyLinkButton()</code> позволяет изменить <em>onlyLink</em> кнопку.
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
    Методы <code>modifyCreateButton()</code> и <code>modifyEditButton()</code>
    позволяют изменять кнопки создания и редактирования.
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
    Метод <code>modifyTable()</code> позволяет изменить <em>TableBuilder</em> для превью и формы.
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

<x-sub-title id="advanced">Продвинутое применение</x-sub-title>

<x-moonshine::divider label="Отношение через поле JSON" />

<x-p>
    Поле <em>HasMany</em> по умолчанию отображается вне основной формы ресурса.<br />
    Если необходимо отобразить поля отношения внутри основной формы,
    то можно воспользоваться полем <em>JSON</em> в режиме <code>asRelation()</code>.
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
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('fields-json') }}#relation">поле Json</x-link>.
</x-moonshine::alert>

<x-moonshine::divider label="Отношение через поле Template" />

<x-p>
    Используя поле <em>Template</em> можно конструировать поле для отношений <em>HasMany</em>
    используя fluent interface в процессе объявления.
</x-p>

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ to_page('fields-template') }}">поле Template</x-link>.
</x-moonshine::alert>

<x-moonshine::divider label="Вкладки для полей HasMany" />

<x-p>
    В <strong>Moonshine</strong> можно кастомизировать страницу формы и разместить поля <em>HasMany</em> во
    вкладках используя декорации <em>Tabs</em> и <em>Tab</em>.
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
    За более подробно можно прочитать в статье
    <x-link link="https://cutcode.dev/articles/kastomizaciia-stranicy-formy-moonshine-20">
        Кастомизация страницы формы. MoonShine 2.0
    </x-link>.
</x-moonshine::alert>

</x-page>
