<x-page
    title="Маршруты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Маршруты ресурса'],
            ['url' => '#resolve', 'label' => 'Кастомные маршруты'],
        ]
    ]"
>

<x-sub-title id="basics">Маршруты ресурса</x-sub-title>

<x-p>
    В MoonShine у ресурса для различных действий зарегистрировано множество маршрутов:
</x-p>

<x-code language="php">
$this->route('index'); // GET|HEAD - список записей
$this->route('create'); // GET|HEAD - создание новой записи
$this->route('store'); // POST - сохранение новой записи
$this->route('edit', $resourceItem); // GET|HEAD - редактирование записи
$this->route('update', $resourceItem); // PUT|PATCH - сохранение записи
$this->route('destroy', $resourceItem); // DELETE - удаление записи
$this->route('show', $resourceItem); // GET|HEAD - просмотр записи
$this->route('query-tag', $queryTag); // GET|HEAD - список записей с применением быстрого фильтра / тега
$this->route('update-column', $resourceItem); // PUT - сохранение поля записи
</x-code>

<x-sub-title id="resolve">Кастомные маршруты</x-sub-title>

<x-p>
    Через метод <code>resolveRoutes()</code> можно добавить или переопределить маршрут.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    // ...

    public function resolveRoutes(): void // [tl! focus:start]
    {
        parent::resolveRoutes();

        Route::prefix('resource')->group(function (): void {
            Route::get("{$this->uriKey()}/restore/{resourceItem}", function (Post $item) {
                $item->restore();

                return redirect()->back();
            });
        });
    } // [tl! focus:end]

    // ...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Для доступа к маршруту вне ресурса можно следующим способом <code>(new Resource())->route('index')</code>.
</x-moonshine::alert>

</x-page>
