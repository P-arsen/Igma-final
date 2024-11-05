<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Carbrand;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $cars   =   Carbrand::all();
        return view('admin.car.brand.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.car.brand.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Carbrand::findOrFail($id);
        return view('admin.car.brand.edit', compact('categoriesArray','locale','car'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:carbrands,name',
        ]);
        $insert = new Carbrand();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.car.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Carbrand::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.car.brand.index');
    }

    public function destroy($model)
    {
        Carbrand::findorfail($model)->delete();
        return redirect()->route('admin.car.brand.index');
    }
}
