<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Wheel;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class WheelsController extends Controller
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
        $cars   =   Wheel::all();
        return view('admin.car.wheels.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.car.wheels.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Wheel::findOrFail($id);
        return view('admin.car.wheels.edit', compact('categoriesArray','locale','car'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:wheels,name'
        ]);
        $insert = new Wheel();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.car.wheels.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Wheel::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.car.wheels.index');
    }

    public function destroy($model)
    {
        Wheel::findorfail($model)->delete();
        return redirect()->route('admin.car.wheels.index');
    }
}
