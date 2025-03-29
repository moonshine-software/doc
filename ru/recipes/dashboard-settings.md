# Сохранение настроек в Dashboard

```php
private function getSetting(): Setting
{
    return Setting::query()->find(1);
}

public function store(): MoonShineJsonResponse
{
    $this->form()->apply(fn(Setting $item) => $item->save());

    return MoonShineJsonResponse::make()->toast('Saved');
}

private function form(): FormBuilder
{
    return FormBuilder::make()
        ->asyncMethod('store')
        ->fillCast($this->getSetting(), new ModelCaster(Setting::class))
        ->fields([
          // Fields here
        ])
    ;
}

protected function components(): iterable
{
  yield $this->form();
}
```
