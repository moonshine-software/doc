# Boolean

Component for creating an indicator TRUE | FALSE.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Boolean;

Boolean::make(true);
Boolean::make(false);
```
tab: Blade
```blade
<x-moonshine::boolean :value="true" />
<x-moonshine::boolean :value="false" />
```
~~~

@preview('boolean')
