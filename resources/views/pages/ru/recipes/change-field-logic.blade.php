<x-recipe id="change-field-logic" title="{{ $title ?? 'Рецепт' }}">

<x-ul>
    <li>
        Для решения данной задачи необходимо заблокировать метод <code>onApply()</code>
        и перенесли логику в <code>onAfterApply()</code>.<br />
        Это позволит получить родительскую модель на странице создания.<br />
        У нас будет доступ к модели и мы сможем работать с ее отношениями.
    </li>
    <li>
        В методе <code>onAfterApply()</code> осуществляется сохранение и получение старых и текущих значений,
        а также очистка удаленных файлов.
    </li>
    <li>
        После удаления родительской записи в методе <code>onAfterDestroy()</code> осуществляется удаление загруженных файлов.
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
    В коде закомментирован вариант с отношением и приведен пример нативного получения путей файлов из другой таблицы.
</x-moonshine::alert>

</x-recipe>
