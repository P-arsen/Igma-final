<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\Interior;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class InteriorController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-car');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $cars   =   Interior::all();
        return view('admin.car.interior.index', compact('categoriesArray','cars'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.car.interior.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $car = Interior::findOrFail($id);
        return view('admin.car.interior.edit', compact('categoriesArray','locale','car'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255|unique:interiors,name_am',
            'name_ru' => 'required|string|max:255|unique:interiors,name_ru',
            'name_en' => 'required|string|max:255|unique:interiors,name_en'
        ]);
        $insert = new Interior();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.car.interior.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = Interior::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.car.interior.index');
    }

    public function destroy($model)
    {
        Interior::findorfail($model)->delete();
        return redirect()->route('admin.car.interior.index');
    }
}
