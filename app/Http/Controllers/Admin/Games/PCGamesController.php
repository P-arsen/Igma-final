<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Models\Pcgame;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class PCGamesController extends Controller
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
        $games   =   Pcgame::all();
        return view('admin.games.pc.index', compact('categoriesArray','games'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.games.pc.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $game = Pcgame::findOrFail($id);
        return view('admin.games.pc.edit', compact('categoriesArray','locale','game'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:pcgames,name',
        ]);
        $insert = new Pcgame();
        $insert->name    =   $request->name;
        $insert->save();
        return redirect()->route('admin.games.pc.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $edit = Pcgame::findorFail($id);
        $edit->name = $request['name'];
        $edit->save();

        return redirect()->route('admin.games.pc.index');
    }

    public function destroy($model)
    {
        Pcgame::findorfail($model)->delete();
        return redirect()->route('admin.games.pc.index');
    }
}
