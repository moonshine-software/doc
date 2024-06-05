<x-recipe id="change-field-logic" title="{{ $title ?? 'Recipe' }}">

<x-ul>
    <li>
        To solve this problem, you need to block the <code>onApply()</code> method
        and moved the logic to <code>onAfterApply()</code>.<br />
        This will get the parent model on the creation page.<br />
        We will have access to the model and we will be able to work with its relationships.
    </li>
    <li>
        The <code>onAfterApply()</code> method stores and retrieves old and current values,
        also cleaning deleted files.
    </li>
    <li>
        After deleting the parent record, the <code>onAfterDestroy()</code> method deletes the downloaded files.
    </li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Image;

//...

Image::make('Images', 'images')
    ->multiple()
    ->removable()
    ->changeFill(function (Model $data, Image $field) {
        // return $data->images->pluck('file');
        // or raw
        return DB::table('images')->pluck('file');
    })
    ->onApply(function (Model $data) {
        // block onApply
        return $data;
    })
    ->onAfterApply(function (Model $data, false|array $values, Image $field) {
        // $field->getRemainingValues(); values that remained in the form taking into account deletions
        // $field->toValue(); current images
        // $field->toValue()->diff($field->getRemainingValues()) deleted images

        if($values !== false) {
            foreach ($values as $value) {
                DB::table('images')->insert([
                    'file' => $field->store($value),
                ]);
            }
        }

        foreach ($field->toValue()->diff($field->getRemainingValues()) as $removed) {
            DB::table('images')->where('file', $removed)->delete();
            Storage::disk('public')->delete($removed);
        }

        // or $field->removeExcludedFiles();

        return $data;
    })
    ->onAfterDestroy(function (Model $data, mixed $values, Image $field) {
        foreach ($values as $value) {
            Storage::disk('public')->delete($value);
        }

        return $data;
    })

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The code comments out the relation option and provides an example of natively obtaining file paths from another table.
</x-moonshine::alert>

</x-recipe>
