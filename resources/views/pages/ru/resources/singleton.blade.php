<x-page title="Singleton" :sectionMenu="$sectionMenu ?? null">

<x-p>
    <code>SingletonResource</code> - ресурс на одну запись без возможности вывода списка, добавления и удаления!
    Идеально подходит для ресурсов с настройками. Реализует одноэлементный ресурс в маршрутизации Laravel.
</x-p>

<x-p>
    Для его использования необходимо реализовать метод getId с указанием id записи в базе данных.
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
    Создать <code>SingletonResource</code> можно используя команду artisan
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --singleton
</x-code>

<x-p>
    или
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --s
</x-code>

<x-p>
    с указанием id
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Setting --s --id=1
</x-code>

</x-page>
