# Color

Для отображения html блока `<div>`, закрашенным определенным цветом, можно использовать компонент `Color`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\Color as ColorEnum;

make(string|ColorEnum $color)
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Color as ColorEnum;
use MoonShine\UI\Components\Color;

Color::make(ColorEnum::PURPLE)
```
tab: Blade
```blade
<x-moonshine::color :color="'red'"/>
```
~~~

Доступные значения в enum `MoonShine\Support\Enums\Color`:

```php
enum Color: string
{
    case PRIMARY = 'primary';

    case SECONDARY = 'secondary';

    case SUCCESS = 'success';

    case ERROR = 'error';

    case WARNING = 'warning';

    case INFO = 'info';

    case PURPLE = 'purple';

    case PINK = 'pink';

    case BLUE = 'blue';

    case GREEN = 'green';

    case YELLOW = 'yellow';

    case RED = 'red';

    case GRAY = 'gray';
}
```
