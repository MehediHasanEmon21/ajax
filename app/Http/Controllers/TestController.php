<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show_password_field(){

    	return view('show_password');
    }
}
