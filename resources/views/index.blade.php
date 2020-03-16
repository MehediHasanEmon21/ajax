<html>  
    <head>  
        <title>Twitter Like Follow Unfollow System in PHP using Ajax jQuery</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <style>

        .main_division
        {
            position: relative;
            width: 100%;
            height: auto;
            background-color: #FFF;
            border: 1px solid #CCC;
            border-radius: 3px;
        }
        #sub_division
        {
            width: 100%;
            height: auto;
            min-height: 80px;
            overflow: auto;
            padding:6px 24px 6px 12px;
        }
        .image_upload
        {
            position: absolute;
            top:0px;
            right:16px;
        }
        .image_upload > form > input
        {
            display: none;
        }

        .image_upload img
        {
            width: 24px;
            cursor: pointer;
        }

        </style>
    </head>  
    <body>  
        <div class="container">
   
            @include('menu')

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="panel-title">Start Write Here</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" id="post_form">
                                <div class="form-group" id="dynamic_field">
                                    <textarea name="post_content" id="post_content" maxlength="160" class="form-control" placeholder="Write your short story"></textarea>
                                </div>
                                <div id="link_content"></div>
                                <div class="form-group" align="right">
                                    <input type="hidden" name="action" value="insert" />
                                    <input type="hidden" name="user_id" id="user_id" value="{{ Session::get('user_id') }}" />
                                    <input type="hidden" name="post_type" id="post_type" value="text" />
                                    <input type="submit" name="share_post" id="share_post" class="btn btn-primary" value="Share" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Trending Now</h3>
                        </div>
                        <div class="panel-body">
                            <div id="post_list">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">User List</h3>
                        </div>
                        <div class="panel-body">
                            <div id="user_list"></div>
                        </div>
                    </div>
                </div>
            </div>
  </div>
    </body>  
</html>

<script>
    $(document).ready(function(){

        $('#post_form').on('submit',function(event){


        event.preventDefault();

        if($('#post_content').val() == '')
        {
            alert('Enter Story Content');
        }else{
                var form_data = $(this).serialize();
                $.ajax({

                url:'/api/post/add',
                method: 'POST',
                data: form_data,
                success:function(data){

                    $('#post_form')[0].reset();
                    fetch_post();


                }

                });

            }


        });

        fetch_post();
        fetch_user();

        function fetch_post(){

            var user_id = $('#user_id').val();

            $.ajax({
                url: '/api/fetch/post',
                data: {
                    user_id: user_id
                },
                success:function(data){

                    $('#post_list').html(data);

                }

            });

        }

        function fetch_user(){

            var user_id = $('#user_id').val();

            $.ajax({

                url: '/api/fetch/user',
                data: {
                    user_id: user_id
                },
                success:function(data){

                    $('#user_list').html(data);

                }

            });

        }

        $(document).on('click','.action_button', function(){


            var sender_id = $(this).data('sender-id');
            var action = $(this).data('action');
            var user_id = $('#user_id').val();

            $.ajax({

            url:'/api/follow/unfollow',
            data: {
                sender_id: sender_id,
                action: action,
                user_id: user_id
            },
            success:function(data){

                fetch_post();
                fetch_user();

            }



            });



            


        });

        var post_id;
        var post_user_id;

        $(document).on('click', '.post_comment', function(){

            post_id = $(this).attr('id');
            post_user_id = $(this).data('user_id');
            $('#comment_form'+post_id).slideToggle('slow');
            $.ajax({
                url: '/api/fetch/comment',
                data: {
                    post_id: post_id,
                },
                success: function(data){
                    $('#old_comment'+post_id).html(data);
                    $('#comment_form'+post_id).slideDown('slow');
                }
            });

        });

        $(document).on('click','.submit_comment',function(){
            var comment = $('#comment'+post_id).val();
            var ses_user_id = $('#user_id').val();

            if (comment != '') {

                $.ajax({
                    url: '/api/add/comment',
                    method: 'POST',
                    data: {
                        user_id: ses_user_id,
                        post_id: post_id,
                        comment: comment,
                    },

                    success:function(data){
                        $('#comment_form'+post_id).slideUp('slow');
                        fetch_post();
                    }


                });

            }

            

        })




    })
    



</script>
