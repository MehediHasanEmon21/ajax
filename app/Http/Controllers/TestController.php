<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    public function show_password_field(){

    	return view('show_password');
    }

    public function checkUsernameAvailable(Request $request){

    	$name = $request->name;

    	$available = DB::table('tbl_users')->where('user_name',$name)->get();

    	if (count($available) > 0) {
    		return response()->json('false');
    	}else{
    		return response()->json('success');
    	}

    }



    public function product_load_by_price_view(){
        $products = DB::table('product')->orderBy('product_id','DESC')->get();
        return view('product_load_price',compact('products'));
    }


    public function product_by_price(Request $request){

        $price = $request->price;

        $products = DB::table('product')->where('product_price','<',$price)->orderBy('product_price')->get();
        return view('response.filter_price_product',compact('products'));

    }
}
