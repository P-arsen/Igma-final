<?php

namespace App\Http\Controllers\Cabinet;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use App\UseCases\Adverts\FavoriteService;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    private $service;

    public function __construct(FavoriteService $service,CategoriesService $categoriesService)
    {
        $this->service = $service;
        $this->categoriesArray = $categoriesService;
        $this->middleware('auth');
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $adverts = Advert::favoredByUser(Auth::user())->orderByDesc('id')->paginate(20);
        $locale = app()->getLocale();

        return view('cabinet.favorites.index', compact('adverts','locale','categoriesArray'));
    }

    public function remove(Advert $advert)
    {
        try {
            $this->service->remove(Auth::id(), $advert->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.favorites.index');
    }
}
