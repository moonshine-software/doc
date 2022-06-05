@foreach($data as $group => $items)
    @php
        $active = false;
        foreach ($items as $item) {
            if(request()->url() == $item['url']) {
                $active = true;
            }
        }
    @endphp

    <div x-data="{open: {{ $active ? 'true' : 'false' }}}">
        <div @click="open=!open" class="flex space-x-2 items-center justify-start cursor-pointer mb-3 {{ $loop->first ? '' : 'mt-8' }} text-sm font-bold uppercase text-gray-500 tracking-widest">
            <span>{{ $group }}</span>

            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>

        <ul x-show="open">
            @foreach($items as $item)
                <li class="md:pr-3">
                    <a href="{{ $item['url'] }}"
                       class="{{ request()->url() == $item['url'] ? 'border-l-4 rounded-r border-purple text-purple pl-3 my-2' : 'text-gray-700' }} inline-block py-2 hover:text-purple hover:underline font-medium"
                    >
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach