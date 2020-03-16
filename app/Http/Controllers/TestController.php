<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
  public function show_register(){


    return view('register');

  }

  public function user_store(Request $request){

     $request->validate([
          'username' => 'required|unique:tbl_twitter_user|max:100',
          'password' => 'required|string|confirmed',
      ]);

     $data = [
      'username' => $request->username,
      'password' => Hash::make($request->password),
     ];

     DB::table('tbl_twitter_user')->insert($data);
     return back()->with('message','Successfully registered');



  }

  public function login(){

    return view('login');
  }

   public function login_check(Request $request){

      $user = DB::table('tbl_twitter_user')->where('username',$request->username)->first();

      if ( $user->username == $request->username && password_verify($request->password, $user->password)) {
          
          Session::put('user_id',$user->user_id);
          Session::put('username',$user->username);
          return redirect()->route('index.user');

      }else{

        return back()->with('message','Something Went wrong');

      }

  }


  public function index(){

    return view('index');

  }

  public function logout(){

    Session::flush();
    return redirect()->route('login.user');

  }


  public function post_add(Request $request){

    $data = [
      'user_id' => $request->user_id,
      'post_content' => $request->post_content,
      'post_datetime' => date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')))
    ];

    DB::table('tbl_samples_post')->insert($data);

    return response()->json('success');

  }

  public function fetch_post(Request $request){

      $posts = DB::table('tbl_samples_post')
              ->join('tbl_twitter_user','tbl_samples_post.user_id','tbl_twitter_user.user_id')
              ->leftJoin('tbl_follow','tbl_samples_post.user_id','tbl_follow.sender_id')
              ->where('tbl_samples_post.user_id',$request->user_id)
              ->orWhere('tbl_follow.receiver_id',$request->user_id)
              ->orderBy('tbl_samples_post.post_id','DESC')
              ->get();
      $output = '';
  if(count($posts) > 0)
  {
   foreach($posts as $row)
   {
    $profile_image = '';
    if($row->profile_image != '')
    {
     $profile_image = '<img src="/images/'.$row->profile_image.'" class="img-thumbnail img-responsive" />';
    }

    $output .= '
    <div class="jumbotron" style="padding:24px 30px 24px 30px">
     <div class="row">
      <div class="col-md-2">
       '.$profile_image.'
      </div>
      <div class="col-md-8">
       <h3><b>@'.$row->username.'</b></h3>
       <p>'.$row->post_content.'
        <button type="button" class="btn btn-link post_comment" id="'.$row->post_id.'" data-user_id="'.$row->user_id.'">'.$this->count_comment($row->post_id).' Comment</button>
       </p>

       <div id="comment_form'.$row->post_id.'" style="display:none;">
          <span id="old_comment'.$row->post_id.'"></span>
          <div class="form-group">
            <textarea name="comment" class="form-control" id="comment'.$row->post_id.'"></textarea>
          </div>
          <div class="form-group" align="right">
            <button type="button" name="submit_comment" class="btn btn-primary btn-xs submit_comment">Comment</button>
          </div>
        </div>
       
      </div>
     </div>
    </div>
    ';
   }
  }
  else
  {
   $output = '<h4>No Post Found</h4>';
  }
  echo $output;

  }

  public function count_comment($post_id){

      $comment_count = DB::table('tbl_comment')->where('post_id',$post_id)->get()->count();
      return $comment_count;

  }

  public function fetch_user(Request $request){

      $users = DB::table('tbl_twitter_user')->where('user_id','!=',$request->user_id)->get();
      $output = '';
      if (count($users) > 0) {

       foreach($users as $row){
         $profile_image = '';
         if($row->profile_image != '')
         {
          $profile_image = '<img src="/images/'.$row->profile_image.'" class="img-thumbnail img-responsive" />';
         }
         $output .= '
         <div class="row">
          <div class="col-md-4">
           '.$profile_image.'
          </div>
          <div class="col-md-8">
           <h4><b>@'.$row->username.'</b></h4>
           '.$this->make_follow_button($row->user_id,$request->user_id).'
           <span class="label label-success"> '.$row->follower_number.' Followers</span>
          </div>
         </div>
         <hr />
         ';
        }
      }

      echo $output;
      
        

      


  }

  public function make_follow_button($sender_id, $reciver_id){


      $output = '';
      $follow = DB::table('tbl_follow')->where('sender_id',$sender_id)->where('receiver_id',$reciver_id)->first();

      if (isset($follow)) {
        $output = '<button type="button" name="follow_button" class="btn btn-warning action_button" data-action="unfollow" data-sender-id="'.$sender_id.'"> Following</button>';


      }else{
          $output = '<button type="button" name="follow_button" class="btn btn-info action_button" data-action="follow" data-sender-id="'.$sender_id.'"><i class="glyphicon glyphicon-plus"></i> Follow</button>';
      }

      return $output;



  }

  public function follow_unfollow(Request $request){


      if ($request->action == "follow") {

        DB::table('tbl_follow')->insert(['sender_id' => $request->sender_id, 'receiver_id' => $request->user_id]);
        DB::table('tbl_twitter_user')->where('user_id',$request->sender_id)->increment('follower_number');

      }else{

          DB::table('tbl_follow')->where('receiver_id',$request->user_id)->where('sender_id', $request->sender_id)->delete();
          DB::table('tbl_twitter_user')->where('user_id',$request->sender_id)->decrement('follower_number');

      }

  }

  public function add_comment(Request $request){

    $data = [
      'post_id' => $request->post_id,
      'user_id' => $request->user_id,
      'comment' => $request->comment,
      'timestamp'  =>  date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')))
    ];

    DB::table('tbl_comment')->insert($data);

  }

  public function fetch_comment(Request $request){

    $comments = DB::table('tbl_comment')
                ->join('tbl_twitter_user','tbl_comment.user_id','tbl_twitter_user.user_id')
                ->where('tbl_comment.post_id',$request->post_id)
                ->get();
    $output = '';

    foreach($comments as $row)
      {
        $profile_image = '';
        if($row->profile_image != '')
        {
          $profile_image = '<img src="/images/'.$row->profile_image.'" class="img-thumbnail img-responsive img-circle" />';
        }
     
        $output .= '
        <div class="row">
          <div class="col-md-2">
          '.$profile_image.'  
          </div>
          <div class="col-md-10" style="margin-top:16px; padding-left:0">
            <small><b>@'.$row->username.'</b><br />
            '.$row->comment.'
            </small>
          </div>
        </div>
        <br />
        ';
      }

      echo $output;


  }


}


