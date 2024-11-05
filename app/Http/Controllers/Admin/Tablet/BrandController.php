<?php

namespace App\Http\Controllers\Admin\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Tabletbrand;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-electronics');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $phones   =   Tabletbrand::all();
        return view('admin.tablet.brand.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.tablet.brand.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Tabletbrand::findOrFail($id);
        return view('admin.tablet.brand.edit', compact('categoriesArray','locale','phone'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:tabletbrands,name',
        ]);
        $insert = new Tabletbrand();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.tablet.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Tabletbrand::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.tablet.brand.index');
    }

    public function destroy($model)
    {
        Tabletbrand::findorfail($model)->delete();
        return redirect()->route('admin.tablet.brand.index');
    }
}
