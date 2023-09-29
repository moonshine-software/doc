<x-page title="SlideFilter">

<x-extendby :href="route('moonshine.page', 'fields-slide')">
    Slide
</x-extendby>

<x-code language="php">
use MoonShine\Filters\SlideFilter;

//...

public function filters(): array
{
    return [
        SlideFilter::make('Age')
            ->fromField('age_from')
            ->toField('age_to')
            ->min(0)
            ->max(60)
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_slide.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_slide_dark.png') }}"></x-image>

</x-page>
