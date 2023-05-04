<x-page title="Alert" :sectionMenu="[]">

<x-p>
    Если вам необходимо уведомление на странице,
    можно воспользоваться компонентом <code>x-moonshine::alert</code>
</x-p>

@include("examples/components/alert")

<x-code language="blade" file="resources/views/examples/components/alert.blade.php"></x-code>

<x-sub-title>Тип уведомления</x-sub-title>

<x-p>
    Изменить тип уведомления можно указав у компонента <code>type</code><br/>
    Доступны следующие типы: info, success, warning, error
</x-p>

@include("examples/components/alert-type")

<x-code language="blade" file="resources/views/examples/components/alert-type.blade.php"></x-code>

<x-sub-title>Иконка</x-sub-title>

<x-p>
    У уведомления есть возможность изменить иконку, для этого необходимо передать ее в параметр <code>icon</code>
</x-p>

@include("examples/components/alert-icon")

<x-code language="blade" file="resources/views/examples/components/alert-icon.blade.php"></x-code>

<x-p>
    За более подробной информацией, обратитесь к разделу <x-link link="{{ route('moonshine.custom_page', 'icons-index') }}">Icons</x-link>
</x-p>

<x-sub-title>Удаление уведомлений</x-sub-title>

<x-p>
    Чтобы удалять уведомления через некоторое время, необходимо передать параметр <code>removable</code> со значением TRUE
</x-p>

@include("examples/components/alert-removable")

<x-code language="blade" file="resources/views/examples/components/alert-removable.blade.php"></x-code>

</x-page>
