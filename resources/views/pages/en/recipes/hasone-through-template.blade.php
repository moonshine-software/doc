<x-recipe id="hasone-through-template" title="{{ $title ?? 'Receipt' }}">

<x-p>
    An example of implementing the <em>HasOne</em> relationship through the <code>Template</code> field.
</x-p>

<x-code language="php">
use MoonShine\Fields\Template;

//...

public function fields(): array
{
    return [
        Template::make('Comment')
          ->changeFill(fn (Article $data) => $data->comment)
          ->changePreview(fn($data) => $data?->id ?? '-')
          ->fields((new CommentResource())->getFormFields())
          ->changeRender(function (?Comment $data, Template $field) {
              $fields = $field->preparedFields();
              $fields->fill($data?->toArray() ?? [], $data ?? new Comment());

              return Components::make($fields);
          })
          ->onAfterApply(function (Article $item, array $value) {
              $item->comment()->updateOrCreate([
                  'id' => $value['id']
              ], $value);

              return $item;
          })
    ];
}

//...
</x-code>

</x-recipe>
