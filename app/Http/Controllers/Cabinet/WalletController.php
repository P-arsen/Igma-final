<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Models\Payment;
use App\Services\CategoriesService;
use App\UseCases\Profile\PhoneService;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function __construct(PhoneService $service, CategoriesService $categoriesService)
    {
        $this->categoriesArray = $categoriesService;
        $this->service = $service;
    }

    public function index(){
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray->getCategories();


        return view('cabinet.wallet.index', compact('categoriesArray', 'locale'));
    }

    public function payment()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray->getCategories();
        $payments = Payment::where('user_id', Auth::id())->orderBy('id', 'desc')->with('service')->get();

        return view('cabinet.wallet.payment', compact('categoriesArray', 'locale', 'payments'));
    }
}
