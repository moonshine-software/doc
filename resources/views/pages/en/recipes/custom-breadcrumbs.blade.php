<x-recipe id="custom-breadcrumbs" title="{{ $title ?? 'Recipe' }}">

<x-p>
    You can change page breadcrumbs directly from the resource.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...

    protected function onBoot(): void
    {
        $this->formPage()
            ->setBreadcrumbs([
                '#' => $this->title()
            ]); // [tl! focus:-2]
    }

    //...
}
</x-code>

</x-recipe>
