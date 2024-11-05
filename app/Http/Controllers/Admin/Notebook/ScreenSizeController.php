<?php

namespace App\Http\Controllers\Admin\Notebook;

use App\Http\Controllers\Controller;
use App\Models\Notebooksize;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class ScreenSizeController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-electronics');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $notebooks   =   Notebooksize::all();
        return view('admin.notebook.size.index', compact('categoriesArray','notebooks'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.notebook.size.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $notebook = Notebooksize::findOrFail($id);
        return view('admin.notebook.size.edit' , compact('categoriesArray','locale','notebook'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required|string|max:255|unique:notebooksizes,size',
        ]);
        $insert = new Notebooksize();
        $insert->size    =   $request->size;
        $insert->save();
        return redirect()->route('admin.notebook.screen.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'size' => 'required|string|max:255',
        ]);

        $edit = Notebooksize::findorFail($id);
        $edit->size = $request['size'];
        $edit->save();

        return redirect()->route('admin.notebook.screen.index');
    }

    public function destroy($model)
    {
        Notebooksize::findorfail($model)->delete();
        return redirect()->route('admin.notebook.screen.index');
    }
}
