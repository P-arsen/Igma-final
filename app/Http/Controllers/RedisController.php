<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Entity\Adverts\Category;

class RedisController extends Controller
{
    public function getCategories()
    {
        $categoriesArray = Cache::get('categories_array');
        if ($categoriesArray) {
            // Data found in cache
            return $categoriesArray;
        } else {
            // If not found in cache, fetch from the database and cache it
            return $this->fetchCategories();
        }
    }

    protected function fetchCategories()
    {
        return Cache::remember('categories_array', 1440, function () {
            $categories = Category::with(['attributes', 'parentCategory', 'childCategories'])->get();

            return $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name_am' => $category->name_am,
                    'name_ru' => $category->name_ru,
                    'name_en' => $category->name_en,
                    'parent_id' => $category->parent_id,
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
                                    'value' => $attribute->value,
                                ];
                            })->toArray(),
                        ];
                    })->toArray(),
                ];
            })->toArray();
        });
    }
}
