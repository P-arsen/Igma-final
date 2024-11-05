<?php

use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\VehicleController;

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, config('app.locales'))) {
        Session::put('locale', $locale);
        app()->setLocale($locale); // Set the application's locale
    }

    return redirect()->back(); // Redirect back to the previous page
})->name('switch-language');


Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes();

Route::get('/login/phone', 'App\Http\Controllers\Auth\LoginController@phone')->name('login.phone');
Route::post('/login/phone', 'App\Http\Controllers\Auth\LoginController@verify');

Route::get('/verify/{token}', 'App\Http\Controllers\Auth\RegisterController@verify')->name('register.verify');

Route::get('/login/{network}', 'App\Http\Controllers\Auth\NetworkController@redirect')->name('login.network');
Route::get('/login/{network}/callback', 'App\Http\Controllers\Auth\NetworkController@callback');

Route::get('/banner/get', 'BannerController@get')->name('banner.get');
Route::get('/banner/{banner}/click', 'BannerController@click')->name('banner.click');

Route::group([
    'prefix' => 'adverts',
    'as' => 'adverts.',
    'namespace' => 'Adverts',
], function () {
    Route::get('/show/{advert}', 'AdvertController@show')->name('show');
    Route::post('/show/{advert}/phone', 'AdvertController@phone')->name('phone');
    Route::post('/show/{advert}/favorites', 'FavoriteController@add')->name('favorites');
    Route::delete('/show/{advert}/favorites', 'FavoriteController@remove');

    Route::get('/{adverts_path?}', 'AdvertController@index')->name('index')->where('adverts_path', '.+');
});

Route::group(
    [
        'prefix' => 'cabinet',
        'as' => 'cabinet.',
        'namespace' => 'App\Http\Controllers\Cabinet',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('home');
            Route::get('/edit', 'ProfileController@edit')->name('edit');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::post('/phone', 'PhoneController@request');
            Route::get('/phone', 'PhoneController@form')->name('phone');
            Route::put('/phone', 'PhoneController@verify')->name('phone.verify');
            Route::post('/phone/auth', 'PhoneController@auth')->name('phone.auth');
        });

        Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
            Route::get('/', 'WalletController@index')->name('home');
            Route::get('/edit', 'WalletController@edit')->name('edit');
            Route::put('/update', 'WalletController@update')->name('update');
            Route::get('/payment', 'WalletController@payment')->name('payment');
        });


        Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
            Route::get('/', 'PostController@index')->name('index');
            Route::get('/{city}/edit', 'PostController@editForm')->name('edit');
            Route::put('/{city}/edit', 'PostController@edit');
            Route::get('/add-form', 'PostController@add_form')->name('add_form');
            Route::post('/store', 'PostController@store')->name('store');
            Route::post('/addpost', 'PostController@car')->name('addpost');
            Route::delete('/{city}/destroy', 'PostController@destroy')->name('destroy');
        });



        Route::get('favorites', 'FavoriteController@index')->name('favorites.index');
        Route::delete('favorites/{advert}', 'FavoriteController@remove')->name('favorites.remove');

        Route::resource('tickets', 'TicketController')->only(['index', 'show', 'create', 'store', 'destroy','send']);
        Route::post('tickets/{ticket}/message', 'TicketController@message')->name('tickets.message');

        Route::group([
            'prefix' => 'adverts',
            'as' => 'adverts.',
            'namespace' => 'Adverts',
            'middleware' => [App\Http\Middleware\FilledProfile::class],
        ], function () {
            Route::get('/', 'AdvertController@index')->name('index');
            Route::get('/create', 'CreateController@category')->name('create');
            Route::get('/create/region/{category}/{region?}', 'CreateController@region')->name('create.region');
            Route::get('/create/advert/{category}/{region?}', 'CreateController@advert')->name('create.advert');
            Route::post('/create/advert/{category}/{region?}', 'CreateController@store')->name('create.advert.store');

            Route::get('/{advert}/edit', 'ManageController@editForm')->name('edit');
            Route::put('/{advert}/edit', 'ManageController@edit');
            Route::get('/{advert}/photos', 'ManageController@photosForm')->name('photos');
            Route::post('/{advert}/photos', 'ManageController@photos');
            Route::get('/{advert}/attributes', 'ManageController@attributesForm')->name('attributes');
            Route::post('/{advert}/attributes', 'ManageController@attributes');
            Route::post('/{advert}/send', 'ManageController@send')->name('send');
            Route::post('/{advert}/close', 'ManageController@close')->name('close');
            Route::delete('/{advert}/destroy', 'ManageController@destroy')->name('destroy');
        });

        Route::group([
            'prefix' => 'banners',
            'as' => 'banners.',
            'namespace' => 'Banners',
            'middleware' => [App\Http\Middleware\FilledProfile::class],
        ], function () {
            Route::get('/', 'BannerController@index')->name('index');
            Route::get('/create', 'CreateController@category')->name('create');
            Route::get('/create/region/{category}/{region?}', 'CreateController@region')->name('create.region');
            Route::get('/create/banner/{category}/{region?}', 'CreateController@banner')->name('create.banner');
            Route::post('/create/banner/{category}/{region?}', 'CreateController@store')->name('create.banner.store');

            Route::get('/show/{banner}', 'BannerController@show')->name('show');
            Route::get('/{banner}/edit', 'BannerController@editForm')->name('edit');
            Route::put('/{banner}/edit', 'BannerController@edit');
            Route::get('/{banner}/file', 'BannerController@fileForm')->name('file');
            Route::put('/{banner}/file', 'BannerController@file');
            Route::post('/{banner}/send', 'BannerController@send')->name('send');
            Route::post('/{banner}/cancel', 'BannerController@cancel')->name('cancel');
            Route::post('/{banner}/order', 'BannerController@order')->name('order');
            Route::delete('/{banner}/destroy', 'BannerController@destroy')->name('destroy');
        });
    }
);

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'App\Http\Controllers\Admin',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {
        Route::post('/ajax/upload/image', 'UploadController@image')->name('ajax.upload.image');

        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
        Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');
        Route::post('/users/{user}/block', 'UsersController@block')->name('users.block');
        Route::post('/users/{user}/unblock', 'UsersController@unblock')->name('users.unblock');

        Route::resource('regions', 'RegionController');

        Route::resource('pages', 'PageController');

        Route::group(['prefix' => 'pages/{page}', 'as' => 'pages.'], function () {
            Route::post('/first', 'App\Http\ControllersPageController@first')->name('first');
            Route::post('/up', 'App\Http\Controllers\PageController@up')->name('up');
            Route::post('/down', 'App\Http\Controllers\PageController@down')->name('down');
            Route::post('/last', 'App\Http\Controllers\PageController@last')->name('last');
        });



        Route::group(['prefix' => 'adverts', 'as' => 'adverts.', 'namespace' => 'Adverts'], function () {

            Route::resource('categories', 'CategoryController');

            Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
                Route::post('/first', 'CategoryController@first')->name('first');
                Route::post('/up', 'CategoryController@up')->name('up');
                Route::post('/down', 'CategoryController@down')->name('down');
                Route::post('/last', 'CategoryController@last')->name('last');
                Route::post('/remove', 'CategoryController@remove')->name('remove');
                Route::post('/insert', 'CategoryController@insert')->name('insert');
                Route::resource('attributes', 'AttributeController')->except('index');
            });

            Route::get('/category-name', 'CategoryNameController@index')->name('category_name_index');

            Route::group(['prefix' => 'adverts', 'as' => 'adverts.', 'namespace' => 'Adverts'], function () {
                Route::get('/', 'AdvertController@index')->name('index');
                Route::get('/{advert}/edit', 'AdvertController@editForm')->name('edit');
                Route::put('/{advert}/edit', 'AdvertController@edit');
                Route::get('/{advert}/photos', 'AdvertController@photosForm')->name('photos');
                Route::post('/{advert}/photos', 'AdvertController@photos');
                Route::get('/{advert}/attributes', 'AdvertController@attributesForm')->name('attributes');
                Route::post('/{advert}/attributes', 'AdvertController@attributes');
                Route::post('/{advert}/moderate', 'AdvertController@moderate')->name('moderate');
                Route::get('/{advert}/reject', 'AdvertController@rejectForm')->name('reject');
                Route::post('/{advert}/reject', 'AdvertController@reject');
                Route::delete('/{advert}/destroy', 'AdvertController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'banners', 'as' => 'banners.'], function () {
            Route::get('/', 'BannerController@index')->name('index');
            Route::get('/{banner}/show', 'BannerController@show')->name('show');
            Route::get('/{banner}/edit', 'BannerController@editForm')->name('edit');
            Route::put('/{banner}/edit', 'BannerController@edit');
            Route::post('/{banner}/moderate', 'BannerController@moderate')->name('moderate');
            Route::get('/{banner}/reject', 'BannerController@rejectForm')->name('reject');
            Route::post('/{banner}/reject', 'BannerController@reject');
            Route::post('/{banner}/pay', 'BannerController@pay')->name('pay');
            Route::delete('/{banner}/destroy', 'BannerController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
            Route::get('/', 'TicketController@index')->name('index');
            Route::get('/{ticket}/show', 'TicketController@show')->name('show');
            Route::get('/{ticket}/edit', 'TicketController@editForm')->name('edit');
            Route::put('/{ticket}/edit', 'TicketController@edit');
            Route::post('{ticket}/message', 'TicketController@message')->name('message');
            Route::post('/{ticket}/close', 'TicketController@close')->name('close');
            Route::post('/{ticket}/approve', 'TicketController@approve')->name('approve');
            Route::post('/{ticket}/reopen', 'TicketController@reopen')->name('reopen');
            Route::delete('/{ticket}/destroy', 'TicketController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
                Route::get('/', 'ColorController@index')->name('index');
                Route::get('/{color}/edit', 'ColorController@editForm')->name('edit');
                Route::put('/{color}/edit', 'ColorController@edit');
                Route::get('/add-form', 'ColorController@add_form')->name('add_form');
                Route::post('/store', 'ColorController@store')->name('store');
                Route::delete('/{color}/destroy', 'ColorController@destroy')->name('destroy');
            });


        Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
            Route::get('/', 'CityController@index')->name('index');
            Route::get('/{city}/edit', 'CityController@editForm')->name('edit');
            Route::put('/{city}/edit', 'CityController@edit');
            Route::get('/add-form', 'CityController@add_form')->name('add_form');
            Route::post('/store', 'CityController@store')->name('store');
            Route::delete('/{city}/destroy', 'CityController@destroy')->name('destroy');
        });


        Route::group(['prefix' => 'real-estate', 'as' => 'real-estates.'], function () {

        Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
            Route::get('/', 'RealEstateController@index')->name('index');
            Route::get('/{realEstate}/edit', 'RealEstateController@editForm')->name('edit');
            Route::put('/{realEstate}/edit', 'RealEstateController@edit');
            Route::get('/add-form', 'RealEstateController@add_form')->name('add_form');
            Route::post('/store', 'RealEstateController@store')->name('store');
            Route::delete('/{realEstate}/destroy', 'RealEstateController@destroy')->name('destroy');
        });

            Route::group(['prefix' => 'renovation', 'as' => 'renovation.'], function () {
                Route::get('/', 'RenovationController@index')->name('index');
                Route::get('/{realEstate}/edit', 'RenovationController@editForm')->name('edit');
                Route::put('/{realEstate}/edit', 'RenovationController@edit');
                Route::get('/add-form', 'RenovationController@add_form')->name('add_form');
                Route::post('/store', 'RenovationController@store')->name('store');
                Route::delete('/{renovation}/destroy', 'RenovationController@destroy')->name('destroy');
            });
});
        Route::group(['prefix' => 'car', 'as' => 'car.'], function () {

            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Car\BrandController@index')->name('index');
                Route::get('/{car}/edit', 'Car\BrandController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\BrandController@edit');
                Route::get('/add-form', 'Car\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Car\BrandController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\BrandController@destroy')->name('destroy');
            });


        Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
            Route::get('/', 'Car\ModelController@index')->name('index');
            Route::get('/{car}/edit', 'Car\ModelController@editForm')->name('edit');
            Route::put('/{car}/edit', 'Car\ModelController@edit');
            Route::get('/add-form', 'Car\ModelController@add_form')->name('add_form');
            Route::post('/store', 'Car\ModelController@store')->name('store');
            Route::delete('/{car}/destroy', 'Car\ModelController@destroy')->name('destroy');
        });

            Route::group(['prefix' => 'drive_type', 'as' => 'drive_type.'], function () {
                Route::get('/', 'Car\DriveTypeController@index')->name('index');
                Route::get('/{car}/edit', 'Car\DriveTypeController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\DriveTypeController@edit');
                Route::get('/add-form', 'Car\DriveTypeController@add_form')->name('add_form');
                Route::post('/store', 'Car\DriveTypeController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\DriveTypeController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'motor', 'as' => 'motor.'], function () {
                Route::get('/', 'Car\MotorController@index')->name('index');
                Route::get('/{car}/edit', 'Car\MotorController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\MotorController@edit');
                Route::get('/add-form', 'Car\MotorController@add_form')->name('add_form');
                Route::post('/store', 'Car\MotorController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\MotorController@destroy')->name('destroy');
            });
            Route::group(['prefix' => 'wheels', 'as' => 'wheels.'], function () {
                Route::get('/', 'Car\WheelsController@index')->name('index');
                Route::get('/{car}/edit', 'Car\WheelsController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\WheelsController@edit');
                Route::get('/add-form', 'Car\WheelsController@add_form')->name('add_form');
                Route::post('/store', 'Car\WheelsController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\WheelsController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'motor-size', 'as' => 'motor-size.'], function () {
                Route::get('/', 'Car\MotorSizeController@index')->name('index');
                Route::get('/{car}/edit', 'Car\MotorSizeController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\MotorSizeController@edit');
                Route::get('/add-form', 'Car\MotorSizeController@add_form')->name('add_form');
                Route::post('/store', 'Car\MotorSizeController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\MotorSizeController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'transmission', 'as' => 'transmission.'], function () {
                Route::get('/', 'Car\TransmissionController@index')->name('index');
                Route::get('/{car}/edit', 'Car\TransmissionController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\TransmissionController@edit');
                Route::get('/add-form', 'Car\TransmissionController@add_form')->name('add_form');
                Route::post('/store', 'Car\TransmissionController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\TransmissionController@destroy')->name('destroy');
            });


            Route::group(['prefix' => 'engine-type', 'as' => 'engine-type.'], function () {
                Route::get('/', 'Car\EngineTypeController@index')->name('index');
                Route::get('/{car}/edit', 'Car\EngineTypeController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\EngineTypeController@edit');
                Route::get('/add-form', 'Car\EngineTypeController@add_form')->name('add_form');
                Route::post('/store', 'Car\EngineTypeController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\EngineTypeController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'headlights', 'as' => 'headlights.'], function () {
                Route::get('/', 'Car\HeadlightsController@index')->name('index');
                Route::get('/{car}/edit', 'Car\HeadlightsController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\HeadlightsController@edit');
                Route::get('/add-form', 'Car\HeadlightsController@add_form')->name('add_form');
                Route::post('/store', 'Car\HeadlightsController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\HeadlightsController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'interior', 'as' => 'interior.'], function () {
                Route::get('/', 'Car\InteriorController@index')->name('index');
                Route::get('/{car}/edit', 'Car\InteriorController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\InteriorController@edit');
                Route::get('/add-form', 'Car\InteriorController@add_form')->name('add_form');
                Route::post('/store', 'Car\InteriorController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\InteriorController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'roof', 'as' => 'roof.'], function () {
                Route::get('/', 'Car\RoofController@index')->name('index');
                Route::get('/{car}/edit', 'Car\RoofController@editForm')->name('edit');
                Route::put('/{car}/edit', 'Car\RoofController@edit');
                Route::get('/add-form', 'Car\RoofController@add_form')->name('add_form');
                Route::post('/store', 'Car\RoofController@store')->name('store');
                Route::delete('/{car}/destroy', 'Car\RoofController@destroy')->name('destroy');
            });
});

        Route::group(['prefix' => 'phone', 'as' => 'phone.'], function () {

            Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
                Route::get('/', 'Phone\ModelController@index')->name('index');
                Route::get('/{model}/edit', 'Phone\ModelController@editForm')->name('edit');
                Route::put('/{model}/edit', 'Phone\ModelController@edit');
                Route::get('/add-form', 'Phone\ModelController@add_form')->name('add_form');
                Route::post('/store', 'Phone\ModelController@store')->name('store');
                Route::delete('/{model}/destroy', 'Phone\ModelController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Phone\BrandController@index')->name('index');
                Route::get('/{brand}/edit', 'Phone\BrandController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Phone\BrandController@edit');
                Route::get('/add-form', 'Phone\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Phone\BrandController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Phone\BrandController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'memory', 'as' => 'memory.'], function () {
                Route::get('/', 'Phone\MemoryController@index')->name('index');
                Route::get('/{memory}/edit', 'Phone\MemoryController@editForm')->name('edit');
                Route::put('/{memory}/edit', 'Phone\MemoryController@edit');
                Route::get('/add-form', 'Phone\MemoryController@add_form')->name('add_form');
                Route::post('/store', 'Phone\MemoryController@store')->name('store');
                Route::delete('/{memory}/destroy', 'Phone\MemoryController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'tablet', 'as' => 'tablet.'], function () {

            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Tablet\BrandController@index')->name('index');
                Route::get('/{brand}/edit', 'Tablet\BrandController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Tablet\BrandController@edit');
                Route::get('/add-form', 'Tablet\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Tablet\BrandController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Tablet\BrandController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'model', 'as' => 'model.'], function () {
                Route::get('/', 'Tablet\ModelController@index')->name('index');
                Route::get('/{model}/edit', 'Tablet\ModelController@editForm')->name('edit');
                Route::put('/{model}/edit', 'Tablet\ModelController@edit');
                Route::get('/add-form', 'Tablet\ModelController@add_form')->name('add_form');
                Route::post('/store', 'Tablet\ModelController@store')->name('store');
                Route::delete('/{model}/destroy', 'Tablet\ModelController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
                Route::get('/', 'Tablet\ScreenSizeController@index')->name('index');
                Route::get('/{size}/edit', 'Tablet\ScreenSizeController@editForm')->name('edit');
                Route::put('/{size}/edit', 'Tablet\ScreenSizeController@edit');
                Route::get('/add-form', 'Tablet\ScreenSizeController@add_form')->name('add_form');
                Route::post('/store', 'Tablet\ScreenSizeController@store')->name('store');
                Route::delete('/{size}/destroy', 'Tablet\ScreenSizeController@destroy')->name('destroy');
            });
        });
        Route::group(['prefix' => 'games', 'as' => 'games.'], function () {
            Route::group(['prefix' => 'pc', 'as' => 'pc.'], function () {
                Route::get('/', 'Games\PCGamesController@index')->name('index');
                Route::get('/{game}/edit', 'Games\PCGamesController@editForm')->name('edit');
                Route::put('/{game}/edit', 'Games\PCGamesController@edit');
                Route::get('/add-form', 'Games\PCGamesController@add_form')->name('add_form');
                Route::post('/store', 'Games\PCGamesController@store')->name('store');
                Route::delete('/{game}/destroy', 'Games\PCGamesController@destroy')->name('destroy');
            });
            Route::group(['prefix' => 'console', 'as' => 'console.'], function () {
                Route::get('/', 'Games\GameConsoleController@index')->name('index');
                Route::get('/{game}/edit', 'Games\GameConsoleController@editForm')->name('edit');
                Route::put('/{game}/edit', 'Games\GameConsoleController@edit');
                Route::get('/add-form', 'Games\GameConsoleController@add_form')->name('add_form');
                Route::post('/store', 'Games\GameConsoleController@store')->name('store');
                Route::delete('/{game}/destroy', 'Games\GameConsoleController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'notebook', 'as' => 'notebook.'], function () {
            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Notebook\BrandController@index')->name('index');
                Route::get('/{brand}/edit', 'Notebook\BrandController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Notebook\BrandController@edit');
                Route::get('/add-form', 'Notebook\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Notebook\BrandController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Notebook\BrandController@destroy')->name('destroy');
            });

                Route::group(['prefix' => 'screen', 'as' => 'screen.'], function () {
                    Route::get('/', 'Notebook\ScreenSizeController@index')->name('index');
                    Route::get('/{brand}/edit', 'Notebook\ScreenSizeController@editForm')->name('edit');
                    Route::put('/{brand}/edit', 'Notebook\ScreenSizeController@edit');
                    Route::get('/add-form', 'Notebook\ScreenSizeController@add_form')->name('add_form');
                    Route::post('/store', 'Notebook\ScreenSizeController@store')->name('store');
                    Route::delete('/{brand}/destroy', 'Notebook\ScreenSizeController@destroy')->name('destroy');
                });
        });

        Route::group(['prefix' => 'tv', 'as' => 'tv.'], function () {
            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Tv\BrandController@index')->name('index');
                Route::get('/{brand}/edit', 'Tv\BrandController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Tv\BrandController@edit');
                Route::get('/add-form', 'Tv\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Tv\BrandController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Tv\BrandController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'screen', 'as' => 'screen.'], function () {
                Route::get('/', 'Tv\ScreenSizeController@index')->name('index');
                Route::get('/{screen}/edit', 'Tv\ScreenSizeController@editForm')->name('edit');
                Route::put('/{screen}/edit', 'Tv\ScreenSizeController@edit');
                Route::get('/add-form', 'Tv\ScreenSizeController@add_form')->name('add_form');
                Route::post('/store', 'Tv\ScreenSizeController@store')->name('store');
                Route::delete('/{screen}/destroy', 'Tv\ScreenSizeController@destroy')->name('destroy');
            });
        });


        Route::group(['prefix' => 'washing_machine', 'as' => 'washing_machine.'], function () {
            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Washing_machine\BrandController@index')->name('index');
                Route::get('/{brand}/edit', 'Washing_machine\BrandController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Washing_machine\BrandController@edit');
                Route::get('/add-form', 'Washing_machine\BrandController@add_form')->name('add_form');
                Route::post('/store', 'Washing_machine\BrandController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Washing_machine\BrandController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'weight', 'as' => 'weight.'], function () {
                Route::get('/', 'Washing_machine\WeightController@index')->name('index');
                Route::get('/{weight}/edit', 'Washing_machine\WeightController@editForm')->name('edit');
                Route::put('/{weight}/edit', 'Washing_machine\WeightController@edit');
                Route::get('/add-form', 'Washing_machine\WeightController@add_form')->name('add_form');
                Route::post('/store', 'Washing_machine\WeightController@store')->name('store');
                Route::delete('/{weight}/destroy', 'Washing_machine\WeightController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'refrigerators', 'as' => 'refrigerators.'], function () {
            Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
                Route::get('/', 'Freezers\RefrigeratorsModelsController@index')->name('index');
                Route::get('/{brand}/edit', 'Freezers\RefrigeratorsModelsController@editForm')->name('edit');
                Route::put('/{brand}/edit', 'Freezers\RefrigeratorsModelsController@edit');
                Route::get('/add-form', 'Freezers\RefrigeratorsModelsController@add_form')->name('add_form');
                Route::post('/store', 'Freezers\RefrigeratorsModelsController@store')->name('store');
                Route::delete('/{brand}/destroy', 'Freezers\RefrigeratorsModelsController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
                Route::get('/', 'Freezers\RefrigeratorsTypeController@index')->name('index');
                Route::get('/{weight}/edit', 'Freezers\RefrigeratorsTypeController@editForm')->name('edit');
                Route::put('/{weight}/edit', 'Freezers\RefrigeratorsTypeController@edit');
                Route::get('/add-form', 'Freezers\RefrigeratorsTypeController@add_form')->name('add_form');
                Route::post('/store', 'Freezers\RefrigeratorsTypeController@store')->name('store');
                Route::delete('/{weight}/destroy', 'Freezers\RefrigeratorsTypeController@destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'filters', 'as' => 'filter.'], function () {
            Route::get('/', 'Filters\CategoryFiltersController@index')->name('index');
            Route::get('/{filter}/edit', 'Filters\CategoryFiltersController@editForm')->name('edit');
            Route::put('/{filter}/edit', 'Filters\CategoryFiltersController@edit');
            Route::get('/add-form', 'Filters\CategoryFiltersController@add_form')->name('add_form');
            Route::post('/store', 'Filters\CategoryFiltersController@store')->name('store');
            Route::delete('/{filter}/destroy', 'Filters\CategoryFiltersController@destroy')->name('destroy');
        });

//        Route::group(['prefix' => 'car/interior', 'as' => 'car.interior.'], function () {
//            Route::get('/', 'CarInteriorController@index')->name('index');
//            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
//            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
//            Route::put('/{car}/edit', 'CarInteriorController@edit');
//            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
//            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
//            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
//            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
//            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
//        });


//        Route::group(['prefix' => 'car/headlights', 'as' => 'car.headlights.'], function () {
//            Route::get('/', 'CarInteriorController@index')->name('index');
//            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
//            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
//            Route::put('/{car}/edit', 'CarInteriorController@edit');
//            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
//            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
//            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
//            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
//            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
//        });


        Route::group(['prefix' => 'car/sunroof', 'as' => 'car.sunroof.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'car/comfort', 'as' => 'car.comfort.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });

//        Route::group(['prefix' => 'car/transmission', 'as' => 'car.transmission.'], function () {
//            Route::get('/', 'CarInteriorController@index')->name('index');
//            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
//            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
//            Route::put('/{car}/edit', 'CarInteriorController@edit');
//            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
//            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
//            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
//            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
//            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
//        });

        Route::group(['prefix' => 'car/drive', 'as' => 'car.drive.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });


        Route::group(['prefix' => 'car/type', 'as' => 'car.type.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'car/engine', 'as' => 'car.engine.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'car/engine/type', 'as' => 'car.engine.type.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'car/condition', 'as' => 'car.condition.'], function () {
            Route::get('/', 'CarInteriorController@index')->name('index');
            Route::get('/{car}/show', 'CarInteriorController@show')->name('show');
            Route::get('/{car}/edit', 'CarInteriorController@editForm')->name('edit');
            Route::put('/{car}/edit', 'CarInteriorController@edit');
            Route::post('{car}/message', 'CarInteriorController@message')->name('message');
            Route::post('/{car}/close', 'CarInteriorController@close')->name('close');
            Route::post('/{car}/approve', 'CarInteriorController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarInteriorController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarInteriorController@destroy')->name('destroy');
        });


        Route::group(['prefix' => 'car/gas', 'as' => 'car.gas.','namespace' => 'Car'], function () {
            Route::get('/', 'CarGasController@index')->name('index');
            Route::get('/create', 'CarGasController@create')->name('create');
            Route::post('/store', 'CarGasController@store')->name('store');
            Route::get('/{car}/show', 'CarGasController@show')->name('show');
            Route::get('/{car}/edit', 'CarGasController@edit')->name('edit');
            Route::put('/{car}/edit', 'CarGasController@edit');
            Route::post('{car}/message', 'CarGasController@message')->name('message');
            Route::post('/{car}/close', 'CarGasController@close')->name('close');
            Route::post('/{car}/approve', 'CarGasController@approve')->name('approve');
            Route::post('/{car}/reopen', 'CarGasController@reopen')->name('reopen');
            Route::delete('/{car}/destroy', 'CarGasController@destroy')->name('destroy');
        });
        Route::get('/showtoindex', 'App\Http\Controllers\HomeController@single')->name('product')->where('page_path', '.+');


    }
);
Route::get('/add', 'App\Http\Controllers\Cabinet\Add\AddPostController@index')->name('add');
Route::get('/add/post', 'App\Http\Controllers\Cabinet\Add\AddPostController@add')->name('post');
//Route::get('/add/success', 'App\Http\Controllers\Cabinet\Add\AddPostController@success')->name('success');
Route::get('/business', [BusinessController::class, 'index'])->name('business');
Route::get('/business/{id}', [BusinessController::class, 'current'])->name('business/current');

Route::get('/product/slug', 'App\Http\Controllers\HomeController@single')->name('product')->where('page_path', '.+');
Route::get('/product/bazhin', 'App\Http\Controllers\HomeController@bajin')->name('category')->where('page_path', '.+');
Route::get('/admin/blockuser', 'App\Http\Controllers\HomeController@bajin')->name('block-user')->where('page_path', '.+');
Route::get('/test', function () {
    return view('test');
});

Route::get('/vehicles', [VehicleController::class, 'fetchVehicles']);

//Route::get('/{page_path}', 'App\Http\Controllers\PageController@show')->name('page')->where('page_path', '.+');

