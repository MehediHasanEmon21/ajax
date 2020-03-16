<html>  
    <head>  
        <title>Twitter Like Follow Unfollow System in PHP using Ajax jQuery</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Twitter Like Follow Unfollow System in PHP using Ajax jQuery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Login</div>
    <div class="panel-body">
     <form method="post" action="{{ route('login.check') }}">
      @csrf
      <p class="text-danger"></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
      <div align="center">
       <a href="{{ route('register') }}">Register</a>
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>