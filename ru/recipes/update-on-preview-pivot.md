# updateOnPreview для полей pivot

Реализация через `asyncMethod` метода для изменения *pivot* поля на индексной странице:

```php
protected function formFields(): iterable
{
    return [
        Grid::make([
            Column::make([
                ID::make()->sortable(),
                Text::make('Team title')->required(),
                Number::make('Team number'),
                BelongsTo::make('Tournament')->searchable(),
            ]),
            Column::make([
                BelongsToMany::make('Users')->fields([
                    Switcher::make('Approved')->updateOnPreview(
                        $this->getRouter()->getEndpoints()->method('updatePivot', params: fn($data) => ['parent' => $data->pivot->tournamen_team_id])
                    ),
                ])->searchable(),
            ])
        ])
    ];
}

public function updatePivot(MoonShineRequest $request): JsonResponse
{
    $item = TournamentTeam::query()->findOrFail($request->get('parent'));

    $column = (string) $request->str('field')->remove('pivot.');

    $item->users()->updateExistingPivot($request->get('resourceItem'), [
        $column => $request->get('value'),
    ]);

    return JsonResponse::make()->toast('Success');
}
```
