@props([
    'type' => 'prev',
    'item' => null,
])

@if(isset($item['slug']))
    <a href="{{ route('moonshine.page', $item['slug']) }}"
       class="my-4 btn h-auto p-4 flex flex-row items-center justify-between gap-4 page-link
       {{ $type === 'prev' ? 'page-link__prev' : 'page-link__next' }}"
    >
        <div>
            <div class="text-2xs text-slate-500">{{ __($item['section'] ?? '') }}</div>
            <div class="text-xl font-bold">{{ __($item['label'] ?? '') }}</div>
        </div>
        <x-moonshine::icon icon="{{ $type === 'prev' ? 'heroicons.arrow-left' : 'heroicons.arrow-right' }}" size="8"/>
    </a>
@else
    <div></div>
@endif
