$(document).ready(function(){


$('#show_password').on('click',function(){

    var passwordField = $('#password');
    var passwordFieldType = passwordField.attr('type');

    if (passwordField.val() != '') {

        if (passwordFieldType == 'password') {
            passwordField.attr('type','text')
            $(this).text('Hide Password')
        }else{
            passwordField.attr('type','password')
            $(this).text('Show Password')
        }

    }else{
        alert('Enter Password First')
    }

})



})