@props([
    'items' => []
])

<ul {{ $attributes->merge(['class' => 'list-marker my-4']) }}>
    @foreach($items as $item)
    <li>{{ $item }}</li>
    @endforeach
    {!! $slot !!}
</ul>
