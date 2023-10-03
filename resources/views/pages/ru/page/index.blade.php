<x-page title="Страницы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <em>Page</em> - это основа админ-панели <strong>MoonShine</strong>. Основой задачей <em>Page</em> является
    отображение компонентов, которые могут быть как компоненты самой админ-панели, так и просто <em>blade</em> компоненты,
    и даже компоненты <em>Livewire</em>.
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        FormBuilder::make()->fields([
            Block::make([
                Grid::make([
                    Column::make([
                        Heading::make('Text'),

                        ID::make(),
                        Hidden::make('Hidden'),

                    ])->columnSpan(6),
                    Column::make([
                        Heading::make('Textarea'),

                        Textarea::make('Textarea'),
                        TinyMce::make('TinyMce'),
                    ])->columnSpan(6),
                ]),

                LineBreak::make(),
            ]),
        ])->submit('Submit', ['class' => 'btn-lg btn-primary']),
    ];
}
</x-code>

</x-page>
