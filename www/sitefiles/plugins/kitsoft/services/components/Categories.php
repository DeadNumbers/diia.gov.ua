<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Category;
use KitSoft\Services\Models\Service;

class Categories extends ComponentBase
{
    public $categories;

    public function componentDetails()
    {
        return [
            'name'        => 'Services By Categories',
            'description' => 'Завантаження головних категорії із подкатегоріями та сервісами'
        ];
    }

    public function defineProperties()
    {
        $properties = [
            'isTopFilter' => [
                'title' => 'Тільки закріплені',
                'type' => 'checkbox',
                'group' => 'Автоматичне завантаження'
            ],
            'countServices' => [
                'title' => 'Кількість сервісів в підкатегоріях',
                'type' => 'dropdown',
                'required' => true,
                'default' => 0,
                'options' => array_combine($range = range(0, 20), $range),
                'group' => 'Автоматичне завантаження',
            ],
            'isCustomServices' => [
                'title' => 'Ручне налаштування сервісів',
                'type' => 'switch',
                'default' => false,
                'span' => false,
                'group' => 'Ручне завантаження',
            ]
        ];

        Category::get()->each(function ($item) use (&$properties) {
            $properties["category-{$item->id}-section"] = [
                'title' => "Категорія: {$item->name}",
                'span' => false,
                'group' => 'Ручне завантаження',
                'type' => 'section',
            ];
            $properties["category-{$item->id}"] = [
                'title' => false,
                'type' => 'repeater',
                'group' => 'Ручне завантаження',
                'span' => false,
                'prompt' => '+ додати сервіс',
                'style' => 'collapsed',
                'form' => [
                    'fields' => [
                        'service' => [
                            'label' => 'Service',
                            'type' => 'dropdown',
                            'emptyOption' => '-',
                            'relation' => [
                                'model' => Service::class,
                                'value' => 'title',
                                'key' => 'id'
                            ]
                        ]
                    ]
                ]
            ];
        });

        return $properties;
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if ($this->property('isCustomServices')) {
            $this->categories = $this->loadCategoriesWithCustomServices();
        } else {
            $this->categories = $this->loadCategories();
        }
        
    }

    /**
     * loadCategories
     */
    protected function loadCategories()
    {
        return Category::isTop()
            ->with('subcategories')
            ->get()
            ->each(function ($item) {
                $item->subcategories->each(function ($item) {
                    $item->load(['services' => function ($query) {
                        $query = $query->isPublished();

                        if ($this->property('isTopFilter')) {
                            $query = $query->isTop();
                        }

                        return $query->orderBy('hits', 'desc')
                            ->limit($this->property('countServices'));
                    }]);
                });

                $item->services = $item->subcategories
                    ->pluck('services')
                    ->collapse()
                    ->unique('id')
                    ->sortBy('title')
                    ->take($this->property('countServices'));
            });
    }

    /**
     * loadCategoriesWithCustomServices
     */
    protected function loadCategoriesWithCustomServices()
    {
        return Category::isTop()
            ->with('subcategories')
            ->get()
            ->filter(function ($item) {
                return (boolean)$this->property("category-{$item->id}");
            })
            ->each(function ($item) {
                $serviceIds = collect($this->property("category-{$item->id}"))
                    ->pluck('service')
                    ->unique()
                    ->toArray();

                $item->services = Service::isPublished()
                    ->find($serviceIds)
                    ->sortBy(function ($item) use ($serviceIds) {
                        return array_search($item->id, $serviceIds);
                    });
            });
    }
}
