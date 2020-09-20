setTimeout(function(){ $(".remove").fadeOut(); }, 3000);

function submit_employee() {
  

    /*falg to check the data, if there is an error, flag will turn to 1*/
    var flag = 0;
    /*Checking the value of inputs*/
    var name            =   $("#name").val().trim(); 
    var name_pattern    =   /^[a-zA-Z ]{2,30}$/;
    var email           =   $("#email").val().trim(); 
    var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var phone           =   $("#phone").val().trim(); 
    var phone_pattern   =   /^\d{10}$/;
    var site_url        =   $(".site_url").val();
    var id              =   $("#id").val();
    var button          =   $("#button").val();


    /*Validating the values of inputs that it is neither null nor undefined.*/
    if(name=="" || name == undefined)
    {
       $("#nameErr").fadeIn().html("<small>Name Required</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
        flag = 1;
       return false; 
    }
    else if(!name_pattern.test(name))
    {
       $("#nameErr").fadeIn().html("<small>Invalid Name</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
        flag = 1;
       return false;       
    }
   
    if(email=="" || email == undefined)
    {
      $("#emailErr").fadeIn().html("<small>Email Required</small>");
      setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
      $("#email").focus();
       flag = 1;
      return false; 
     } 
    else if(!email_pattern.test(email))
    {
       $("#emailErr").fadeIn().html("<small>Invalid Email</small>");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
        flag = 1;
       return false;       
    }

    if(phone=="" || phone == undefined)
    {
      $("#phoneErr").fadeIn().html("<small>Phone No. Required</small>");
      setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
      $("#phone").focus();
       flag = 1;
      return false; 
     } 
    else if(!phone_pattern.test(phone))
    {
       $("#phoneErr").fadeIn().html("<small>Invalid Phone No</small>");
       setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
       $("#phone").focus();
        flag = 1;
       return false;       
    }

     /*if there is no error, go to flag==0 condition*/
        if (flag == 0) {

            if(id != ''){

              url = site_url+"Employee/edit_action";

            }else{

              url  = site_url+"Employee/add_action";

            }

            /*Ajax call*/
            $.ajax({

                url: url,
                method: 'POST',
                data: "name=" + name + "&email=" + email + "&phone=" + phone + "&id=" + id + "&button=" +button,
                success: function (result) {

                  //DECODE THE JSON RESPONSE
                  obj     =   JSON.parse(result);
                  result  =   obj.result;
                  message =   obj.message;

               
                  if (result == 1) {
                    /*if response result is 1, it means it is successful.*/
                    setTimeout(function () {
                        /*Redirect to login page after 1 sec*/
                        window.location.href = site_url+"/employee-list";
                    }, 300)
                 }
                  else if (result == 2) {
                    /*if response result is 2, it means, name is invalid.*/
                    $('#name').css('border', '1px solid red');
                    $("#nameErr").fadeIn().html(message);
                    setTimeout(function(){ $("#nameErr").fadeOut(); }, 6000);
                    return false;
                    
                 }
                 else if (result == 3) {
                    /*if response result is 3, it means, email is invalid.*/
                    $('#email').css('border', '1px solid red');
                    $("#emailErr").fadeIn().html(message);
                    setTimeout(function(){ $("#emailErr").fadeOut(); }, 6000);
                    return false;
                    
                 }
                else if (result == 4) {
                    /*if response result is 4, it means, phone is invalid.*/
                    $('#phone').css('border', '1px solid red');
                    $("#phoneErr").fadeIn().html(message);
                    setTimeout(function(){ $("#phoneErr").fadeOut(); }, 6000);
                    return false;
                    
                }
                else if(result == 5){
                    /*if response result is 5, it means, there are validations error.*/
                      $(".account_error").fadeIn().html(message);
                      setTimeout(function(){ $(".account_error").fadeOut(); }, 6000);
                      return false;
                }
                else {
                    alert('Something went wrong'); return false;
                }
                 

                }

            });


          }




}



function change_status(id,status) {

  var ask             =   confirm("Are you sure to change status?");

  if(ask == true){

  var site_url        =   $(".site_url").val();
    /*Ajax call*/
    $.ajax({
          url: site_url+"/Employee/change_status",
          method: 'POST',
          data: "id=" + id + "&status=" + status ,
          success: function (result) {

            //DECODE THE JSON RESPONSE
            obj     =   JSON.parse(result);
            result  =   obj.result;
            message =   obj.message;
            btn     =   obj.btn;
       
            if(result == 1){
              $("#successMessage").html(message);
              $("#status"+id).html(btn);
              setTimeout(function(){ $("#successMessage").fadeOut(); }, 3000);
            }
            else{
              alert("Something went wrong..!!");return false;
            }
          

          }

        });
      }
 
   }






