<x-page title="Icons" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#size', 'label' => 'Размер'],
        ['url' => '#color', 'label' => 'Цвет'],
        ['url' => '#customization', 'label' => 'Кастомизация'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для вставки иконок в свои кастомные элементы,
    можно воспользоваться компонентом <code>moonshine::icon</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon.blade.php"></x-code>

<x-p>
    @include("examples/components/icon")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Все доступные <x-link link="{{ route('moonshine.page', 'appearance-icons') }}">иконки</x-link>.
</x-moonshine::alert>

<x-sub-title id="size">Размер</x-sub-title>

<x-p>
    С помощью параметра <code>size</code> можно задать размер иконки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-size.blade.php"></x-code>

<x-p>
    @include("examples/components/icon-size")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Значение параметра <code>size</code> соответствует размерам в TailwindCSS.
</x-moonshine::alert>

<x-sub-title id="color">Цвет</x-sub-title>

<x-p>
    С помощью параметра <code>color</code> можно задать цвет иконки.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-color.blade.php"></x-code>

<x-p class="flex">
    @include("examples/components/icon-color")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    По-умолчанию доступно несколько цветов, но вы можете их расширить, используя свои
    <x-link link="{{ route('moonshine.page', 'advanced-assets') }}">классы цветов</x-link> TailwindCSS.
</x-moonshine::alert>

<x-sub-title id="customization">Кастомизация</x-sub-title>

<x-p>
    Произвольный стиль для иконок можно задать через параметр <code>class</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-class.blade.php"></x-code>

<x-p>
    @include("examples/components/icon-class")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Build MoonShine содержит ограниченный перечень классов TailwindCSS.
    Используйте <x-link link="{{ route('moonshine.page', 'advanced-assets') }}">собственные стили</x-link>.
</x-moonshine::alert>

</x-page>
