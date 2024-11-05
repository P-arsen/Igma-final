<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoriesService;
use phpseclib3\File\ASN1\Maps\Attributes;

class CategoryController extends Controller
{

    protected $categoriesArray;
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-adverts-categories');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categories = Category::where('parent_id',null)->get();
        $categoriesArray = $this->categoriesArray;
        return view('admin.adverts.categories.index', compact('categories','categoriesArray'));
    }

    public function create()
    {
        $parents = Category::defaultOrder()->withDepth()->get();
        $categoriesArray = $this->categoriesArray;

        return view('admin.adverts.categories.create', compact('parents','categoriesArray'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
//            'icon' => 'required|file|mimes:jpg,png,svg,webp|max:2048',
        ]);
//dd($request->all());
        $path   =   '';
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $path = $file->store('uploads', 'public');
        }
//        dd($request->parent);
        $category = new Category();
        $category->name_am = $request['name_am'];
        $category->name_ru = $request['name_ru'];
        $category->name_en = $request['name_en'];
        $category->parent_id = $request['parent'];
        $category->icon     = $path;
        $category->save();

        return redirect()->route('admin.adverts.categories.show', $category);
    }

    public function show(Category $category)
    {
        $attributes = Category::where('parent_id', $category->id)->get();
//        $parentAttributes = Category::where('parent_id', $category->id)->get();
        $categoriesArray = $this->categoriesArray;
        return view('admin.adverts.categories.show', compact('category', 'attributes','categoriesArray'));
    }

    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->get();
        $categoriesArray = $this->categoriesArray;

        return view('admin.adverts.categories.edit', compact('category', 'parents','categoriesArray'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:advert_categories,id',
        ]);
        $category->update([
            'name_am' => $request['name_am'],
            'name_ru' => $request['name_ru'],
            'name_en' => $request['name_en'],
            'parent_id' => $request['parent'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.adverts.categories.index');
    }
}
