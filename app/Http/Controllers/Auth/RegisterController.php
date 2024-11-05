<?php

namespace App\Http\Controllers\Auth;

use App\Entity\Adverts\Category;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use App\UseCases\Auth\RegisterService;

class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterService $service, CategoriesService $categoriesService)
    {
        $this->middleware('guest');
        $this->categoriesArray = $categoriesService;
        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale = app()->getLocale();
        return view('auth.register', compact('locale','categoriesArray'));
    }

    public function register(RegisterRequest $request)
    {

        $this->service->register($request);
        return redirect()->route('login')
            ->with('success', 'Check your email and click on the link to verify.');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry your link cannot be identified.');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')->with('success', 'Your e-mail is verified. You can now login.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
