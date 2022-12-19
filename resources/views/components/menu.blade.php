<nav
    @if(request()->path() !== '/')
        x-init="$refs['{{ request()->path() }}'].scrollIntoView()"
    @endif
     class="text-base lg:text-sm w-64 pl-2 pr-8 xl:w-72 xl:pr-16"
>
    <ul role="list" class="space-y-9">
        @foreach($data as $group => $items)
            @php
                $active = false;
                foreach ($items as $item) {
                    if(request()->url() == $item['url']) {
                        $active = true;
                    }
                }
            @endphp

            <li>
                <h2 class="font-display font-medium text-slate-900 dark:text-white">{{ $group }}</h2>
                <ul role="list" class="mt-2 space-y-2 border-l-2 border-slate-100 dark:border-slate-800 lg:mt-4 lg:space-y-4 lg:border-slate-200">
                    @foreach($items as $item)
                        <li class="relative" x-ref="{{ Str::of($item['url'])->remove(env('APP_URL'))->slug() }}">
                            <a class="{{ request()->url() == $item['url'] ? 'font-semibold text-purple before:bg-purple' : 'text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block dark:text-slate-400 dark:before:bg-slate-700 dark:hover:text-slate-300'}} block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full"
                            href="{{ $item['url'] }}">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</nav>
