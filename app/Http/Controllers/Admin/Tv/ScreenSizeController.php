<?php

namespace App\Http\Controllers\Admin\Tv;

use App\Http\Controllers\Controller;
use App\Models\Tvsize;
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
        $tv_sizes   =   Tvsize::all();
        return view('admin.tv.size.index', compact('categoriesArray','tv_sizes'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.tv.size.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $tv_size = Tvsize::findOrFail($id);
        return view('admin.tv.size.edit', compact('categoriesArray','locale','tv_size'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required|string|max:255|unique:tvsizes,size',
        ]);
        $insert = new Tvsize();
        $insert->size    =   $request->size;
        $insert->save();
        return redirect()->route('admin.tv.screen.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'size' => 'required|string|max:255',
        ]);

        $edit = Tvsize::findorFail($id);
        $edit->size = $request['size'];
        $edit->save();

        return redirect()->route('admin.tv.screen.index');
    }

    public function destroy($model)
    {
        Tvsize::findorfail($model)->delete();
        return redirect()->route('admin.tv.screen.index');
    }
}
