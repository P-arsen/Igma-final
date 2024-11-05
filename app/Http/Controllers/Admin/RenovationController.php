<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Models\Renovation;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class RenovationController extends Controller
{
    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-real-estate');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray;
        $flat_types = Renovation::all();
        return view('admin.realEstate.renovation.index', compact('categoriesArray','flat_types'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.realEstate.renovation.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $flat_type = Renovation::findOrFail($id);
        return view('admin.realEstate.renovation.edit', compact('categoriesArray','locale','flat_type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $insert = new Renovation();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.real-estates.renovation.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = Renovation::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.real-estates.renovation.index');
    }

    public function destroy($flat_type)
    {
        Renovation::findorfail($flat_type)->delete();
        return redirect()->route('admin.real-estates.renovation.index');
    }
}
