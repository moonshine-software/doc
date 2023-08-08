@php
    $items = range(0, 41);
    $paginate = 10;
    $page = request()->input('page') ?? 1;
    $offSet = $paginate * ($page - 1);
    $itemsForCurrentPage = array_slice($items, $offSet, $paginate, true);

    $paginator = new Illuminate\Pagination\LengthAwarePaginator (
        $itemsForCurrentPage,
        count($items),
        $paginate,
        null,
        [
            'path' => ''
        ]
    );
@endphp

{{ $paginator->links(($simple ?? false) ? 'examples.components.pagination-simple' : 'examples.components.pagination') }}
