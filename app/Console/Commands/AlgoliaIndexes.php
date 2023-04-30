<?php

namespace App\Console\Commands;

use Algolia\AlgoliaSearch\Exceptions\MissingObjectId;
use Algolia\AlgoliaSearch\SearchClient;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuSection;
use MoonShine\MoonShine;
use MoonShine\Resources\CustomPage;
use Throwable;

class AlgoliaIndexes extends Command
{
    protected $signature = 'algolia:indexes';

    /**
     * @throws MissingObjectId
     */
    public function handle(): int
    {
        $client = SearchClient::create(
            config('algolia.app_id'),
            config('algolia.admin_key')
        );

        $documents = collect();

        foreach (config('moonshine.locales') as $locale) {
            MoonShine::getMenu()->each(function (MenuSection $groupOrItem) use ($locale, $documents) {
                $icon = $this->getDocumentIcon($groupOrItem);

                if ($groupOrItem->isGroup()) {
                    $section = $groupOrItem->label();

                    $groupOrItem->items()->each(function (MenuItem $item) use ($locale, $icon, $section, $documents) {
                        $documents->push(
                            $this->extractDocument(
                                $item->page() ?: $item,
                                $item->url(),
                                $item->label(),
                                $icon,
                                $locale,
                                $section
                            )
                        );

                        $this->resourceItems($item, $icon, $locale, $documents);
                    });
                } else {
                    $documents->push(
                        $this->extractDocument(
                            $groupOrItem->page() ?: $groupOrItem,
                            $groupOrItem->url(),
                            $groupOrItem->label(),
                            $icon,
                            $locale
                        )
                    );

                    $this->resourceItems($groupOrItem, $icon, $locale, $documents);
                }
            });

            $client
                ->initIndex("moonshine_search_index_$locale")
                ->saveObjects(
                    $documents->toArray()
                );
        }

        return self::SUCCESS;
    }

    private function resourceItems(MenuSection $groupOrItem, string $icon, string $locale, &$documents): void
    {
        if ($resource = $groupOrItem->resource()) {
            $resourceItems = $resource->query()->get();

            foreach ($resourceItems as $resourceItem) {
                $resource->setItem($resourceItem);
                $icon = $this->getDocumentIcon($resourceItem) ?? $icon;

                $documents->push(
                    $this->extractDocument(
                        $resourceItem,
                        $resource->route('show', $resourceItem->getKey()),
                        $resourceItem->{$resource->titleField() ?? $resourceItem->getKeyName()},
                        $icon,
                        $locale
                    )
                );
            }
        }
    }

    private function extractDocument(
        MenuSection|Model|CustomPage $groupOrItem,
        string $url,
        string $title,
        string $icon,
        string $locale,
        string $section = ''
    ): array {
        return [
            'objectID' => $this->getDocumentID($groupOrItem),
            'url' => $url,
            'title' => __($title, locale: $locale),
            'section' => $section,
            'description' => $this->getDocumentDescription($groupOrItem, $locale),
            'icon' => $icon
        ];
    }

    private function getDocumentID(MenuSection|Model|CustomPage $item): string
    {
        if ($item instanceof Model) {
            return str(class_basename($item))
                ->slug('_')
                ->append('_')
                ->append($item->getKey())
                ->value();
        }

        return str($item->url())
            ->remove('//')
            ->after('/')
            ->replace('/', '_')
            ->slug('_')
            ->value();
    }

    private function getDocumentIcon(MenuSection|Model $groupOrItem): string
    {
        if ($groupOrItem instanceof MenuSection) {
            return view('moonshine::components.icon', [
                'icon' => $groupOrItem->iconValue(),
                'color' => 'purple',
                'size' => 6
            ])->render();
        }

        return method_exists($groupOrItem, 'globalSearch')
            ? ($groupOrItem->globalSearch()['icon'] ?? '')
            : '';
    }

    private function getDocumentDescription(MenuSection|Model|CustomPage $item, string $locale): string
    {
        if ($item instanceof CustomPage) {
            return str($this->getPageContent($item->alias(), $locale))
                ->stripTags()
                ->squish()
                ->replaceMatches('/\#\#PRE_TL_COMPONENT\#\#.+?\#\#POST_TL_COMPONENT\#\#/', '')
                ->value();
        }

        return method_exists($item, 'globalSearch')
            ? ($item->globalSearch()['description'] ?? '')
            : '';
    }

    private function getPageContent(string $slug, string $locale = 'en'): string
    {
        $view = "pages.".$locale.".".str_replace('-', '.', $slug);

        if (!view()->exists($view)) {
            $view = 'translation-in-progress';
        }

        try {
            $response = view($view)->render();
        } catch (Throwable) {
            $response = '';
        }

        return $response;
    }
}
