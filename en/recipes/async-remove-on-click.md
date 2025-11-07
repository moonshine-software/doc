# Asynchronous deletion on click

## Image

```php
protected function formFields(): iterable
{
    return [
        // ...

        Image::make('Avatar')
            ->removable(attributes: [
                'data-async-url' => $this->getRouter()->getEndpoints()->method('removeAvatar', params: ['resourceItem' => $this->getItemID()]),
                '@click.prevent' => <<<'JS'
                    fetch($event.target.closest('button').dataset.asyncUrl).then(() => $event.target.closest('.x-removeable').remove())
                JS
            ]),

        // ...
    ];
}

public function removeAvatar(CrudRequestContract $request): void
{
    $item = $request->getResource()?->getItem();

    if(is_null($item)) {
        return;
    }

    $item->update(['avatar' => null]);
}
```

## Json

```php
protected function formFields(): iterable
{
    return [
        // ...

        Json::make('Data')->fields([
            Text::make('Title'),
        ])->removable(attributes: [
            'data-async-url' => $this->getActivePage()
                ? $this->getRouter()->getEndpoints()->method('removeAvatar', params: ['resourceItem' => $this->getItemID()])
                : null,
            '@click.prevent' => <<<'JS'
                fetch(`${$event.target.closest('a').dataset.asyncUrl}&index=${$event.target.closest('tr').rowIndex}`).then(() => remove())
            JS
        ]),

        // ...
    ];
}

public function removeJsonData(CrudRequestContract $request): void
{
    $item = $request->getResource()?->getItem();
    $index = $request->integer('index') - 1;

    if(is_null($item)) {
        return;
    }

    $data = $item->data->toArray();
    unset($data[$index]);
    sort($data);

    $item->update(['data' => $data]);
}
```
