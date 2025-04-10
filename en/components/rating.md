# Rating

The `Rating` component allows you to create styled ratings.

```php
make(
    int $value,
    int $min = 1,
    int $max = 5,
)
```
- `$value` - rating value,
- `$min` - minimum value,
- `$max` - maximum value.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Rating;

Rating::make(3, 1, 10)
```
tab: Blade
```blade
<x-moonshine::rating value="8" min="1" max="10" />
```
~~~
