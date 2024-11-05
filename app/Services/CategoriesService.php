<?php
namespace App\Services;


use Illuminate\Support\Facades\Cache;
use App\Entity\Adverts\Category;
class CategoriesService
{
    public function getCategories()
    {
        Cache::forget('categories_array');
        $categoriesArray = Cache::get('categories_array');
        if ($categoriesArray) {
            return $categoriesArray;
        } else {
            return $this->fetchAndCacheCategories();
        }
    }

    protected function fetchAndCacheCategories()
    {
        Cache::forget('categories_array');
        $categories = Category::with(['attributes', 'parentCategory', 'childCategories'])->get();
        $categoriesArray = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name_am' => $category->name_am,
                'name_ru' => $category->name_ru,
                'name_en' => $category->name_en,
                'parent_id' => $category->parent_id,
                'slug' => $category->slug,
                'parent_name_en' => $category->parentCategory ? $category->parentCategory->name_en : null,
                'children' => $category->childCategories->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'name_am' => $child->name_am,
                        'name_ru' => $child->name_ru,
                        'name_en' => $child->name_en,
                        'attributes' => $child->attributes->map(function ($attribute) {
                            return [
                                'id' => $attribute->id,
                                'name_am' => $attribute->name_am,
                                'name_ru' => $attribute->name_ru,
                                'name_en' => $attribute->name_en,
                                'slug' => $attribute->slug,
                                'value' => $attribute->value,
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        })->toArray();

        // Cache the categories for 24 hours
        Cache::put('categories_array', $categoriesArray, 1440);

        return $categoriesArray;
    }
}
