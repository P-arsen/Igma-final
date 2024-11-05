<?php

namespace App\Http\Controllers\Admin\Phone;

use App\Http\Controllers\Controller;
use App\Models\Phonememory;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class MemoryController extends Controller
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
        $phones   =   Phonememory::all();
        return view('admin.phone.memory.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.phone.memory.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Phonememory::findOrFail($id);
        return view('admin.phone.memory.edit', compact('categoriesArray','locale','phone'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:phonememories,name',
        ]);
        $insert = new Phonememory();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.phone.memory.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Phonememory::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.phone.memory.index');
    }

    public function destroy($model)
    {
        Phonememory::findorfail($model)->delete();
        return redirect()->route('admin.phone.memory.index');
    }
}
