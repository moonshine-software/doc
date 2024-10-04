# Phone

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поле *Phone* является расширением *Text*, которое по умолчанию устанавливает `type=tel`.

```php
use MoonShine\UI\Fields\Phone;

Phone::make()
```

> [!TIP]
> Для маски телефона воспользуйтесь методом mask('7 999 999-99-99')