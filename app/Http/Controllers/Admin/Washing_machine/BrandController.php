<?php

namespace App\Http\Controllers\Admin\Washing_machine;

use App\Http\Controllers\Controller;
use App\Models\Washing;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $washings   =   Washing::all();
        return view('admin.washing_machine.brand.index', compact('categoriesArray','washings'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.washing_machine.brand.add', compact('categoriesArray','locale'));
    }


    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $washing = Washing::findOrFail($id);
        return view('admin.washing_machine.brand.edit', compact('categoriesArray','locale','washing'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:washings,name',
        ]);
        $insert = new Washing();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.washing_machine.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);
        $edit = Washing::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.washing_machine.brand.index');
    }

    public function destroy($model)
    {
        Washing::findorfail($model)->delete();
        return redirect()->route('admin.washing_machine.brand.index');
    }
}
