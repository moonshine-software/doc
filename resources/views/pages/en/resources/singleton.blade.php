<x-page title="Singleton" :sectionMenu="$sectionMenu ?? null">

<x-p>
    A resource for one entry without the ability to list, add and delete! Perfect for resources with settings.
    Implements singletonResource in Laravel routing.
</x-p>

<x-p>
    To use it, you need to implement the getId method specifying the id of the record in the database.
</x-p>

<x-code language="php">
// ...

class SettingResource extends SingletonResource
{
    public static string $model = Setting::class;

    public static string $title = 'Settings';

    public function getId(): int|string
    {
        return 1;
    }
// ...
</x-code>

<x-p>
    You can create <code>SingletonResource</code> using the artisan command
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --singleton
</x-code>

<x-p>
    or
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --s
</x-code>

<x-p>
    with id
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --s --id=1
</x-code>

</x-page>
