@php
    $next = null;

    if(isset($menu)) {
        collect($menu)->each(function ($items, $title) use(&$next) {
            foreach ($items as $value) {
                if($next === true) {
                    $next = $value;
                    $next['label'] = $next['label'] === 'Основы' ? $title : $next['label'];
                    break;
                }

                if($value['url'] === request()->url()) {
                    $next = true;
                }
            }

        });
    }
@endphp

@if(isset($next['url']))
<x-divide></x-divide>

<div class="w-100 clear-both">
    <a
            href="{{ $next['url'] }}"
            class="no-underline flex space-x-3 items-center justify-between my-6 inline-block px-8 py-3 bg-transparent border border-purple rounded-sm shadow-sm text-purple float-right"
    >
        <span>{{ $next['label'] }}</span>

        <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
    </a>
</div>
@endif
