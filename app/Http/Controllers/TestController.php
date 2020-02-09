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
}
