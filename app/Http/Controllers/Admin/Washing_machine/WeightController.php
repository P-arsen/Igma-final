<?php

namespace App\Http\Controllers\Admin\Washing_machine;

use App\Http\Controllers\Controller;
use App\Models\Washing;
use App\Models\Washingweight;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-electronics');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $weights   =   Washingweight::all();
        return view('admin.washing_machine.weight.index', compact('categoriesArray','weights'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.washing_machine.weight.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $weight = Washingweight::findOrFail($id);
        return view('admin.washing_machine.weight.edit', compact('categoriesArray','locale','weight'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255|unique:washingweights,name_am',
            'name_ru' => 'required|string|max:255|unique:washingweights,name_ru',
            'name_en' => 'required|string|max:255|unique:washingweights,name_en',
        ]);
        $insert = new Washingweight();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.washing_machine.weight.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = Washingweight::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.washing_machine.weight.index');
    }

    public function destroy($model)
    {
        Washingweight::findorfail($model)->delete();
        return redirect()->route('admin.washing_machine.weight.index');
    }
}
