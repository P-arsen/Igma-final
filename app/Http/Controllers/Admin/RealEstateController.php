<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Models\Flattype;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{

    private array $categoriesArray;

    public function __construct()
    {
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
        $flat_types = Flattype::all();
        return view('admin.realEstate.type.index', compact('categoriesArray','flat_types'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.realEstate.type.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $flat_type = Flattype::findOrFail($id);
        return view('admin.realEstate.type.edit', compact('categoriesArray','locale','flat_type'));
    }

        public function store(Request $request)
        {
            $this->validate($request, [
                'name_am' => 'required|string|max:255',
                'name_ru' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
            ]);
            $insert = new Flattype();
            $insert->name_am    =   $request->name_am;
            $insert->name_ru    =   $request->name_ru;
            $insert->name_en    =   $request->name_en;
            $insert->save();
            return redirect()->route('admin.real-estates.type.index');
        }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

            $edit = Flattype::findorFail($id);
            $edit->name_am = $request['name_am'];
            $edit->name_ru = $request['name_ru'];
            $edit->name_en = $request['name_en'];
            $edit->save();

        return redirect()->route('admin.real-estates.type.index');
    }

    public function destroy($flat_type)
    {
        Flattype::findorfail($flat_type)->delete();
        return redirect()->route('admin.real-estates.type.index');
    }
}
