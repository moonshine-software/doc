<x-page title="Thumbnails" :sectionMenu="[]">

<x-p>
    Для создания миниатюр можно воспользоваться компонентом <code>x-moonshine::thumbnails</code>
</x-p>

@include("examples/components/thumbnails")

<x-code language="blade" file="resources/views/examples/components/thumbnails.blade.php"></x-code>

<x-p>
    Также можно указать аттрибут <code>alt</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/thumbnails-alt.blade.php"></x-code>

<x-sub-title>Группа изображений</x-sub-title>

<x-p>
    Компоненту можно передать массив изображений
</x-p>

@include("examples/components/thumbnails-multiple")

<x-code language="blade" file="resources/views/examples/components/thumbnails-multiple.blade.php"></x-code>

</x-page>
