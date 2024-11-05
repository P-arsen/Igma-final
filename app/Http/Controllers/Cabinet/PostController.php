<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Transport;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $categoriesArray;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->middleware('auth');
        $this->categoriesArray = $categoriesService;
    }


    public function car(Request $request)
    {
        $validator = '';
        if($request->category=="Transport"){
        $validator = Validator::make($request->all(),[
            'region' => 'required|string',
            'city' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'body_type' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'engine_type' => 'required|string',
            'engine_size' => 'required|numeric',
            'transmission' => 'required|string',
            'drive_type' => 'required|string',
            'destination' => 'required|string',
            'mils' => 'required|string',
            'damaged' => 'string',
            'gas' => 'string',
            'steering' => 'string',
            'cleared' => 'string',
            'color' => 'required|string',
            'headlights' => 'boolean',
            'interior_color' => 'required|string',
            'sunroof' => 'string',
            'air_conditioner' => 'string',
            'heated_seats' => 'string',
            'heated_steering_wheel' => 'string',
            'ventilated_seats' => 'string',
            'cruise_control' => 'string',
            'tinted_windows' => 'string',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:3',  // Assuming currency is a 3-character code
            'description' => 'nullable|string',
            'name' => 'required|string|max:255',
            'active' => 'boolean',
            'block' => 'boolean',
            'user_id' => 'required|integer',
            'user_type' => 'required|integer',
            'wheels'    =>  'required|string',
            'interior_type' => 'required|string',
            'category_id' => 'required|integer',
        ]);
            if($validator->fails()){
                dd($validator->errors());
            }
            $category_name = 'App\Models\\'.$request->category;
            $data = $category_name::create($validator->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('images', 'public'); // Save in 'storage/app/public/images'

                    // Create image record
                    $category_name_image = 'App\Models\\'.$request->category.'image';

                    $category_name_image::create([
                        'item_id' => $data->id,
                        'image' => $imagePath,
                    ]);
                }
            }
//        $transport = Transport::create($validatedData);
        }elseif ($request->category=="Realestate"){
            $validator = Validator::make($request->all(),[
                'region' => 'required|string',
                'city' => 'required|string',
                'elevator' => 'required|string',
                'building_type' => 'required|string',
                'furniture'     =>  'required|string',
                'renovation'    =>  'required|string',
                'loghavazan'    =>  'required|string',
                'taghavar'          =>  'required|string',
                'security'          =>  'required|string',
                'salojagh'=>  'required|string',
                'washing_machine'=>  'required|string',
                'elektrakanutyun'=>  'required|string',
                'gaz'=>  'required|string',
                'water'=>  'required|string',
                'done'=>  'required|string',
                'rooms'=>  'required|string',
                'floor'=>  'required|string',
                'area'=>  'required|string',
                'price' =>  'required|string',
                'name' =>  'required|string',
                'active'=>  'integer',
                'block' =>  'integer',
                'special_offer'=>'integer',
                'top',
                'buy_me',
                'urgent',
                'hair_dryer' =>  'required|string',
                'water_heater' =>  'required|string',
                'drying_machine' =>  'required|string',
                'dishwasher' =>  'required|string',
                'coffee_maker' =>  'required|string',
                'microwave' =>  'required|string',
                'stove' =>  'required|string',
                'fridge' =>  'required|string',
                'parking_space' =>  'required|string',
                'internet' =>  'required|string',
                'air_conditioner' =>  'required|string',
                'television' =>  'required|string',
                'window_view' =>  'required|string',
                'children' =>  'required|string',
                'pets' =>  'required|string',
                'balcony' =>  'required|string',
                'celling_height' =>  'required|string',
                'bathroom' =>  'required|string',
                'new_building' =>  'required|string',
                'currency' =>  'required|string|max:3',
                'user_id'   =>  'required|integer',
                'category_id'   =>  'required|integer',
                'user_type'   =>  'required|integer',
            ]);

            if($validator->fails()){
                dd($validator->errors());
            }
            $category_name = 'App\Models\\'.$request->category;
            $data = $category_name::create($validator->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('images', 'public'); // Save in 'storage/app/public/images'

                    // Create image record
                    $category_name_image = 'App\Models\\'.$request->category.'image';

                    $category_name_image::create([
                        'item_id' => $data->id,
                        'image' => $imagePath,
                    ]);
                }
            }

        }
        elseif($request->category_name == "Electronic") {
dd('ne nash');
            $category_name = 'App\Models\\' . $request->category;
            $data = $category_name::create($validator->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('images', 'public'); // Save in 'storage/app/public/images'

                    // Create image record
                    $category_name_image = 'App\Models\\' . $request->category . 'image';

                    $category_name_image::create([
                        'item_id' => $data->id,
                        'image' => $imagePath,
                    ]);
                }
            }
        }
        else {

            $category_name = 'App\Models\\' . $request->category;
            $data = $category_name::create($validator->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('images', 'public'); // Save in 'storage/app/public/images'

                    // Create image record
                    $category_name_image = 'App\Models\\' . $request->category . 'image';

                    $category_name_image::create([
                        'item_id' => $data->id,
                        'image' => $imagePath,
                    ]);
                }
            }
        }
}


    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'subcategory_id' => 'required',
            'region_id' => 'required',
            'city_id' => 'required',
            'currency'     =>  'required',
            'price'     =>  'required',
            'status'     =>  'required',
        ]);

        $posts = new Post();
        if($request->category=='car')
        {
            $request->validate([
                'car_brend'     =>  'required',
                'car_models'     =>  'required',
                'car_type'     =>  'required',
                'car_motor'     =>  'required',
                'car_motor_volume'     =>  'required',
                'car_motor_size'     =>  'required',
                'car_year'   =>  'required',
                'car_transmission'  =>  'required',
            ]);



            $posts->user_id = Auth::user()->id;
            $posts->region_id  =   $request->region_id;
            $posts->city_id    =   $request->city_id;
            $posts->price   =   $request->price;
            $posts->currency    =   $request->currency;
            $posts->title   =   $request->title;
            $posts->description =   $request->description;
            $posts->category_id =   $request->category;
            $posts->sub_category_id     =   $request->sub_category;
            $posts->status  =   $request->status;

            $posts->brand   =   $request->car_brand;
            $posts->car_model   =   $request->car_models;
            $posts->car_type    =   $request->car_types;
            $posts->motor    =   $request->car_motor;
            $posts->motor_volume    =   $request->car_motor_volume;
            $posts->car_motor_size  =   $request->car_motor_size;
            $posts->year    =   $request->car_year;
            $posts->car_transmission    =   $request->transmission;
        }
        $posts->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');

                Image::create([
                    'url' => Storage::url($path),
                    'post_id' => $posts->id,
                ]);
            }

            return back()->with('success', 'Images uploaded and URLs saved successfully!');
        }

        return back()->withErrors('Image upload failed.');
    }
}
