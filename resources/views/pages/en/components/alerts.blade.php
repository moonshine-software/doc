<x-page title="Alert" :sectionMenu="[]">

<x-p>
    If you need a notification on the page,
    you can use the <code>x-moonshine::alert</code> component
</x-p>

@include("examples/components/alert")

<x-code language="blade" file="resources/views/examples/components/alert.blade.php"></x-code>

<x-sub-title>Notification type</x-sub-title>

<x-p>
    You can change the notification type by specifying the component <code>type</code><br/>
    The following types are available: info, success, warning, error
</x-p>

@include("examples/components/alert-type")

<x-code language="blade" file="resources/views/examples/components/alert-type.blade.php"></x-code>

<x-sub-title>Icon</x-sub-title>

<x-p>
    The notification has the ability to change the icon, for this you need to pass it to the <code>icon</code> parameter
</x-p>

@include("examples/components/alert-icon")

<x-code language="blade" file="resources/views/examples/components/alert-icon.blade.php"></x-code>

<x-p>
    For more information, see <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title>Removing notifications</x-sub-title>

<x-p>
    To remove notifications after some time, you must pass the parameter <code>removable</code> with the value TRUE
</x-p>

@include("examples/components/alert-removable")

<x-code language="blade" file="resources/views/examples/components/alert-removable.blade.php"></x-code>

</x-page>
