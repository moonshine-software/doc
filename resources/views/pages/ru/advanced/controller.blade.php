<x-page title="Controllers" :sectionMenu="null">
<x-p>
    В MoonShine есть возможность работать в привычной манере с использованием контроллеров
</x-p>

<x-p>
    Мы предоставляем вам свой базовый контроллер, который помогает удобно работать с UI и
    рендерить свои view с MoonShine layout
</x-p>

<x-p>
    Полезно для отображения своих сложных решений или написания дополнительных обработчиков
</x-p>

<x-sub-title>Отобразить страницу</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        return $this
            ->view('path_to_blade', ['param' => 'value'])
            //->setLayout('custom_layout')
            ->render();
    }
}
</x-code>

<x-sub-title>Вывести уведомление</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        $this->toast('Hello world');

        return back();
    }
}
</x-code>

<x-sub-title>Отправить уведомление</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        $this->notification('Message');

        return back();
    }
}
</x-code>

<x-sub-title>Получить доступ к странице или ресурсу</x-sub-title>

<x-code>
namespace App\MoonShine\Controllers;

use MoonShine\MoonShineRequest;
use MoonShine\Http\Controllers\MoonshineController;
use Symfony\Component\HttpFoundation\Response;

final class CustomViewController extends MoonshineController
{
    public function __invoke(MoonShineRequest $request): Response
    {
        // $request->getPage();
        // $request->getResource();
    }
}
</x-code>
</x-page>
