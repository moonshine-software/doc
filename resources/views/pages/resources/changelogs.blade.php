<x-page title="История изменений" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Чтобы в админ. панеле отображалась история редактирования записей на основе пользователя необходимо
    модели которая используется в ресурсе добавить трейт <code>Leeto\MoonShine\Traits\Models\HasMoonShineChangeLog</code>
</x-p>

<x-code language="php">
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Traits\Models\HasMoonShineChangeLog; // [tl! focus]

class Article extends Model
{
    use HasMoonShineChangeLog; // [tl! focus]

    //...
}
</x-code>

<x-image src="{{ asset('screenshots/changelogs.png') }}"></x-image>

<x-next href="{{ route('section', 'pages-index') }}">Страницы</x-next>

</x-page>
