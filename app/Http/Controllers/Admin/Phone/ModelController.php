<?php

namespace App\Http\Controllers\Admin\Phone;

use App\Http\Controllers\Controller;
use App\Models\Phonebrand;
use App\Models\Phonemodel;
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
        $phones   =   Phonemodel::all();
        return view('admin.phone.model.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $brands =   Phonebrand::all();
        return view('admin.phone.model.add', compact('categoriesArray','locale','brands'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Phonemodel::findOrFail($id);
        $brands = Phonebrand::all();
        return view('admin.phone.model.edit', compact('categoriesArray','locale','phone','brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:phonebrands,name',
            'brand_id' => 'required|integer|exists:phonebrands,id',
        ]);
        $insert = new Phonemodel();
        $insert->name    =   $request->name;
        $insert->brand_id   =   $request->brand_id;
        $insert->save();
        return redirect()->route('admin.phone.model.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:phonebrands,id',
        ]);

        $edit = Phonemodel::findorFail($id);
        $edit->name = $request['name'];
        $edit->brand_id = $request['brand_id'];
        $edit->save();

        return redirect()->route('admin.phone.model.index');
    }

    public function destroy($model)
    {
        Phonemodel::findorfail($model)->delete();
        return redirect()->route('admin.phone.model.index');
    }
}
