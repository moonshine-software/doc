@props([
    'packageName',
    'title' => '',
])

<div x-id="['package-modal']">
    <x-moonshine::modal wide :title="$title">
        <div :id="$id('package-modal')">
            <x-moonshine::loader />
        </div>

        <x-slot name="outerHtml">
            <div x-data="asyncData">
                <a class="stretched-link" @click.prevent="toggleModal; load('{!! str_replace('&amp;', '&', $route) !!}', $id('package-modal'));">
                    {{ $slot ?? '' }}
                </a>
            </div>
        </x-slot>
    </x-moonshine::modal>
</div>
