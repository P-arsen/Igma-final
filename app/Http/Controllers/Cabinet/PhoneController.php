<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Services\CategoriesService;
use App\UseCases\Profile\PhoneService;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    private $service;

    public function __construct(PhoneService $service, CategoriesService $categoriesService)
    {
        $this->categoriesArray = $categoriesService;
        $this->service = $service;
    }

    public function request()
    {
        try {
            $this->service->request(Auth::id());
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.profile.phone');
    }

    public function form()
    {
        $user = Auth::user();
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale = app()->getLocale();
        return view('cabinet.profile.phone', compact('user','locale','categoriesArray'));
    }

    public function verify(PhoneVerifyRequest $request)
    {
        try {
            $this->service->verify(Auth::id(), $request);
        } catch (\DomainException $e) {
            return redirect()->route('cabinet.profile.phone')->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.home');
    }

    public function auth()
    {
        $this->service->toggleAuth(Auth::id());

        return redirect()->route('cabinet.profile.home');
    }
}
