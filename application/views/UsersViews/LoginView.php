<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="utf-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="<?= base_url('resources/css/login.css'); ?>" type="text/css" /> 
    </head>
    <body>
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto">
                                    <h3 id="form_text" class="login-heading mb-4">Welcome back!</h3>
                                    <div class="alert alert-danger" id="formError" role="alert">
                                        Incorrect data!
                                    </div>
                                    <form id="userData" name="userData">
                                        <div class="form-label-group">
                                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                            <label for="inputEmail">Email address</label>
                                        </div>

                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword"  name="inputPassword" class="form-control" placeholder="Password" required>
                                            <label for="inputPassword">Password</label>
                                        </div>


                                        <div id="divConfirmPassword" class="form-label-group hidden">
                                            <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" placeholder="Password" required>
                                            <label for="inputConfirmPassword">Confirm password</label>
                                        </div>


                                        <button id="submitButn" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="button" onclick="checkUser();">Sign in</button>
                                        <div class="text-center">
                                            <a id="createAcc" class="small" href="#" onclick="showRegistrationForm();">Create account</a>
                                        </div>

                                        <input type="hidden" value="1" name="key" id="keyField"/>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
<footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        function showRegistrationForm(){
            document.getElementById("form_text").innerHTML = "Create account";
            document.getElementById("submitButn").innerHTML = "Create account";
            document.getElementById("divConfirmPassword").classList.remove("hidden");
            document.getElementById("createAcc").classList.add("hidden");
            document.getElementById("keyField").value = 2;
            //document.getElementById("fPass").classList.add("hidden");
        }

    </script>
    <script type="text/javascript"> 
        $('#formError').hide();       
        function checkUser(){
            $(document).ready(function(){
                if(validate()){
                    var dataString = $("#userData").serialize();
                    var url="checkUser"
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url() ?>"+url,
                        data:dataString,
                        success:function (data) {
                            if(data === "r"){
                                //registration
                                //window.location.reload();
								window.location.href = window.location.origin;
                            }else if(data == 1 || data == 2){
                                //login
                                window.location.href = window.location+"dashboard/"+data+"/";
                            }else{
                                //error
                                $('#formError').empty();
                                $('#formError').append(data);
                                $('#formError').show();
                            }
                        }
                    });  
                }
            })
        }
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
               return false;
            }else{
               return true;
            }
        }
        
        function validate(){
            /*
             * This function validate form data
             * email - format
             * password - required
             * password == confirm password
             * 
             * return bool
             * alternative - jquery validate
             */
            var pass = $('#inputPassword').val();
                var email = $('#inputEmail').val();
                var key = $('#keyField').val();
                if(isEmail(email) == false){
                    $('#formError').empty();
                    $('#formError').append("Incorrect email format!");
                    $('#formError').show();
                    return false;
                }
                if(pass === ''){
                    $('#formError').empty();
                    $('#formError').append("Enter password!");
                    $('#formError').show();
                    return false;
                }
                if(key == 2){
                    var confPass = $('#inputConfirmPassword').val();  
                    if(pass !== confPass){
                        $('#formError').empty();
                        $('#formError').append("The passwords do not match!");
                        $('#formError').show();
                        return false;
                    }
                }
                $('#formError').hide(); 
                return true;
        }
        
    </script>
</footer>
</html>