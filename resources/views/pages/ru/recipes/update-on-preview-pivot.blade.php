<x-recipe id="update-on-preview-pivot" title="{{ $title ?? 'Рецепт' }}">

<x-p>
    Реализация через <em>asyncMethod</em> метод изменения pivot поля на индексной странице:
</x-p>

<x-code language="php">
public function fields(): array
{
    return [
        Grid::make([
            Column::make([
                ID::make()->sortable(),
                Text::make('Team title')->required(),
                Number::make('Team number'),
                BelongsTo::make('Tournament', resource: new TournamentResource())
                    ->searchable(),
            ]),
            Column::make([
                BelongsToMany::make('Users', resource: new UserResource())
                    ->fields([
                        Switcher::make('Approved')
                            ->updateOnPreview(MoonShineRouter::asyncMethodClosure(
                                'updatePivot',
                                params: fn($data) => ['parent' => $data->pivot->tournamen_team_id]
                            )),
                    ])
                    ->searchable(),
            ])
        ])
    ];
}

public function updatePivot(MoonShineRequest $request): MoonShineJsonResponse
{
    $item = TournamentTeam::query()
        ->findOrFail($request->get('parent'));

    $column = (string) $request->str('field')->remove('pivot.');

    $item->users()->updateExistingPivot($request->get('resourceItem'), [
        $column => $request->get('value'),
    ]);

    return MoonShineJsonResponse::make()
        ->toast('Success');
}
</x-code>

</x-recipe>
