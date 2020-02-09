<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - Multiple File Upload with Progressbar using Ajax jQuery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

 </head>
 <body>

  <body>  
   <div class="container box">  
   <div class="form-group">  
    <h3 align="center">Live Username Available or not By using PHP Ajax Jquery</h3><br />  
    <label>Enter Username</label>  
    <input type="text" name="username" id="username" class="form-control" onkeyup="myFunction()">
    <span id="availability"></span>
   </div>  
   <br />  
   <br />  
  </div> 

  <script>
    




function myFunction(){

    var name = $('#username').val();

    $.ajax({

        url:'/api/check/username',
        data:{
            name
        },
        success:function(result){

            if (result == 'success') {
                $('#availability').removeClass('text-danger').addClass('text-success').text('username availavle')
            }

            if (result == 'false') {
                $('#availability').removeClass('text-success').addClass('text-danger').text('username not availavle')
            }
        }

    })

}






  </script>
 </body>
</html>


