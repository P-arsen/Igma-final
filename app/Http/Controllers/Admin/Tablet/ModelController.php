<?php

namespace App\Http\Controllers\Admin\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Tabletbrand;
use App\Models\Tabletmodel;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class ModelController extends Controller
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
        $phones   =   Tabletmodel::all();
        return view('admin.tablet.model.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $brands =   Tabletbrand::all();
        return view('admin.tablet.model.add', compact('categoriesArray','locale','brands'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Tabletmodel::findOrFail($id);
        $brands = Tabletbrand::all();
        return view('admin.tablet.model.edit', compact('categoriesArray','locale','phone','brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:tabletbrands,name',
            'brand_id' => 'required|integer|exists:tabletbrands,id',
        ]);
        $insert = new Tabletmodel();
        $insert->name    =   $request->name;
        $insert->brand_id   =   $request->brand_id;
        $insert->save();
        return redirect()->route('admin.tablet.model.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:tabletbrands,id',
        ]);

        $edit = Tabletmodel::findorFail($id);
        $edit->name = $request['name'];
        $edit->brand_id = $request['brand_id'];
        $edit->save();

        return redirect()->route('admin.tablet.model.index');
    }

    public function destroy($model)
    {
        Tabletmodel::findorfail($model)->delete();
        return redirect()->route('admin.tablet.model.index');
    }
}
