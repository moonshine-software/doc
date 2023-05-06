<x-page title="Thumbnails" :sectionMenu="[]">

<x-p>
    To create thumbnails, you can use the <code>x-moonshine::thumbnails</code> component
</x-p>

@include("examples/components/thumbnails")

<x-code language="blade" file="resources/views/examples/components/thumbnails.blade.php"></x-code>

<x-p>
    You can also specify the attribute <code>alt</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-alt.blade.php"></x-code>

<x-sub-title>Group of images</x-sub-title>

<x-p>
    Component can be passed an array of images
</x-p>

@include("examples/components/thumbnails-multiple")

<x-code language="blade" file="resources/views/examples/components/thumbnails-multiple.blade.php"></x-code>

</x-page>
