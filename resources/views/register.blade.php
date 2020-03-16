<html>  
    <head>  
        <title>Twitter Like Follow Unfollow System in PHP using Ajax jQuery</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{--     <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    </head>  
    <body> 
        <div class="container">
   <br />
   
   <h3 align="center">Twitter Like Follow Unfollow System in PHP using Ajax jQuery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Register</div>
    <div class="panel-body">
     <form method="post" action="{{ route('user.store') }}">
      @csrf
      <span class="text-success">@if(Session::has('message')) {{ Session::get('megssage') }} @endif</span>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus />
       @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
       @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
       <label>Re-enter Password</label>
       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
      </div>
      <div class="form-group">
       <input type="submit" name="register" class="btn btn-info" value="Register" />
      </div>
      <div align="center">
       <a href="{{ route('login.user') }}">Login</a>
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>