<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;
use App\Models\GameConsole;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class GameConsoleController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('can:manage-electronics');
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray;
        $games = GameConsole::all();
        return view('admin.games.console.index', compact('categoriesArray','games'));
    }

    public function add_form()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        return view('admin.games.console.add', compact('categoriesArray','locale'));
    }
    public function editForm($id)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray;
        $game = GameConsole::findOrFail($id);
        return view('admin.games.console.edit', compact('categoriesArray','locale','game'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $insert = new GameConsole();
        $insert->name_am    =   $request->name_am;
        $insert->name_ru    =   $request->name_ru;
        $insert->name_en    =   $request->name_en;
        $insert->save();
        return redirect()->route('admin.games.console.index');
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'name_am' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $edit = GameConsole::findorFail($id);
        $edit->name_am = $request['name_am'];
        $edit->name_ru = $request['name_ru'];
        $edit->name_en = $request['name_en'];
        $edit->save();

        return redirect()->route('admin.games.console.index');
    }

    public function destroy($car)
    {
        GameConsole::findorfail($car)->delete();
        return redirect()->route('admin.games.console.index');
    }
}
