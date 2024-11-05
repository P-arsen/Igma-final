<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-regions');
        $categories = Category::with(['attributes', 'parentCategory', 'childCategories'])->get();


        $this->categoriesArray = $categories->map(function ($category) {
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
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray;
        $regions = Region::where('parent_id', null)->orderBy('name_am')->get();

        return view('admin.regions.index', compact('regions','categoriesArray'));
    }

    public function create(Request $request)
    {
        $categoriesArray = $this->categoriesArray;
        $parent = null;

        if ($request->get('parent')) {
            $parent = Region::findOrFail($request->get('parent'));
        }
        $regions    =   Region::all();
        return view('admin.regions.create', compact('parent','regions','categoriesArray'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name_am' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions', 'name_am'),
            ],
            'name_ru' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions', 'name_ru'),
            ],
            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions', 'name_en'),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions', 'slug'),
            ],
            'parent_id' => [
                'integer',
                'max:255',
            ]
        ]);
        $region = Region::create($validatedData);

        return redirect()->route('admin.regions.show', $region);
    }

    public function show(Region $region)
    {
        $regions = Region::where('parent_id', $region->id)->orderBy('name_am')->get();
        $categoriesArray = $this->categoriesArray;
        return view('admin.regions.show', compact('region', 'regions','categoriesArray'));
    }

    public function edit(Region $region)
    {
        $regions = Region::all();
        $categoriesArray = $this->categoriesArray;
        return view('admin.regions.edit', compact('region' , 'regions','categoriesArray'));
    }

    public function update(Request $request, Region $region)
    {
            $this->validate($request, [
                'name_am' => 'required|string|max:255|unique:regions,name_am,' . $region->id . ',id,parent_id,' . $region->parent_id,
                'name_ru' => 'required|string|max:255|unique:regions,name_ru,' . $region->id . ',id,parent_id,' . $region->parent_id,
                'name_en' => 'required|string|max:255|unique:regions,name_en,' . $region->id . ',id,parent_id,' . $region->parent_id,
                'slug' => 'required|string|max:255|unique:regions,slug,' . $region->id . ',id,parent_id,' . $region->parent_id,
                'parent_id' => 'integer',
            ]);

        $region->update([
            'name_am' => $request['name_am'],
            'name_ru' => $request['name_ru'],
            'name_en' => $request['name_en'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
        ]);
        return redirect()->route('admin.regions.show', $region);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index');
    }
}
