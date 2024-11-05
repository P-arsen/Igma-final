<?php

namespace App\Http\Controllers;

use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Models\Carbrand;
use App\Models\General;
use App\Models\Subcategory;
use App\Models\User;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use phpseclib3\File\ASN1\Maps\Attributes;

class HomeController extends Controller
{
    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesArray = $categoriesService;
    }
    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $busineses = User::where('businese_page', 1)->inRandomOrder()->limit(10)->get();
        $active_categories  =   Category::where('active',1)->get();
        $active_attributes = Attribute::inRandomOrder()->limit(8)->get();
        for($i = 0; $i < count($active_attributes); $i++){
            $slug = 'App\Models\\'.$active_attributes[$i]->slug;
            $active_attributes[$i]['product'] =    $slug::limit(15)->where('category_id' == $active_attributes['category_id'])->get();
        }
        $locale = App::getLocale();
        $regions = Region::all();

        // Prepare an array to hold the structured data
        $structuredRegions = [];

        foreach ($regions as $region) {
            if (is_null($region->parent_id)) {
                // If it's a top-level region, add it to the structured array
                $structuredRegions[$region->id] = [
                    'id' => $region->id,
                    'name_am' => $region->name_am,
                    'name_en' => $region->name_en,
                    'name_ru' => $region->name_ru,
                    'slug' => $region->slug,
                    'cities' => [],  // Initialize cities array
                ];
            } else {
                // If it's a city, add it to the corresponding parent region's cities array
                if (isset($structuredRegions[$region->parent_id])) {
                    $structuredRegions[$region->parent_id]['cities'][] = [
                        'id' => $region->id,
                        'name_am' => $region->name_am,
                        'name_en' => $region->name_en,
                        'name_ru' => $region->name_ru,
                        'slug' => $region->slug,
                    ];
                }
            }
        }


        return view('home', compact('structuredRegions','categoriesArray', 'locale','busineses', 'active_categories', 'active_attributes'));
    }

    public function single(Request $request)
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale = App::getLocale();
        $data = $request->name;
        $db = 'App\Models\\'.$data;
        $product   =   $db::where('id',$request->id)
            ->with('images')
            ->with('region')
            ->with('city')
            ->with('user')
            ->with('type')
            ->with('model')
            ->with('brand')
            ->first();
//dd($product);
        // Get 3 random products excluding the current one using a subquery
        $randomProducts = $db::where('id', '!=', $request->id)->with('image')
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('uniq-product', compact('product','categoriesArray', 'locale','randomProducts','data'));
    }


    public function bajin(Request $request)
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale = App::getLocale();
        $data = $request->name;
        $db = 'App\Models\\'.$data;
        if(empty($request->id))
        {
            $get_products   =   $db::where('top',0)
                ->with('image')
                ->paginate(16);
        }else{
            $get_products   =   $db::where('top',0)->where('category_id',$request->id)
            ->with('image')
            ->paginate(16);
        }
            $brands = Carbrand::all();
//dd($get_products);
        $tops   =   $db::where('top','!=',0)->get();
        $regions = Region::all();

        // Prepare an array to hold the structured data
        $structuredRegions = [];

        foreach ($regions as $region) {
            if (is_null($region->parent_id)) {
                // If it's a top-level region, add it to the structured array
                $structuredRegions[$region->id] = [
                    'id' => $region->id,
                    'name_am' => $region->name_am,
                    'name_en' => $region->name_en,
                    'name_ru' => $region->name_ru,
                    'slug' => $region->slug,
                    'cities' => [],  // Initialize cities array
                ];
            } else {
                // If it's a city, add it to the corresponding parent region's cities array
                if (isset($structuredRegions[$region->parent_id])) {
                    $structuredRegions[$region->parent_id]['cities'][] = [
                        'id' => $region->id,
                        'name_am' => $region->name_am,
                        'name_en' => $region->name_en,
                        'name_ru' => $region->name_ru,
                        'slug' => $region->slug,
                    ];
                }
            }
        }
        $category = $request->c;
        $category_name = Category::where('id', $category)->where('parent_id',null)->first();
        $getcategory = Category::where('parent_id', $category)->get();

        for ($i = 0; $i < count($getcategory); $i++) {
            $getcategory[$i]['children'] = Attribute::where('category_id', $getcategory[$i]->id)->get();
        }
//        $category   =   Category::where('id',$request->id)->first();

        return view('bajin', compact('structuredRegions','getcategory','categoriesArray', 'locale','get_products','tops','category_name','brands'));
    }
}
