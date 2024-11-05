<?php

namespace App\Http\Controllers\Admin\Freezers;

use App\Http\Controllers\Controller;
use App\Models\Freezer;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class RefrigeratorsModelsController extends Controller
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
        $freezers   =   Freezer::all();
        return view('admin.freezer.brand.index', compact('categoriesArray','freezers'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.freezer.brand.add', compact('categoriesArray','locale'));
    }


    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $freezer = Freezer::findOrFail($id);
        return view('admin.freezer.brand.edit', compact('categoriesArray','locale','freezer'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:freezers,name',
        ]);
        $insert = new Freezer();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.refrigerators.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);
        $edit = Freezer::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.refrigerators.brand.index');
    }

    public function destroy($model)
    {
        Freezer::findorfail($model)->delete();
        return redirect()->route('admin.refrigerators.brand.index');
    }
}
