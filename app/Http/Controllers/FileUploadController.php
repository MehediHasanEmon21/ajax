<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class FileUploadController extends Controller
{
    public function index(){

    	return view('file_upload');

    }

    public function upload_file(Request $request){



     $image_code = '';
     $images = $request->file('file');
     foreach($images as $image)
     {
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images'), $new_name);
      $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/images/'.$new_name.'" class="img-thumbnail" /></div>';
     }

     $output = array(
      'success'  => 'Images uploaded successfully',
      'image'   => $image_code
     );

     return response()->json($output);


   }


    
}
