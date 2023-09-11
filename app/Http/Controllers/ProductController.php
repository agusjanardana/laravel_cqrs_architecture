<?php

namespace App\Http\Controllers;

use App\Events\OrderProduct;
use App\Events\Product;
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

            return response()->json([
                "message" => "success created order",
            ], 200);
        } catch (\Exception $e){
            return response()->json("error", 500);
        }
    }


    public function createProduct(Request $request)
    {
        $data = $request->all();
        if (!isset($data)){
            return response()->json(["message" => "data cannot be empty"], 400);
        }


        try{
            event(new Product($data));

            return response()->json([
                "message" => "success created product",
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }

    }

}
