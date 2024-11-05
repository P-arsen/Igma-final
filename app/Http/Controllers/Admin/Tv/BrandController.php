<?php

namespace App\Http\Controllers\Admin\Tv;

use App\Http\Controllers\Controller;
use App\Models\Tvbrand;
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
        $tvs   =   Tvbrand::all();
        return view('admin.tv.brand.index', compact('categoriesArray','tvs'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.tv.brand.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $tv = Tvbrand::findOrFail($id);
        return view('admin.tv.brand.edit', compact('categoriesArray','locale','tv'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:tvbrands,name',
        ]);
        $insert = new Tvbrand();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.tv.brand.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Tvbrand::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.tv.brand.index');
    }

    public function destroy($model)
    {
        Tvbrand::findorfail($model)->delete();
        return redirect()->route('admin.tv.brand.index');
    }
}
