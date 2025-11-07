# Select

In this section, we have gathered various non-standard approaches to using `Select`, which you can modernize for your needs.

## Async

The example demonstrates the `async` method, but at the same time, we use the approach of working through `asyncMethod`, thus saving time on creating a controller and writing the implementation directly in the resource or page:

```php
protected function formFields(): iterable
{
    return [
        Select::make('Select')->async(
            $this->getAsyncMethodUrl('selectOptions'),
        )->asyncOnInit(),
    ]
}

public function selectOptions(): JsonResponse
{
    $options = new Options([
        new Option(label: 'Option 1', value: '1', selected: true, properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
        new Option(label: 'Option 2', value: '2', properties: new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
    ]);

    return JsonResponse::make(data: $options->toArray());
}
```

## Reactive

```php
Select::make('Company', 'company')->options([
    1 => 'Laravel',
    2 => 'CutCode',
    3 => 'Symfony',
])->reactive(function (FieldsContract $fields, mixed $value, Select $ctx, array $values): FieldsContract {
    $fields->findByColumn('dynamic_value')?->options((int) $value === 1 ? [
        4 => 4,
    ] : [2 => 2]);

    return $fields;
}),

Select::make('Dynamic value', 'dynamic_value')->options([4 => 4])->reactive(),
```

## ShowWhen

Due to the fact that by default `ShowWhen` removes hidden elements from the `DOM`, we can duplicate several `Select` with different values and display them based on a condition.

> [!NOTE]
> We added `setNameAttribute` to avoid conflict when saving the form.

```php
Select::make('Company', 'company')->options([
    1 => 'Laravel',
    2 => 'CutCode',
    3 => 'Symfony',
]),

Select::make('Dynamic value', 'dynamic_value')
    ->setNameAttribute('dynamic_value_1')
    ->showWhen('company', '1')
    ->options([1 => 1, 2 => 2,]),

Select::make('Dynamic value', 'dynamic_value')
    ->setNameAttribute('dynamic_value_2')
    ->showWhen('company', '2')
    ->options([3 => 3, 4 => 4,]),
```

## onChangeMethod

This approach allows you to send a request when the main `Select` is changed and return the `html` for the next `Select`, displaying it in the block by selector:

```php
public function selectValues(): JsonResponse
{
    $options = new Options([
        new Option('Option 1', '1', false, new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
        new Option('Option 2', '2', true, new OptionProperty(image: 'https://cutcode.dev/images/platforms/youtube.png')),
    ]);

    return JsonResponse::make()
        ->html(
            (string) Select::make('Next')->options($options)
        );
}

protected function formFields(): iterable
{
    return [
        Select::make('Select')->options([
            1 => 1,
            2 => 2,
        ])->onChangeMethod('selectValues', selector: '.next-select'),

        Div::make()->class('next-select'),
    ];
}
```

## Fragments

Thanks to the fact that `Fragment` sends form data along with the request, we can change the set of `Select` elements upon reloading the fragment:

```php
protected function formFields(): iterable
{
    $selects = [];
    $value = request()->integer('_data.first', 1);

    if($value === 1) {
        $selects[] = Select::make('Second')->options([
            1 => 1,
            2 => 2,
        ]);
    }

    if($value === 2) {
        $selects[] = Select::make('Third')->options([
            1 => 1,
            2 => 2,
        ]);
    }

    return [
        Fragment::make([
            Select::make('First')->options([
                1 => 1,
                2 => 2,
            ])->setValue($value)->onChangeEvent(
                AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'selects')
            ),

            ...$selects,
        ])->name('selects'),
    ];
}
```
