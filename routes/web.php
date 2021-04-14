<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\NewPasswordController;


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


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function(){
        return view('home');
    });
    
    Route::group(['middleware' => ['auth', 'verified']], function(){
        Route::get('order', function () {
            return view('order_kit');
        });
        
        Route::get('unsubscribe', function () {
            return view('unsubscribe');
        });
        
        Route::get('myprofile', 'UserController@myprofile');
        
        Route::get('change-password', 'UserController@changepassword');
        Route::post('/change-password', [NewPasswordController::class, 'change'])
                        ->name('password.change');
        
        Route::get('myorders', 'OrderController@myorders');
        Route::get('myresults', 'SampleController@myresults');
        
        
        Route::group(['prefix' => 'admin', 'middleware' => ['admin' ]], function(){
            Route::get('dashboard', 'DashboardController@dashboard');
            
            Route::get('users', 'UserController@index');
            Route::get('users/{id}/edit', 'UserController@edit');
            Route::delete('users/{id}', 'UserController@destroy');
            
            Route::get('orders', 'OrderController@index');
            Route::post('orders', 'OrderController@store');
            Route::delete('orders/{id}', 'OrderController@destroy');
            Route::get('createOrder', 'OrderController@create');
            
            Route::get('orders/{id}/registerKit', 'KitController@create');
            Route::post('orders/{id}/registerKit', 'KitController@store');
            
            Route::get('kits/{id}/edit/{type?}', 'KitController@edit')->where(['type' => 'kits']);
            Route::put('kits/{id}/{type?}', 'KitController@update')->where(['type' => 'kits']);
            Route::delete('kits/{id}', 'KitController@destroy');
            Route::get('kits', 'KitController@index');
            
            Route::get('kits/{id}/registerSample', 'SampleController@registerSample');
            Route::post('kits/{id}/register', 'SampleController@register');
            Route::get('samples', 'SampleController@index');
            Route::get('samples/{id}/edit', 'SampleController@edit');
            Route::put('samples/{id}', 'SampleController@update');
            Route::delete('samples/{id}', 'SampleController@destroy');
            
            
            Route::get('reports', function () {
                return view('admin.reports');
            });
        });
    });
    
    Route::get('admin', 'DashboardController@home');
    
    Route::post('orderKit', 'OrderController@orderKit');
    Route::post('unsubscribe', 'UserController@unsubscribe');
    Route::put('user/updateprofile/{id}', 'UserController@updateprofile');
    
    Route::prefix('email')->group(function () {
        
        Route::get('/verify', function () {
            return view('auth.verify-email');
        })->middleware('auth')->name('verification.notice');
        
        Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            
            return redirect('/home');
        })->middleware(['auth', 'signed'])->name('verification.verify');
        
        
        Route::post('/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
            
            return back()->with('message', 'Verification link sent!');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
        
    });
    
    
});
/*
Route::get('/', function () {
    //return view('welcome');
    //return view('research');
    return view('home');
});
*/



    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');





    
    Route::get('/welcome', function () {
        return view('welcome');
    });
        
        
        
        
        
        Route::get('login', 'BankIDController@bankidlogin');
        Route::get('authenticate', 'BankIDController@bankidauthenticate');
        Route::post('checkpnr', 'PersonnummerController@valid');
        Route::get('logout', 'BankIDController@bankidlogout');
        
        
        
        
        
        
        Route::post('admin/search', 'SearchController@search');
        
        Route::get('admin/login', function () {
            return view('admin.login');
        });
            
            
            
            Route::get('admin/createUser', 'UserController@create');
            Route::post('admin/createUser', 'UserController@store');
            Route::get('admin/importUser', 'UserController@import');
            Route::post('admin/importUser', 'UserController@importUserSave');
            
            
            Route::put('admin/users/{id}', 'UserController@update');
            
            
            
            Route::get('admin/importOrder', 'OrderController@import');
            Route::post('admin/importOrder', 'OrderController@importOrderSave');
            
            
            Route::get('admin/importKit', 'KitController@import');
            Route::post('admin/importKit', 'KitController@importKitSave');
            Route::get('admin/importSample', 'SampleController@import');
            Route::post('admin/importSample', 'SampleController@importSampleSave');

require __DIR__.'/auth.php';
