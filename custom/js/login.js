setTimeout(function(){ $(".flash").fadeOut(); }, 2000);


function login_action() {


    /*falg to check the data, if there is an error, flag will turn to 1*/
    var flag = 0;

    /*Checking the value of inputs*/
    var email           =   $("#email").val().trim(); 
    var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var password        =   $("#password").val().trim(); 
    var site_url        =   $("#site_url").val().trim(); 

    /*Validating the values of inputs that it is neither null nor undefined.*/
    
    if(email=="" || email == undefined)
    {
       $("#emailErr").fadeIn().html("Email Required");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
         flag = 1;
         return false;
      
    } 
    else if(!email_pattern.test(email))
    {
       $("#emailErr").fadeIn().html("Invalid Email");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
        flag = 1;
        return false;
        
    }

    if(password=="" || password == undefined )
    {
       $("#passwordErr").fadeIn().html("Password Required");
       setTimeout(function(){ $("#passwordErr").fadeOut(); }, 3000);
       $("#password").focus();
        flag = 1;
        return false;
      
    } 

   /*if there is no error, go to flag==0 condition*/
        if (flag == 0) {
            /*Ajax call*/
            $.ajax({
              url: site_url+"/Login/login_action",
              method: 'POST',
              data: "email=" + email + "&password=" + password,
              success: function (result) {

                 /*result is the response from LoginController.php file under getLogin.php function*/
                if (result == 1) {
                    /*if response result is 1, it means it is successful.*/
                    $('#email').css('border', '1px solid green');
                    $('#password').css('border', '1px solid green');
                    setTimeout(function () {
                        /*Redirect to login page after 1 sec*/
                        window.location.href = site_url+"dashboard";
                    }, 300)
                } else if (result == 2) {
                    /*if response result is 2, it means, username is invalid.*/
                    $('#email').css('border', '1px solid red');
                    $(".account_error").fadeIn().html("Invalid Email");
                    setTimeout(function(){ $(".account_error").fadeOut(); }, 6000);
                    return false;
                    
                } else if (result == 3) {
                    /*if response result is 3, it means, password is invalid.*/
                    $('#password').css('border', '1px solid red');
                    $(".account_error").fadeIn().html("Invalid Password");
                    setTimeout(function(){ $(".account_error").fadeOut(); }, 6000);
                    return false;
                   
                } else if (result == 4 || result == 5) {
                    /*if response result is 4 or 5, it means, username & password are invalid.*/
                    $('#email').css('border', '1px solid red');
                    $('#password').css('border', '1px solid red');
                    $(".account_error").fadeIn().html("Invalid login credentials..!!");
                    setTimeout(function(){ $(".account_error").fadeOut(); }, 6000);
                    return false;
                  
                } else if(result == 6){
                  /*if response result is 6 it means, user is account is not activated yet.*/
                  $(".account_error").fadeIn().html("Your account is Inactive. Please contact admin.");
                  setTimeout(function(){ $(".account_error").fadeOut(); }, 6000);
                  return false;


                } else {
                    alert('Something went wrong'); return false;
                }


              }

            });


      }


}


function forgot_password_validation() {


   var email           =   $("#email").val().trim(); 
   var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if(email=="")
    {
       $(".valerr").fadeIn().html("Email Required");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#email").focus();
       return false; 
    } 
    else if(!email_pattern.test(email))
    {
       $(".valerr").fadeIn().html("Invalid Email");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#email").focus();
       return false;       
    } 

    $(".saveBtn").click();
}

function validations_reset_password() {
  
    var password        =   $("#password").val().trim(); 
    var confirm_password=   $("#confirm_password").val().trim(); 
    if(password=="")
    {
       $(".valerr").fadeIn().html("Password Required");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#password").focus();
       return false; 
     } 
     else if(password.length < 4 || password.length > 12 ){
       $(".valerr").fadeIn().html("4 to 12 characters are allowed in password");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#password").focus();
       return false; 
     }

    if(confirm_password==""){
        $(".valerr").fadeIn().html("Confirm Password Required");
        setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
        $("#confirm_password").focus();
        return false; 
    } 

    if(password != confirm_password ){
         $(".valerr").fadeIn().html("Confirm Password does not match with password");
         setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
         $("#confirm_password").focus();
         return false; 
    }
    $(".saveBtn").click();
}




