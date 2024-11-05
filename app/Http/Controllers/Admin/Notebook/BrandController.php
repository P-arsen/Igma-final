<?php

namespace App\Http\Controllers\Admin\Notebook;

use App\Http\Controllers\Controller;
use App\Models\Notebookbrand;
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
        $phones   =   Notebookbrand::all();
        return view('admin.notebook.brand.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.notebook.brand.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Notebookbrand::findOrFail($id);
        return view('admin.notebook.brand.edit', compact('categoriesArray','locale','phone'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:notebookbrands,name',
        ]);
        $insert = new Notebookbrand();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.notebook.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Notebookbrand::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.notebook.brand.index');
    }

    public function destroy($model)
    {
        Notebookbrand::findorfail($model)->delete();
        return redirect()->route('admin.notebook.brand.index');
    }
}
