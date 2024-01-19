<x-page title="Alert" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#type', 'label' => 'Notification type'],
        ['url' => '#icon', 'label' => 'Icon'],
        ['url' => '#removable', 'label' => 'Deleting notifications'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    If you need a notification on the page,
    you can use the <code>moonshine::alert</code> component.
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert.blade.php"></x-code>

@include("examples/components/alert")

<x-sub-title id="type">Notification type</x-sub-title>

<x-p>
    You can change the notification type by specifying the <code>type</code> component.
</x-p>

@include('pages.en.ui.shared.type')

<x-code language="blade" file="resources/views/examples/components/alert-type.blade.php"></x-code>

@include("examples/components/alert-type")

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    It is possible for a notification to change its icon; to do this, you need to pass it to the <code>icon</code> parameter.
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert-icon.blade.php"></x-code>

@include("examples/components/alert-icon")

@include('pages.en.shared.alert_icons')

<x-sub-title id="removable">Deleting notifications</x-sub-title>

<x-p>
    To remove notifications after some time, you need to pass the <code>removable</code> parameter
    with the value <code>TRUE</code>.
</x-p>

<x-code language="blade" file="resources/views/examples/components/alert-removable.blade.php"></x-code>

@include("examples/components/alert-removable")

</x-page>
