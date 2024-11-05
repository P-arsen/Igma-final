<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Carsize;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class MotorSizeController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-car');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $cars   =   Carsize::all();
        return view('admin.car.motor-size.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.car.motor-size.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Carsize::findOrFail($id);
        return view('admin.car.motor-size.edit', compact('categoriesArray','locale','car'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:carsizes,name'
        ]);
        $insert = new Carsize();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.car.motor-size.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Carsize::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.car.motor-size.index');
    }

    public function destroy($model)
    {
        Carsize::findorfail($model)->delete();
        return redirect()->route('admin.car.motor-size.index');
    }
}
