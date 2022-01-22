<?php namespace KitSoft\Pages\Install\Items;

use Artisan;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Settings;
use October\Rain\Support\Collection;

class PagesInstaller extends AbstractInstaller implements InstallerInterface
{
    use \KitSoft\Pages\Traits\Seeder;

    /**
     * install
     */
    public function install(): void
    {
        $pages = collect();

        if (!isset($this->config['items'])) {
            return;
        }

        foreach ($this->config['items'] as $key => $row) {
            $pages = $pages->merge($this->createPageWithChilds($key, $row));
        }

        $this->setComponentsRouterParams($pages);
        $this->setSectionsRouterParams($pages);

        if (isset($this->config['routes'])) {
            $this->setRoutes($this->config['routes']);
        }
    }

    /**
     * createPageWithChilds
     */
    protected function createPageWithChilds(string $code, array $params): Collection
    {
        $pages = collect();

        $query = Page::where('slug', $params['attributes']['slug']);

        if (isset($params['attributes']['parent_id'])) {
            $query = $query->where('parent_id', $params['attributes']['parent_id']);
        }

        if (!$page = $query->first()) {
            $components = [];
            foreach ($params['components'] ?? [] as $key => $row) {
                $components[] = $this->createComponent(
                    $key,
                    $row['class'],
                    $row['attributes'] ?? [],
                    $row['published'] ?? true
                );
            }

            $sections = [];
            foreach ($params['sections'] ?? [] as $key => $row) {
                $sections[] = $this->createSection(
                    $row['code'] ?? $key,
                    $row['name'],
                    $row['attributes'] ?? [],
                    $row['published'] ?? true
                );
            }

            $page = $this->createPage(
                $params['attributes'],
                collect($components)->lists('id'),
                collect($sections)->lists('id')
            );
        }
        
        $pages->push($page);

        if (isset($params['childs'])) {
            foreach ($params['childs'] as $key => $row) {
                $row['attributes']['parent_id'] = $page->id;
                $pages = $pages->merge($this->createPageWithChilds($key, $row));
            }
        }

        return $pages;
    }

    /**
     * setComponentsRouterParams
     */
    protected function setComponentsRouterParams(Collection $pages): void
    {
        $pages->each(function ($page) {
            $page->components->each(function ($component) {
                foreach ($component->properties ?? [] as $key => $row) {
                    if (!is_string($row)) {
                        continue;
                    }
                    
                    if (substr($row, 0, 6) != 'slug::') {
                        continue;
                    }

                    $slug = substr($row, 6);
                    $page = PagesHelper::getPageBySegments(explode('/', $slug));
                    $component->properties = array_merge($component->properties, [
                        $key => $page ? $page->id : null
                    ]);

                    $component->save();
                }
            });
        });
    }

    /**
     * setSectionsRouterParams
     */
    protected function setSectionsRouterParams(Collection $pages): void
    {
        $pages->each(function ($page) {
            $page->sections->each(function ($section) {
                $fields = $section->fields;
                if (!is_array($fields)) {
                    return;
                }
                array_walk_recursive($fields, function (&$item) {
                    if (substr($item, 0, 6) != 'slug::') {
                        return;
                    }

                    $slug = substr($item, 6);
                    $page = PagesHelper::getPageBySegments(explode('/', $slug));
                    $item = $page ? $page->id : $slug;
                });
                $section->fields = $fields;
                $section->save();
            });
        });    
    }

    /**
     * setRoutes
     */
    protected function setRoutes($routes)
    {
        $model = Settings::instance();
        $data = [];

        foreach ($routes as $key => $row) {
            Artisan::call('cache:clear');
            if (!$page = PagesHelper::getPageBySegments(explode('/', $row))) {
                continue;
            }
            $data[$key] = $page->id;
        }

        $model->routes = $data;
        $model->save();
    }
}
