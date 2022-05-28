@foreach($data as $group => $items)
    <div class="mb-3 {{ $loop->first ? '' : 'mt-8' }} text-sm font-bold uppercase text-gray-500 tracking-widest">
        {{ $group }}
    </div>

    <ul>
        @foreach($items as $item)
            <li class="md:pr-3">
                <a href="{{ $item['url'] }}"
                   class="{{ request()->url() == $item['url'] ? 'border-l-4 rounded-r border-purple text-purple pl-3 my-2' : 'text-gray-700' }} inline-block py-1 md:py-2 hover:text-purple hover:underline font-medium"
                >
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endforeach