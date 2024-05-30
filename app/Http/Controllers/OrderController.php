<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        $product=Product::findOrFail($request->product_id);
        if($this->checkQnt($request->qnt,$product->qnt))
        {
            Order::create([
                'product_id' => $request->product_id,
                'qnt'=>$request->qnt,
                'user_id'=>Auth::id(),
                'total-price'=>$product->price * $request->qnt,
                'color'=>$request->color,
                'address'=>$request->address,
                'tel_number'=>$request->tel_number
            ]);
            
            $product->qnt-=$request->qnt;
            $product->save();
            return response($product,201);
        }
        abort(403,'not enogh product');
    }
    public function checkQnt($request_qnt,$product_qnt)
    {
        $result=false;
        
        if($product_qnt >= $request_qnt)
            $result=true;

            return $result;
    }
}
