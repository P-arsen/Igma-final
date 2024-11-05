<?php

namespace App\Http\Controllers\Admin\Phone;

use App\Http\Controllers\Controller;
use App\Models\Phonebrand;
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
        $phones   =   Phonebrand::all();
        return view('admin.phone.brand.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.phone.brand.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Phonebrand::findOrFail($id);
        return view('admin.phone.brand.edit', compact('categoriesArray','locale','phone'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:phonebrands,name',
        ]);
        $insert = new Phonebrand();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.phone.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Phonebrand::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.phone.brand.index');
    }

    public function destroy($model)
    {
        Phonebrand::findorfail($model)->delete();
        return redirect()->route('admin.phone.brand.index');
    }
}
