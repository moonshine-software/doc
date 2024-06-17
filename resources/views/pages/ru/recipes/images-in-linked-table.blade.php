<x-recipe id="images-in-linked-table" title="{{ $title ?? 'Рецепт' }}">

<x-code language="php">
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use MoonShine\Fields\Image;

// ...

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
</x-code>

</x-recipe>
