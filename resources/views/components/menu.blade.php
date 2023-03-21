@props([
    'data' => []
])
<ul>
    @foreach($data as $group => $items)
        <li class="space-y-2">
            <div>{{ $group }}</div>
            <ul class="inline-flex gap-2 flex-wrap">
                @foreach($items as $item)
                    <li>
                        <x-moonshine::link href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </x-moonshine::link>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
