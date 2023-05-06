<x-page title="Icons" :sectionMenu="[]">

<x-p>
    Для вставки иконок в свои кастомные элементы,
    можно воспользоваться компонентом <code>x-moonshine::icon</code>
</x-p>

@include("examples/components/icon")

<x-code language="blade" file="resources/views/examples/components/icon.blade.php"></x-code>

<x-p>
    Все доступные <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">иконки</x-link>
</x-p>

<x-sub-title>Размер</x-sub-title>

<x-p>
    С помощью параметра <code>size</code> можно задать размер иконки.
</x-p>

@include("examples/components/icon-size")

<x-code language="blade" file="resources/views/examples/components/icon-size.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Значение параметра size соответствует размерам в tailwindcss
</x-moonshine::alert>

<x-sub-title>Цвет</x-sub-title>

<x-p>
    С помощью параметра <code>color</code> можно задать цвет иконки
</x-p>

<x-p class="flex">
    @include("examples/components/icon-color")
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-color.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По умолчанию доступно несколько цветов, но вы можете их расширить используя свои
    <x-link link="{{ route('moonshine.custom_page', 'advanced-assets') }}">классы цветов</x-link> tailwindcss
</x-moonshine::alert>

<x-sub-title>Кастомизация</x-sub-title>

<x-p>
    Произвольный стиль для иконок можно задать через параметр <code>class</code>
</x-p>

<x-p>
    @include("examples/components/icon-class")
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-class.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Build MoonShine содержит ограниченный перечень классов tailwindcss,
    используйте <x-link link="{{ route('moonshine.custom_page', 'advanced-assets') }}">собственные стили</x-link>
</x-moonshine::alert>

</x-page>
