<?php

namespace App\Http\Controllers\Cabinet;

use App\Entity\Adverts\Category;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;

class HomeController extends Controller
{

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('auth');
        $this->categoriesArray = $categoriesService;
    }
    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale = app()->getLocale();
        $my_posts   =   [];
        foreach ($categoriesArray as $category) {
            if($category['parent_id'] == null) {
                $get_products   =   'App\Models\\'.$category['slug'];
                $my_posts[$category['slug']]   =   $get_products::where('user_id', auth()->id())->with('image')->get();
            }
    }
//        dd($my_posts);
//        $my_posts   =   [];
        return view('cabinet.home', compact('locale','categoriesArray','my_posts'));
    }
}
