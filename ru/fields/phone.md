# Phone

- [Основы](#basics)
- [Маска](#mask)

---

<a name="basics"></a>
## Основы

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поле *Phone* является расширением *Text*, которое по умолчанию устанавливает `type=tel`.

```php
use MoonShine\UI\Fields\Phone;

Phone::make('Phone')
```

<a name="mask"></a>
## Маска

Для использования маски для телефона используйте метод `mask()`.

```php
Phone::make('Phone')
    ->mask('7 999 999-99-99')
```
