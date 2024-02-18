$(document).ready(function () {

  //Check if Page is Reloaded
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
      $("#invalidCreds").html("");
      console.log( "This page is reloaded" );
    }

    // if (error.style.display === "none") {
    //   error.style.display = "block";
    // } else {
    //   error.style.display = "none";
    // }

//LOGIN Function
  $("#frmLogin").submit(function (e) {
    e.preventDefault();
  });

  $("#btnLogin").on("click", function () {
    var username = $("#inputUsername").val();
    var password = $("#inputPassword").val();

    //Login Route
    $.ajax({
      url: "../../Admin/Login/Controller.php",
      type: "POST",
      cache: false,
      enctype: 'multipart/form-data',
      data: {
        fnLogin: "fnLogin",
        Username: username,
        Password: password,
      },
      success: function (dataResult) { 
        var dataResult = JSON.parse(dataResult);

        if (dataResult.invalidCreds == 1) {
          document.getElementById("Loginerror").classList.add("alert");
          document.getElementById("Loginerror").classList.add("alert-danger");
          $("#invalidCreds").html("Incorrect username or password!");
        }else if (dataResult.notRegistered == 1) {
          document.getElementById("Loginerror").classList.add("alert");
          document.getElementById("Loginerror").classList.add("alert-danger");
          $("#invalidCreds").html("It's looks like this username - "+username+" was not registered.");
        }else if (dataResult.isLogin == 1) {
          var r = confirm("Login Successfully.");
          if (r == true) {
            window.location.assign("../../Admin/home.php");
          }
          else {
            //x = "You pressed Cancel!";
          }
        }
      }
    });
  });

//FORGOT PASSWORD FUNCTION
  $("#frmForgotpassword").submit(function (e) {
    e.preventDefault();
  });

  $("#sendCode").on("click", function () {
    var mail = $("#mail").val();
    var username = $("#Username").val();
    var usernameLength = username.length;
    var mailLength = mail.length;
    var isMail = "";

    localStorage.setItem("username", username);

    setLoaderToNone();

    if (username === "" || username === undefined || username === null || usernameLength <= 0) {
      setLoaderToNone();
      $("#invalidEmail").html("Username is required.");
    }
    else if (mail === "" || mail === undefined || mail === null || mailLength <= 0) {
      setLoaderToNone();
      $("#invalidEmail").html("Email is required.");
    } else {
      isMail = ValidateEmail(mail);
      if (isMail) {
        //Check if Users registered Email
        $.ajax({
          url: "../../Admin/Login/Controller.php",
          type: "POST",
          cache: false,
          enctype: 'multipart/form-data',
          data: {
            checkUserMail: "checkUserMail",
            Username: username,
            Email: mail,
          },
          success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);

            if(dataResult.checkMail == 1){
              //Send OTP Code
              $.ajax({
                url: "../../Sendemail/send_email.php",
                type: "POST",
                cache: false,
                enctype: 'multipart/form-data',
                data: {
                  send: "send",
                  email: mail
                },
                success: function (dataResult) {
                  var dataResult = JSON.parse(dataResult);
                  if (dataResult.isSent === true) {
                    setLoaderToNone();
                    window.location.assign("../Login/verifyOTP.php")
                  } else if (dataResult.isSent === false) {
                    setLoaderToNone();
                    alert('Failed to sent Email !');
                  } else if (dataResult.isRegistered === false) {
                    setLoaderToNone();
                    alert('It seems the Email is not yet Registered!.');
                  }
                }
              });
            }
            if (dataResult.invalidMail == 1) {
              setLoaderToNone();
              $("#invalidEmail").html("Invalid User Email.");
            } else if (dataResult.invalidUsername == 1) {
              setLoaderToNone();
              $("#invalidEmail").html("Invalid Username.");
            }
          }
        });
      }
    }
  });

  //Set load : TRUE
  function setLoaderToLoad(){
    let loader = document.getElementById("loader");
    if (loader.style.display === "none") {
      loader.style.display = "flex";
    }
  }

  //Set Load : FALSE
  function setLoaderToNone(){
    let loader = document.getElementById("loader");
    if (loader.style.display !== "none") {
      loader.style.display = "none";
    }

  }

  $("#mail").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#mail").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidEmail").html("");
  });
  
  $("#Username").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#Username").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidEmail").html("");
  });

  //Validate Entered Email
  function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
      setLoaderToLoad();
      return (true);
    }else{
      $("#invalidEmail").html("You have entered an invalid email.");
      $("#mail").focus();
      return (false);
    }
  }
//END FORGOT PASSWORD FUNCTION

//OTP Code FUNCTION
  $("#verifyCode").on("click", function () {
    var code = $("#code").val();
    var sesCode = $("#sessionCode").val();

    if(code === "" || code === undefined || code === null){
      $("#invalidCode").html("OTP Code is required.");
    }else{
      if(sesCode === code){
        var r = confirm("OTP Code Successfully verified.");
        if (r == true) {
          window.location.assign("../Login/resetpassword.php");
        }
        else {
          //x = "You pressed Cancel!";
        }
      }else{
        $("#invalidCode").html("OTP Code is invalid.");
      }
    }
  });

  //New Password FUNCTION
  $("#frmNewpassword").submit(function (e) {
    e.preventDefault();
  });

  $("#changePassword").on("click", function () {
    var curpass = $("#curpass").val();
    var newpass = $("#newpass").val();
    var connewpass = $("#connewpass").val();
    var username = localStorage.getItem("username");

    //Validate values
    if (checkParam(curpass) === true && checkParam(newpass) === true && checkParam(connewpass) === true) {
      //Check Current Password
      $.ajax({
        url: "../../Admin/Login/Controller.php",
        type: "POST",
        cache: false,
        enctype: 'multipart/form-data',
        data: {
          checkCurrentPass: "checkCurrentPass",
          curpass: curpass,
          Username: username
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.isCurrent == 1) {
            //Change New Password
            if (newpass === connewpass) {
              $.ajax({
                url: "../../Admin/Login/Controller.php",
                type: "POST",
                cache: false,
                enctype: 'multipart/form-data',
                data: {
                  changePass: "changePass",
                  Username: username,
                  Connewpass: connewpass
                },
                success: function (dataResult) {
                  var dataResult = JSON.parse(dataResult);
                  if (dataResult.isChange == 1) {
                    var r = confirm("Password Successfully Updated.");
                    if (r == true) {
                      window.location.assign("../Login/login.php");
                    }
                    else {
                      //x = "You pressed Cancel!";
                    }
                  } else if (dataResult.isChange == 0) {
                    $("#invalidPass").html("Failed to change Password.");
                  } else if (dataResult.invalidChange == 1) {
                    $("#invalidPass").html("Failed to change Password.");
                  }
                }
              });
            } else{
              $("#invalidPass").html("New Password did not match.");
            }
          } else if (dataResult.isCurrent == 0) {
            $("#invalidPass").html("Current password is Incorrect. Please Try again.");
            $("#curpass").focus();
          } else if (dataResult.invalidUsername == 1) {
            $("#invalidPass").html("Error to reset user password.");
          }
        }
      });
    }else{
      $("#invalidPass").html("Input Fields are required.");
    }
  });

  //Function Check param if Empty or NuLL
  function checkParam($param){
    if($param === null || $param === undefined || $param === ''){
      return false;
    }else{
      return true;
    }
  }

  $("#curpass").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#curpass").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidPass").html("");
  });

  $("#newpass").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#newpass").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidPass").html("");
  });
  
  $("#connewpass").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#connewpass").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidPass").html("");
  });

//END New Password FUNCTION

  $("#code").keyup(function () {
    $(this).blur();
    $(this).focus();
  });
  
  $("#code").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidCode").html("");
  });
//END OTP Code FUNCTION

//LOGIN Fields Text Change
  $("#inputUsername").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#inputUsername").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidCreds").html("");
    document.getElementById("Loginerror").classList.remove("alert");
    document.getElementById("Loginerror").classList.remove("alert-danger");
  });

  $("#inputPassword").keyup(function () {
    $(this).blur();
    $(this).focus();
  });

  $("#inputPassword").change(function () {
    // Do whatever you need to do on actual change of the value of the input field
    $("#invalidCreds").html("");
    document.getElementById("Loginerror").classList.remove("alert");
    document.getElementById("Loginerror").classList.remove("alert-danger");
  });

}); //END TAG