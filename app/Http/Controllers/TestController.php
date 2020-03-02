<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
  public function edit_text_view(){

    $emp = DB::table('tbl_employee')->where('id',1)->first();
    return view('editable-text',compact('emp'));

  }

  public function update(Request $request){

    $name = $request->name;
    $gender = $request->gender;
    $designation = $request->designation;
    $employee_id = $request->employee_id;

    $country = DB::table('tbl_employee')->where('id',$employee_id)->update(['name' => $name, 'gender' => $gender, 'designation' => $designation]);
    $emp = DB::table('tbl_employee')->where('id',$employee_id)->first();

    $output = '<p><strong>Name - </strong>'.$emp->name.'</p>  
               <p><strong>Gender - </strong>'.$emp->gender.'</p>  
               <p><strong>Designation - </strong>'.$emp->designation.'</p>';


    echo $output;
    



  }
}
