<x-p>
    Метод <code>columnSpan()</code> позволяет задать ширину блока в <em>Grid</em> сетке.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-code language="php">
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\{{ $metric }};

//...

public function components(): array
{
    return [
        Grid::make([ // [tl! focus]
            {{ $metric }}::make('Articles')
@if( $metric === 'ValueMetric')
                ->value(Article::count())
@elseif( $metric === 'LineChartMetric')
                ->line([
                    'Count' => [
                        now()->format('Y-m-d') => 3,
                        now()->addDay()->format('Y-m-d') => 5
                    ]
                ])
@endif
                ->columnSpan(6), // [tl! focus]
            {{ $metric }}::make('Comments')
@if( $metric === 'ValueMetric')
                ->value(Comment::count())
@elseif( $metric === 'LineChartMetric')
                ->line([
                    'Count' => [
                        now()->format('Y-m-d') => 53,
                        now()->addDay()->format('Y-m-d') => 22
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
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'components-decoration_layout') }}">Декорация Layout</x-link>.
</x-moonshine::alert>


<x-image theme="light" src="{{ asset('screenshots/' . str($metric)->snake('_')->append('_column_span.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($metric)->snake('_')->append('_column_span_dark.png')) }}"></x-image>
