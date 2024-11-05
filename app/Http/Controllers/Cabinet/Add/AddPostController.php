<?php

namespace App\Http\Controllers\Cabinet\Add;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Admin\Car\MotorSizeController;
use App\Http\Controllers\Controller;
use App\Models\Carbrand;
use App\Models\Carmodel;
use App\Models\Carsize;
use App\Models\Cartype;
use App\Models\Categoryfilter;
use App\Models\City;
use App\Models\Color;
use App\Models\Drivetype;
use App\Models\Enginetype;
use App\Models\Flattype;
use App\Models\Freezer;
use App\Models\Interiortype;
use App\Models\Motor;
use App\Models\Notebookbrand;
use App\Models\Notebooksize;
use App\Models\Phonememory;
use App\Models\Phonemodel;
use App\Models\Subcategory;
use App\Models\Wheel;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class AddPostController extends Controller
{

    public function __construct(CategoriesService $categoriesService)
    {$this->middleware('auth');
        $this->categoriesArray = $categoriesService;
    }
    public function index()
    {
        $categoriesArray = $this->categoriesArray->getCategories();
        $locale =   app()->getLocale();
        return view('cabinet.add.post',compact('locale','categoriesArray'));
    }

    public function add(Request $request)
    {

        $categoriesArray = $this->categoriesArray->getCategories();

        $locale = app()->getLocale();
        $category_id = $request->id;
        $category = $request->category;
        $regions = '';

        $buildings = Flattype::all();
        $cities = City::all();
        $colors = Color::all();

        if ($category == 'Transport') {
            if ($category_id == 5 || $category_id == 6 || $category_id == 7 || $category_id == 353) {
                $car_brands = Carbrand::all();
                $car_models = Carmodel::all();
                $car_types = Cartype::all();
                $car_sizes = Carsize::all();
                $car_motors = Motor::all();
                $drive_types = Drivetype::all();
                $car_motor_sizes = Carsize::all();
                $interiors = Interiortype::all();
                $wheels = Wheel::all();
                switch ($category_id) {
                    case 7:
                        $regions = Country::all();
                        break;
                    case 353 :
                        $regions = Country::all();
                    default:
                        $regions = Region::all();
                }
                return view('cabinet.add.add', compact('locale', 'categoriesArray', 'category_id', 'regions', 'buildings', 'cities', 'car_models', 'car_brands', 'car_sizes', 'drive_types', 'colors'
                    , 'car_types', 'car_motors', 'car_motor_sizes', 'category', 'interiors', 'wheels'));
            }
        } elseif ($category == "Electronic") {
            if ($category_id <= 77) {
                $brands = Phonemodel::all();
                $models = Phonememory::all();
                $regions = Region::all();
                return view('cabinet.add.add', compact
                ('locale', 'categoriesArray', 'category_id', 'regions', 'brands', 'models', 'colors', 'category'));
            } else {
                $brands = Notebookbrand::all();
                $models = Notebooksize::all();
                $regions = Region::all();
                return view('cabinet.add.add', compact
                ('locale', 'categoriesArray', 'category_id', 'regions', 'brands', 'models', 'colors', 'category'));
            }

        } elseif ($category == "Appliance") {
            $brands = Freezer::all();
            $regions = Region::all();
            return view('cabinet.add.add', compact
            ('locale', 'categoriesArray', 'category_id', 'regions', 'buildings', 'cities', 'colors', 'category', 'brands'));
        }elseif ($category == "Realestate")
        {
            $regions = Region::all();
            return view('cabinet.add.add', compact
            ('locale', 'categoriesArray', 'category_id', 'regions', 'buildings', 'cities', 'colors', 'category'));
        }
        else{
            $regions = Region::all();
            return view('cabinet.add.add', compact
            ('locale', 'categoriesArray', 'category_id', 'regions', 'buildings', 'cities', 'colors', 'category'));
        }
    }

}
