@php
    $menuItems = collect(config('menu', []))
        ->reject(function ($items) {
            return !is_array($items);
        })
        ->map(function (array $items, $key) {
            return collect($items)
                ->reject(function ($item) {
                    return !is_array($item);
                })
                ->map(function (array $item) use ($key) {
                    $item['section'] = str($key)->before(':')->value();
                    return $item;
                })->all();
        })
        ->collapse();

    $current = $menuItems->search(function (array $item) {
        return request()->route('alias') === $item['slug'];
    });

    $prevItem = $menuItems->slice(0, $current)->last() ?? null;
    $nextItem = $menuItems->slice($current + 1)->first() ?? null;
@endphp

<div class="sm:flex justify-between mt-8">
    <x-page-link type="prev" :item="$prevItem" />
    <x-page-link type="next" :item="$nextItem" />
</div>
