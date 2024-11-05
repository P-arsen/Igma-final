<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{


    protected $categoriesArray;


    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-adverts-categories');
        $this->categoriesArray = $categoriesService;
    }

    public function create(Category $category)
    {
        $types = Attribute::typesList();
        $categoriesArray = $this->categoriesArray;
        return view('admin.adverts.categories.attributes.create', compact('category', 'types','categoriesArray'));
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $attribute = $category->attributes()->create([
            'name_am' => $request['name_am'],
            'name_ru' => $request['name_ru'],
            'name_en' => $request['name_en'],
        ]);
        return redirect()->route('admin.adverts.categories.attributes.show', [$category, $attribute->category_id]);
    }

    public function show(Category $category, Attribute $attribute)
    {
        $attributes  =   Attribute::where('category_id',$attribute->id)->get();
        $categoriesArray = $this->categoriesArray;
        return view('admin.adverts.categories.attributes.show', compact('category', 'attributes','categoriesArray'));
    }

    public function edit(Category $category, Attribute $attribute)
    {
        $types = Attribute::typesList();
        $categoriesArray = $this->categoriesArray;
        return view('admin.adverts.categories.attributes.edit', compact('category', 'attribute', 'types','categoriesArray'));
    }

    public function update(Request $request, Category $category, Attribute $attribute)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $change = Attribute::findOrFail($attribute->id)->update([
            'name_am' => $request['name_am'],
            'name_ru' => $request['name_ru'],
            'name_en' => $request['name_en'],
        ]);

        return redirect()->route('admin.adverts.categories.attributes.show', $category);
    }

    public function destroy(Category $category , $id)
    {
        Attribute::findOrFail($id)->delete();

        return redirect()->route('admin.adverts.categories.show', $category);
    }
}
