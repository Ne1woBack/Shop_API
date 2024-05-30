<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductManagement extends Controller
{
    public function productList()
    {
        $product=Product::select('name','price','discription','user_id')->with('user:id,name')->get();
        return response($product,200);
    }
    public function productStore(ProductStoreRequest $request)
    {
        
        $Product=Product::create([
            'name'=>$request->name,
            'color'=>$request->color,
            'user_id'=>Auth::user()->id,
            'qnt'=>$request->qnt,
            'price'=>$request->price,
            'product_Code'=>$request->product_code,
            'discription'=>$request->discription,
        ]);
        return response($Product,201);
    }
    public function productDetails($id)
    {
        $Product= Product::findOrFail($id);
        return response($Product,200);
    }
    public function productUpdate(ProductUpdateRequest $request, $id)
    {
        $Product=Product::findOrFail($id);
        $Product->update([
            'name'=>$request->name,
            'color'=>$request->color,
            'user_id'=>Auth::user()->id,
            'qnt'=>$request->qnt,
            'price'=>$request->price,
            'product_Code'=>$request->product_code,
            'discription'=>$request->discription,
        ]);
         return response($Product,200);
    }
    public function productDelete($id)
    {
        Product::findOrFail($id)->delete();
        return response([],204);
    }
}
