<?php

namespace App\Http\Controllers\Cabinet;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileEditRequest;
use App\Services\CategoriesService;
use App\UseCases\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $service;

    public function __construct(ProfileService $service , CategoriesService $categoriesService)
    {
        $this->service = $service;
        $this->categoriesArray = $categoriesService;
    }

    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $user = Auth::user();
        $locale = app()->getLocale();
        $region = Region::where('id', $user->id)->first();
        return view('cabinet.profile.home', compact('user','locale','categoriesArray','region','categoriesArray'));
    }

    public function edit()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $user = Auth::user();
        $locale = app()->getLocale();
        $regions = Region::all();
        return view('cabinet.profile.edit', compact('user','locale','categoriesArray','regions'));
    }

    public function update(ProfileEditRequest $request)
    {

        try {
            $this->service->edit(Auth::id(), $request);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.profile.home');
    }
}
