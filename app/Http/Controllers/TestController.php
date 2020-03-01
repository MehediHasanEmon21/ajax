<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
  public function auto_search_view(){

    return view('auto-search');

  }

  public function auto_search(Request $request){

    $query = $request->get('query');
    $country = DB::table('locations')->select('country')->where('country','LIKE','%'.$query.'%')->distinct()->get();
    $output = '';

    $output .= '<ul class="list-unstlied" style="list-style:none">';

    if (count($country) > 0) {
        foreach ($country as   $row) {
        $output .='<li>'.$row->country.'</li>';
        }
    }else{
        $output .= '<li>No item found</li>';
    }

    $output .= '</ul>';

    echo $output;
    



  }
}
