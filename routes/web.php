<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Foundation\Auth\User;
use App\Models\Order_Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermission;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRole;
use App\Http\Controllers\ProductController;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserPermissionController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/user/{name?}', function ($name = 'John') {
//     return $name;
// });
Route::get('/user/{id}', function ($id) {
    return "user ".$id;
})->where('id', '[0-9]+');
Route::prefix('portfolios')->group(function(){
    Route::view('/','portfolio.header')->name('header');
    Route::view('/about','portfolio.about')->name('about');
    Route::view('/client','portfolio.client')->name('client');
    Route::view('/contant','portfolio.contact')->name('contact');
    Route::view('/portfolio','portfolio.portfolio')->name('Port');
    Route::view('/services','portfolio.services')->name('services');
    Route::view('/team','portfolio.team')->name('team');


});
Route::fallback(function(){
    echo "not page found";
});
Route::get('address/{email?}',function($email="NOT Found"){
    echo "hello ".$email;
});

//task
Route::resource('/product',ProductController::class);
// Route::post('logo/inter',[AuthController::class,'login']);
Route::middleware(['guest:user,admin'])->group(function(){
    Route::get('{guard}/login',[AuthController::class,'getLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('a',[AuthController::class,'a']);
Route::prefix('cms/admin')->middleware('auth:admin')->group(function(){
    Route::resource('admin',AdminController::class);
    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('role.permission',RolePermission::class);
    Route::resource('user.permission',UserPermissionController::class);
    Route::resource('admin.role',AdminRole::class);
    Route::resource('categories',CategoryController::class);
    Route::get('exp',function(){
            // $category=Category::with('users')->get();
            // return $category;
            // $order=Order::with('products')->findOrFail(4);
            // return $order;
           $user=User::whereHas('orders',function($query){
             $query->where('total','>',300);
           },'>',20)->get();
           return $user;
        
    });
});
Route::prefix('cms/admin')->middleware(['auth:user,admin'])->group(function(){
// Route::get('login',[AuthController::class,'getLogin'])->name('login');
Route::view('/index','cms.starter');
Route::resource('cities',CityController::class);
Route::resource('categories',CategoryController::class);
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::get('editpass',[AuthController::class,'editPass'])->name('editPass');
Route::get('editProfile',[AuthController::class,'editProfile'])->name('editProfile');
Route::put('updatePass',[AuthController::class,'updatePass']);
});
Route::prefix('cms')->middleware('age:13')->group(function(){
Route::get('A',function(){
    echo "hello A";
});
Route::get('B',function(){
    echo "hello B";
})->withoutMiddleware('age:13');
});

