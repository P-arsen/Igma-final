<?php

namespace App\Http\Controllers\Admin\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Screensize;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class ScreenSizeController extends Controller
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
        $phones   =   Screensize::all();
        return view('admin.tablet.size.index', compact('categoriesArray','phones'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.tablet.size.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $phone = Screensize::findOrFail($id);
        return view('admin.tablet.size.edit', compact('categoriesArray','locale','phone'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required|string|max:255|unique:screensizes,size',
        ]);
        $insert = new Screensize();
        $insert->size    =   $request->size;
        $insert->save();
        return redirect()->route('admin.tablet.size.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'size' => 'required|string|max:255',
        ]);

        $edit = Screensize::findorFail($id);
        $edit->size = $request['size'];
        $edit->save();

        return redirect()->route('admin.tablet.size.index');
    }

    public function destroy($model)
    {
        Screensize::findorfail($model)->delete();
        return redirect()->route('admin.tablet.size.index');
    }
}
