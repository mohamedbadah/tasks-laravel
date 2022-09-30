<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function(){
  Route::post('/login',[ApiAuthController::class,'login']);
  Route::post('/forget',[ApiAuthController::class,'forgetPassword']);
  Route::post('/resetPassword',[ApiAuthController::class,'resetPassword']);
  });
Route::prefix('auth')->middleware('auth:api')->group(function(){
  Route::get('/logout',[ApiAuthController::class,'logout']);
  Route::apiResource("categories",CategoryController::class);
});
Route::prefix('api')->group(function(){
    Route::get('/products',function(){
        // $data=Product::all();
        // $data=Product::max('price');
        // $data=Product::min('price');
        // $data=Product::avg('price');
        // $data=Product::sum('price');
        // $data=Product::count();
        // $data=Product::where('name','like','a%')->get();
        // $data=Product::all()->take(10);
        // $data=Product::all()->skip(10)->take(10);
        // $data=Product::all()->take(10)->skip(10); //[] collection means array
        // $data=Product::take(10)->skip(10)->get(); //sql
        // $data=Product::all()->limit(10); //error
        //take =>limit in sql
        //skip => offset in sql
        // $data=Product::limit(10)->get(); //sql
        // $data=Product::offset(10)->get(); //error
        // $data=Product::offset(10)->limit(10)->get();
        $data=Product::take(10)->offset(10)->get();
        return response()->json(['message'=>$data]);
      });
      Route::get('category',function(){
       $data=Category::findOrFail(2);
       return response()->json(['message'=>$data]);
      });
});
Route::get('/category',function(){
  // $data=Category::with('subCategories')->findOrFail(17);
  // $data=Category::withCount('subCategories')->findOrFail(17);
  // $data=Category::with('subCategories.products')->findOrFail(17);
  // $data=Category::with(['subCategories'=>function($query){
  //     $query->where('name','like','l%');
  // }])->findOrFail(17);
  // $data=Category::with('subCategories')->get();
  // access to subcategories with with
  // for($i=0;$i<count($data);$i++){
  //     for($j=0;$j<count($data[$i]->subCategories);$j++){
  //         echo $data[$i]->subCategories[$j]->name."<br>";
  //     }
  // }
  // $data=Category::withCount(['subCategories'=>function($query){
  //    $query->where('name','like','n%');
  // }])->get();
  // $data=User::has('orders','>',5)->get();
  // $data=User::withCount('orders')->has('orders','=',6)->get();
  // $data=User::whereHas('orders',function($query){
  //     $query->where('total','>',400);
  // },'>',5)->get();
  // $data=User::with('orders')->findOrFail(22);
  // $data=User::whereHas('orders',function($query){
  //     $query->where('total','>=',600);
  // },'>','5')->with('orders',function($query){
  //     $query->where('total','>=',600);
  // })->get();
  // $data=User::doesntHave('orders')->get();
  // $data=User::Has('orders','<',1)->get();
  // $data=User::whereDoesntHave('orders',function($query){
  //     $query->where('total','>',200);
  // })->with('orders')->get();
  // $data=Category::with('subCategories.products')->get();
  // $data=Order::with('orderDetails.product')->findOrFail(12);
  // $data=Order::findOrFail(12)->orderDetails;
  // $data=Order::findOrFail(12)->orderDetails()->get();
  // $data=Order::findOrFail(12)->orderDetails()->with('product')->get();
  // $data=Order::findOrFail(12)->products;
  // $data=Product::findOrFail(9)->orders;
  // $data=Product::with('orders')->findOrFail(9);
  // $data=Order::where('total','>',200)->exists();
  // $data=Order::where('total','>',200)->count()>0;
  // $data=order::where('total','>',200)->doesntExist();
  // $data=order::where('total','>',200)->count()==0;
  // $data=Product::findOrFail(27)->information;
  // $data=Product::with('information')->findOrFail(27);
  // $data=Category::with('subCategories.products')->findOrFail(17);
  // without category
  // $data=Category::findOrFail(17)->subCategories()->with('products')->get();
  // $data=Category::findOrFail(17)->products;
  // $data=Category::with('products')->get();
  // $data=Category::with('products')->findOrFail(17);
  $data=User::with('colors')->findOrFail(1);
  return response()->json(['message'=>$data]);
  });
