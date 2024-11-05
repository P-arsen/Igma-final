<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Carbrand;
use App\Models\Carmodel;
use Illuminate\Http\Request;
use App\Services\CategoriesService;
class ModelController extends Controller
{
    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-car');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $cars   =   Carmodel::all();
        return view('admin.car.model.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $brands = Carbrand::all();
        return view('admin.car.model.add', compact('categoriesArray','locale','brands'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Carmodel::findOrFail($id);
        $brands = Carbrand::all();
        return view('admin.car.model.edit', compact('categoriesArray','locale','car','brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:carmodels,name',
            'brand_id' => 'required|integer|exists:carbrands,id',
        ]);
        $insert = new Carmodel();
        $insert->name    =   $request->name;
        $insert->brand_id   =   $request->brand_id;
        $insert->save();
        return redirect()->route('admin.car.model.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:carbrands,id',
        ]);

        $edit = Carmodel::findorFail($id);
        $edit->name = $request['name'];
        $edit->brand_id = $request['brand_id'];
        $edit->save();

        return redirect()->route('admin.car.model.index');
    }

    public function destroy($model)
    {
        Carmodel::findorfail($model)->delete();
        return redirect()->route('admin.car.model.index');
    }
}
