<?php

namespace App\Http\Controllers\Admin\Freezers;

use App\Http\Controllers\Controller;
use App\Models\Freezertype;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class RefrigeratorsTypeController extends Controller
{

    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-electronics');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray;
        $freezertypes = Freezertype::all();
        return view('admin.freezer.type.index', compact('categoriesArray','freezertypes'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.freezer.type.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $freezertype = Freezertype::findOrFail($id);
        return view('admin.freezer.type.edit', compact('categoriesArray','locale','freezertype'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $insert = new Freezertype();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.refrigerators.type.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = Freezertype::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.refrigerators.type.index');
    }

    public function destroy($type)
    {
        Freezertype::findorfail($type)->delete();
        return redirect()->route('admin.refrigerators.type.index');
    }
}
