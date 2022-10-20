<?php 

require ('../../controller/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Login - <?php echo system_name;?></title>
    <!--Icon-->
    <link rel = "icon" href = "<?php echo system_url; ?>others/images/icon.png" type = "image/x-icon">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <!--Style-->
    <link rel="stylesheet" href="<?php echo system_url; ?>css/style.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Functions -->
    <script src="<?php echo system_url; ?>controller/functions.js"></script>

</head>

<body>
    <div class="login py-5 ">
        <div class="container">
            <div class="row gx-8">
                <div class="col-lg-4">
                </div>
                <div class=" col-lg-4 text-center py-5 pt-5">                    
                <div class="card py-4">
                    <img src="<?php echo system_url; ?>others/images/cmy-logo.png" class="img-fluid offset-3" alt="">
                     <h5 class="color">Office Management System</h5>
                     <span class="fa fa-lock" aria-hidden="true"></span>
                     <!-- <form method="post" action="../../controller/config.php" onsubmit="return do_login();" id="login-form"> -->
                     <form method="post" onsubmit="return do_login();" id="login-form">                     
                        <div class="form-row py-4">                           
                            <div class="form-field offset-1 col-lg-10">
                                <span class="far fa-user"></span>
                               <input type="text" class="inp" id="username" name="username" placeholder="Employee Code" required> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field offset-1 col-lg-10">
                                <span class="fas fa-key"></span>
                               <input type="password" class="inp" id="password" name="password" placeholder="Password" required>
                            </div>                        
                        </div>                        
                        <div class="form-row py-4">
                            <div class=" offset-1 col-lg-10">
                               <button type="submit" class="btn btn1">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center login-footer">
                        <a href="#">Forget password?</a> or <a href="#">Sign up</a>
                    </div>
                </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div> 

        </div> 
    </div>       
</body>
</html>