<x-page title="Icons" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#size', 'label' => 'Size'],
        ['url' => '#color', 'label' => 'Color'],
        ['url' => '#customization', 'label' => 'Customization'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To insert icons into your custom elements,
    you can use the <code>moonshine::icon</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon.blade.php"></x-code>

<x-p>
    @include("examples/components/icon")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    All available <x-link link="{{ route('moonshine.page', 'icons') }}">icons</x-link>.
</x-moonshine::alert>

<x-sub-title id="size">Size</x-sub-title>

<x-p>
    Using the <code>size</code> parameter you can set the size of the icon.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-size.blade.php"></x-code>

<x-p>
    @include("examples/components/icon-size")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    The value of the <code>size</code> parameter corresponds to the dimensions in TailwindCSS.
</x-moonshine::alert>

<x-sub-title id="color">Color</x-sub-title>

<x-p>
    Using the <code>color</code> parameter you can set the color of the icon.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-color.blade.php"></x-code>

<x-p class="flex">
    @include("examples/components/icon-color")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    There are several colors available by default, but you can expand them using your own
    <x-link link="{{ route('moonshine.page', 'appearance-assets') }}">color classes</x-link> TailwindCSS.
</x-moonshine::alert>

<x-sub-title id="customization">Customization</x-sub-title>

<x-p>
    A custom style for icons can be set using the <code>class</code> parameter.
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-class.blade.php"></x-code>

<x-p>
    @include("examples/components/icon-class")
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Build MoonShine contains a limited list of TailwindCSS classes.
    Use <x-link link="{{ route('moonshine.page', 'advanced-assets') }}">custom styles</x-link>.
</x-moonshine::alert>

</x-page>
