<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductManagement;
use App\Http\Controllers\RoleManagement;
use App\Http\Controllers\UserManagement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);







Route::middleware('auth:sanctum')->group(function(){
    Route::controller(OrderController::class)->group(function(){
        Route::prefix('OrderController')->group(function(){
            Route::post('order/create','createOrder');
        });
    Route::middleware('admin')->group(function(){



        Route::controller(RoleManagement::class)->group(function(){
            Route::prefix('RoleManagement')->group(function(){
            Route::post('role/create','roleStore');
            Route::delete('role/{id}','roleDelete')->whereNumber('id');
            Route::put('role/{id}','roleUpdate')->whereNumber('id');
            Route::get('roles','roleList');
            Route::get('role/{id}','roleDetails')->whereNumber('id');
            });
        });

        Route::controller(UserManagement::class)->group(function(){
            Route::prefix('UserManagement')->group(function(){
                Route::get('users','userList');
                Route::post('user/create','userStore');
                Route::get('user/{id}','userDetails')->whereNumber('id');
                Route::put('user/{id}','userUpdate')->whereNumber('id');
                Route::delete('user/{id}','userDelete')->whereNumber('id');
             }); 
        });



          
        });


        
        Route::controller(ProductManagement::class)->group(function(){
            Route::prefix('ProductManagement')->group(function(){
            Route::get('products','productList');
            Route::post('product/create','productStore');
            Route::get('product/{id}','productDetails')->whereNumber('id');
            Route::put('product/{id}','productUpdate')->middleware('admin')->whereNumber('id');
            Route::delete('product/{id}','productDelete')->middleware('admin')->whereNumber('id');
        });
     });
    });
    Route::get('user',[AuthenticationController::class,'user']);
    Route::get('logout',[AuthenticationController::class,'logout']);
});




