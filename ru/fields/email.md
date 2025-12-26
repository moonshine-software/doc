# E-mail

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поле `Email` является расширением `Text`, которое по умолчанию устанавливает `type=email`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Email;

Email::make('Email')
```

@preview('fields.email')
