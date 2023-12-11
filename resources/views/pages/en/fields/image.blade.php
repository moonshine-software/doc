<x-page title="Image">

<x-extendby :href="route('moonshine.page', 'fields-file')">
    File
</x-extendby>

<x-p>
    The <em>Image</em> field is an extension of <em>File</em>,
    which allows you to display previews of loaded images.
</x-p>

<x-code language="php">
use MoonShine\Fields\Image; // [tl! focus]

//...

public function fields(): array
{
    return [
        Image::make('Thumbnail') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/image_dark.png') }}"></x-image>

</x-page>
