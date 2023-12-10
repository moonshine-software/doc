<x-p>
    The <code>columnSpan()</code> method allows you to set the width of a block in a <em>Grid</em> grid.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-p>
    <code>$columnSpan</code> - value for desktop version,<br>
    <code>$adaptiveColumnSpan</code> - meaning for the mobile version.
</x-p>

<x-code language="php">
use App\Models\Article;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\{{ $metric }};

//...

public function components(): array
{
    return [
        Grid::make([ // [tl! focus]
            {{ $metric }}::make({{ $metric === 'DonutChartMetric' ? 'Subscribers' : 'Articles' }})
@if( $metric === 'ValueMetric')
                ->value(Article::count())
@elseif( $metric === 'DonutChartMetric')
                ->values(['CutCode' => 10000, 'Apple' => 9999])
@elseif( $metric === 'LineChartMetric')
                ->line([
                    'Count' => [
                        now()->subDays()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
@endif
                ->columnSpan(6), // [tl! focus]
            {{ $metric }}::make( {{ $metric === 'DonutChartMetric' ? 'Tasks' : 'Comments' }})
@if( $metric === 'ValueMetric')
                ->value(Comment::count())
@elseif( $metric === 'DonutChartMetric')
                ->values(['New' => 234, 'Done' => 421])
@elseif( $metric === 'LineChartMetric')
                ->line([
                    'Count' => [
                        now()->subDays()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
@endif
                ->columnSpan(6) // [tl! focus]
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') }}">Decoration Layout</x-link>.
</x-moonshine::alert>


<x-image theme="light" src="{{ asset('screenshots/' . str($metric)->snake('_')->append('_column_span.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($metric)->snake('_')->append('_column_span_dark.png')) }}"></x-image>
