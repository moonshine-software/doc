@php
    $next = null;

    collect(config('menu', []))->each(function ($items, $title) use(&$next) {
        foreach ($items as $value) {
            if($next === true) {
                $next = $value;
                $next['label'] = $next['label'] === 'Основы' ? $title : $next['label'];
                break;
            }

            if(request()->route('alias') === $value['slug']) {
                $next = true;
            }
        }
    });
@endphp

@if(isset($next['slug']))
<x-p>
    <x-moonshine::link
        :filled="true"
        href="{{ route('moonshine.custom_page', $next['slug']) }}"
        icon="heroicons.arrow-right"
    >
        {{ __(strtok($next['label'], ':')) }}
    </x-moonshine::link>
</x-p>
@endif
