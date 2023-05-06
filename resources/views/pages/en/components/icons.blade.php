<x-page title="Icons" :sectionMenu="[]">

<x-p>
    To insert icons into your custom elements,
    you can use the <code>x-moonshine::icon</code> component
</x-p>

@include("examples/components/icon")

<x-code language="blade" file="resources/views/examples/components/icon.blade.php"></x-code>

<x-p>
    All available <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">icons</x-link>
</x-p>

<x-sub-title>Size</x-sub-title>

<x-p>
    Using the <code>size</code> parameter, you can set the size of the icon.
</x-p>

@include("examples/components/icon-size")

<x-code language="blade" file="resources/views/examples/components/icon-size.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The value of the size parameter corresponds to the sizes in tailwindcss
</x-moonshine::alert>

<x-sub-title>Color</x-sub-title>

<x-p>
    Using the <code>color</code> parameter, you can set the color of the icon
</x-p>

<x-p class="flex">
    @include("examples/components/icon-color")
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-color.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Several colors are available by default, but you can expand them using your own
    <x-link link="{{ route('moonshine.custom_page', 'advanced-assets') }}">color classes</x-link> tailwindcss
</x-moonshine::alert>

<x-sub-title>Customization</x-sub-title>

<x-p>
    An arbitrary style for icons can be set via the <code>class</code> parameter
</x-p>

<x-p>
    @include("examples/components/icon-class")
</x-p>

<x-code language="blade" file="resources/views/examples/components/icon-class.blade.php"></x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Build MoonShine contains a limited list of tailwindcss classes,
    use <x-link link="{{ route('moonshine.custom_page', 'advanced-assets') }}">custom styles</x-link>
</x-moonshine::alert>

</x-page>
