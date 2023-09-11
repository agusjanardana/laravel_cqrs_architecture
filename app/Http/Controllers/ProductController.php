<?php

namespace App\Http\Controllers;

use App\Events\OrderProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function createOrder(Request $request)
    {
        $data = $request->all();
        if (!isset($data)){
            return response()->json("data cannot be empty", 400);
        }

        try{
            event(new OrderProduct($data));
        } catch (\Exception $e){
            return response()->json("error", 500);
        }
    }

}
