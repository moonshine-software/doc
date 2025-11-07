# Select

В данном разделе мы собрали разные нестандартные подходы использования `Select`, которые вы можете модернизировать под свои нужды.

## Async

Пример демонстрирует метод `async`, но при этом мы используем подход работы через `asyncMethod`.
Тем самым экономим время на создание контроллера и пишем реализацию прямо в ресурсе (или на странице):

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

За счет того, что по умолчанию `ShowWhen` удаляет скрытые элементы из `DOM` мы можем дублировать несколько `Select` с разными значениями и отображать их по условию

> [!NOTE]
> Мы добавили `setNameAttribute`, чтобы не было конфликта при сохранении формы

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

Подход, в котором при изменении основного `Select` мы отправляем запрос и возвращаем `html` следующего `Select`, отображаем его в блоке по селектору:

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

Благодаря тому что `Fragment` вместе с запросом отправляет данные формы, мы при перезагрузке фрагмента можем изменить набор элементов `Select`:

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
