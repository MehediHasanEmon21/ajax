<br />
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Webslesson</a>
     </div>
     <ul class="nav navbar-nav navbar-right">
      <li>
       <input type="text" name="search_user" id="search_user" class="form-control input-sm" placeholder="Search User" autocomplete="off" style="margin-top: 10px; width: 400px; margin-right:180px;" />
      </li>
      <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="view_notification">Notification
       
        <span class="caret"></span></a>
        <ul class="dropdown-menu">

        </ul>
       </a>
      </li>
      <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Session::get('username')}}
       <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="{{ route('user.logout') }}">Logout</a></li>
       </ul>
      </li>
     </ul>
    </div>
   </nav>