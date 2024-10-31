function isEmail(email) {
  let EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return EmailRegex.test(email);
}
(function( $ ) {
	'use strict';
$(".toggle-password").change(function() {
    if(this.checked) {
$("#your_password").attr('type', 'text');
$("#new_password").attr('type', 'text');
$("#new_password_confirmation").attr('type', 'text');
$("#the_password").attr('type', 'text');
$("#the_password_2").attr('type', 'text');
    } else {
     $("#your_password").attr('type', 'password');
     $("#new_password").attr('type', 'password');
     $("#new_password_confirmation").attr('type', 'password');
     $("#the_password").attr('type', 'password');
     $("#the_password_2").attr('type', 'password');
     
      
    }
});


	 
$(document).ready(function(){ 
    $('.tab-a').click(function(event){  
        event.preventDefault();
      $(".tab").removeClass('tab-active');
      $(".tab[data-id='"+$(this).attr('data-id')+"']").addClass("tab-active");
      $(".tab-a").removeClass('active-a');
      $(this).parent().find(".tab-a").addClass('active-a');
     });
});


 $('#pswlogform').submit(function(e){
                e.preventDefault();
                 let variabless =   $("#content-wrapper").data("variables");
                 let urls = $('#current_page').val();
                let url = $('#pswlogform').attr('action');
                let email  = $('#your_email_address').val();
                let password  = $('#your_password').val();
                if(!email) {
                    $("#emailError").text(variabless[0]);
                } 
                if(!password) {
                    $("#passwordError").text(variabless[1]);
                }
                if(email && password) {
                $.ajax({
                    type:"POST",
                    url: url,
                    data: $(this).serialize(), // get all form field value in serialize form
                    success: function(data){
                        if(~data.indexOf('wrong')) {
                               $("#generalError").text(variabless[2]);
                        } else if(~data.indexOf('inactive')) {
                               $("#generalError").text(variabless[3]); 
                        }  else {
                            
                            window.location.replace(urls);
                    }
                    }
                });
                }
            });
$('#pswresetform').submit(function(e){
                e.preventDefault();
                let variabless =   $("#content-wrapper").data("variables");
                let url = $('#pswresetform').attr('action');
                let email  = $('#youremail_address').val();
             let password_new  = $("input[name=new_password]").val();
                let password_new_val  = $("input[name=new_password_validation]").val();
                if(password_new && password_new !== password_new_val) {
$(".wrongcomb").text(variabless[4]);
                } 
              
             let token = $('#the_token').val();
                if(isEmail(email) === false) {
                    $("#emailErrorc").text(variabless[5]);
                     return;
                } 
             if(password_new && password_new !== password_new_val) {
                    return;
                }
                if(isEmail(email) === true) {
                $.ajax({
                    type:"POST",
                    url: url,
                    data: $(this).serialize(), // get all form field value in serialize form
                    success: function(data){
                        if(data) {
                        $("#pswtoken").html(data);
                        $("#passwError").hide();
                        $(".show_passwords").show();
                        }
                     else {
                          $("#youremail_address").prop('readonly', true);
                     // location.reload();
                     $("#pswtoken").html('<input type="number" class="client-info" name="token" placeholder="'+variabless[6]+'" id="the_token" required/>');
                     $("#passwError").text(variabless[7]);
                     $('#restbtn').html(variabless[8]);
                    }
                    }
                });
                }
            });
            
$("#registrationform").submit(function(e){
    e.preventDefault(); 
     let variabless =   $("#content-wrapper").data("variables");
    let url = $('#registrationform').attr('action');
    let newUserName = $('#new_username').val();
        let newUserEmail = $('#new_useremail').val();
        let first_name = $('#first_name').val();
         let last_name = $('#last_name').val();
         let new_password = $('#new_password').val();
          let new_password_confirmation = $('#new_password_confirmation').val();
       if(newUserName !== '' && first_name !== "" && last_name !== "" && new_password !== "" && new_password === new_password_confirmation) {
            $.ajax({
          type:"POST",
         url: url,
          data: $(this).serialize(),
          success: function(data){
               if (~data.indexOf("2022")) {
                $("#registrationform").hide();
                data = data.replace("2022", "");
            }
            
            $('.register-message').html(data).show();
           
          },
          error: function(data) {
        $('.register-message').html(data).show();
          }
        });
       } else { 
       if(!newUserName) {
        $("#registration_username_error").html(variabless[9]); 
       } else {
          $("#registration_username_error").hide(); 
       }
       if(!first_name) {
        $("#registration_firstname_error").html(variabless[10]); 
       } else {
          $("#registration_firstname_error").hide(); 
       }
       if(!last_name) {
        $("#registration_lastname_error").html(variabless[11]); 
       } else {
          $("#registration_lastname_error").hide(); 
       }
       if(!new_password) {
        $("#registration_password_error").html(variabless[12]); 
       }  else {
          $("#registration_password_error").hide(); 
       }
       if(new_password && new_password !== new_password_confirmation) {
        $("#registration_password_error_validation").html(variabless[13]); 
       } else {
          $("#registration_password_error_validation").hide(); 
       }
       
       if(isEmail(newUserEmail) !== true) {
        $("#registration_email_error").html(variabless[14]); 
       }else {
          $("#registration_email_error").hide(); 
       }
       }
});

})( jQuery );
