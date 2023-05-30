<x-page title="Alert" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#type', 'label' => 'Notification type'],
        ['url' => '#icon', 'label' => 'Icon'],
        ['url' => '#removable', 'label' => 'Removing notifications'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    If you need a notification on the page,
    you can use the <code>moonshine::alert</code> component
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert.blade.php"></x-code>

@include("examples/components/alert")

<x-sub-title id="type">Notification type</x-sub-title>

<x-p>
    You can change the notification type by specifying the component <code>type</code>
</x-p>

@include('pages.en.components.shared.type')

<x-code language="blade" file="resources/views/examples/components/alert-type.blade.php"></x-code>

@include("examples/components/alert-type")

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    The notification has the ability to change the icon, for this you need to pass it to the <code>icon</code> parameter
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert-icon.blade.php"></x-code>

@include("examples/components/alert-icon")

<x-p>
    For more information, see <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title id="removable">Removing notifications</x-sub-title>

<x-p>
    To remove notifications after some time, you must pass the parameter <code>removable</code>
    with the value <code>TRUE</code>
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert-removable.blade.php"></x-code>

@include("examples/components/alert-removable")

</x-page>
