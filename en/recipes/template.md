# HasOne through the Template Field

Example of implementing a `HasOne` relationship through the *Template* field.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Template;

// ...

protected function formFields(): iterable
{
    return [
        Template::make('Comment')
          ->changeFill(fn (Article $data) => $data->comment)
          ->changePreview(fn($data) => $data?->id ?? '-')
          ->fields(app(CommentResource::class)->getFormFields())
          ->changeRender(function (?Comment $data, Template $field) {
              $fields = $field->getPreparedFields();
              $fields->fill($data?->toArray() ?? []);

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
```
