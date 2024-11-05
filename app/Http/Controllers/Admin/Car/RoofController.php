<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Roof;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class RoofController extends Controller
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
        $cars   =   Roof::all();
        return view('admin.car.roof.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.car.roof.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Roof::findOrFail($id);
        return view('admin.car.roof.edit', compact('categoriesArray','locale','car'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255|unique:roofs,name_am',
            'name_ru' => 'required|string|max:255|unique:roofs,name_ru',
            'name_en' => 'required|string|max:255|unique:roofs,name_en'
        ]);
        $insert = new Roof();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.car.roof.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = Roof::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.car.roof.index');
    }

    public function destroy($model)
    {
        Roof::findorfail($model)->delete();
        return redirect()->route('admin.car.roof.index');
    }
}
