function users_validation(){

    var name            =   $("#name").val().trim(); 
    var name_pattern    =   /^[a-zA-Z ]{2,30}$/;
    var email           =   $("#email").val().trim(); 
    var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var phone           =   $("#phone").val().trim(); 
    var phone_pattern   =   /^\d{10}$/;
  
    if(name=="")
    {
       $("#nameErr").fadeIn().html("<small>Name Required</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
       return false; 
    }
    else if(!name_pattern.test(name))
    {
       $("#nameErr").fadeIn().html("<small>Invalid Name</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
       return false;       
    }
   
    if(email=="")
    {
      $("#emailErr").fadeIn().html("<small>Email Required</small>");
      setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
      $("#email").focus();
      return false; 
     } 
    else if(!email_pattern.test(email))
    {
       $("#emailErr").fadeIn().html("<small>Invalid Email</small>");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
       return false;       
    }

    if(phone=="")
    {
      $("#phoneErr").fadeIn().html("<small>Phone No. Required</small>");
      setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
      $("#phone").focus();
      return false; 
     } 
    else if(!phone_pattern.test(phone))
    {
       $("#phoneErr").fadeIn().html("<small>Invalid Email</small>");
       setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
       $("#phone").focus();
       return false;       
    }

   
   $(".saveBtn").click();
    
}


function change_password_validation() {

  var password        =   $("#password").val().trim(); 
  var new_password        =   $("#new_password").val().trim(); 
  var confirm_password        =   $("#confirm_password").val().trim(); 

  if(password=="")
  {
     $("#passwordErr").fadeIn().html("Password Required");
     setTimeout(function(){ $("#passwordErr").fadeOut(); }, 3000);
     $("#password").focus();
     return false; 
  } 

  if(new_password=="")
  {
     $("#new_passwordErr").fadeIn().html("New Password Required");
     setTimeout(function(){ $("#new_passwordErr").fadeOut(); }, 3000);
     $("#new_password").focus();
     return false; 
  } 

  else if(new_password.length < 4 || new_password.length > 12 ){

     $("#new_passwordErr").fadeIn().html("4 to 12 characters are allowed");
     setTimeout(function(){ $("#new_passwordErr").fadeOut(); }, 3000);
     $("#new_password").focus();
     return false; 
  }

  if(confirm_password=="")
  {
     $("#confirm_passwordErr").fadeIn().html("Confirm Password Required");
     setTimeout(function(){ $("#confirm_passwordErr").fadeOut(); }, 3000);
     $("#confirm_password").focus();
     return false; 
  } 

  if(new_password != confirm_password ){
       $("#confirm_passwordErr").fadeIn().html("Does not match with password");
       setTimeout(function(){ $("#confirm_passwordErr").fadeOut(); }, 3000);
       $("#confirm_password").focus();
       return false; 
  }

  $(".saveBtn").click();


}

