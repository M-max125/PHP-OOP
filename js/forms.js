
$(document).ready(function () {

  $("#forgot-link").click(function () {
    $("#login-form").hide();
    $("#forgot-form").show();
  });

  $("#back-link").click(function () {
    $("#login-form").show();
    $("#forgot-form").hide();
  });
  
  
  
  
  //Register Ajax Request
    $("#register-btn").click(function (e) {
        if ($("#register-form")[0].checkValidity()) {
          e.preventDefault();

          
          if ($("#reg-password").val() != $("#conf-password").val()) {
              $("#passError").text("* Passwords do not match.");
              
          }
          else if (IsEmail($('#reg-email').val()) == false) {
              $("#mailError").text("* Please enter valid email address.");
              
              return false;
              
          }
          else if (checkUname($('#username').val()) == false) {
            $("#unameError").text("* Username can contain only alpha numeric,dash and underscore character.");
           
              return false;
          }
            else {
              $("#passError").text("");
              $("#mailError").text("");
              $("#unameError").text("");
            
              $.ajax({
                url: "actionReg.php",
                method: "post",
                data: $("#register-form").serialize(),
                    success: function (response) {
                        if (response === 'register') {
                          window.location = 'sugest.php';
                        } else {
                            $('#regAlert').html(response);
                      }
                      
                  
                  
                },
              }); 
          }
        }
    });
  
  //Login Ajax Request
  $('#login-btn').click(function (e) {
    if ($("#login-form")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: 'actionLog.php',
        method: 'post',
        data: $('#login-form').serialize(),
        success: function (response) {
          
          if (response === 'login') {
            window.location = 'sugest.php';
          } else {
            $('#logAlert').html(response);
          }
        }
      })
    }
  }
  );

  //Add recipe Ajax Request
  
  $('#add-recipe').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: 'actionAdd.php',
      method: 'post',
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        if (response === 'add') {
          location.reload();
        } else {
          $('#addAlert').html(response);
        }
      }
    });
  });

  //Forgot Password Ajax Request
  $('#forgot-btn').click(function (e) {
    if ($('#forgot-form')[0].checkValidity()) {
      e.preventDefault();

      $.ajax({
        url: 'actionForgot.php',
        method: 'post',
        data: $('#forgot-form').serialize(),
        success: function (response) {
          
          $('#forgot-form')[0].reset();
          $('#forgotAlert').html(response);
        }
      })
    }
  });
      
    
  
});

//Functions

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
       return false;
    }else{
       return true;
    }
  }

function checkUname(name) {
    var regEx = /^[a-zA-Z0-9_-]+$/;
    if (!regEx.test(name)) {
        return false;
    } else {
        return true;
    }
}