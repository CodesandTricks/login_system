<?php 
session_start();


include 'google_config.php';

if(isset($_GET['code'])){
    $token=$google->fetchAccessTokenWithAuthCode($_GET["code"]);
   // echo "<pre>";
   // print_r($token);
    if(isset($token['access_token'])){
    $google->setAccessToken($token["access_token"]);

    $googleService=new Google_Service_Oauth2($google);
    $data=$googleService->userinfo->get();
   // print_r($data);
    $_SESSION['userimage']=$data['picture'];
   
    $_SESSION['username']=$data['givenName']." ".$data['familyName'];
    $_SESSION['login']=true;
}
}

 ?>
 <?php

    // 986017034574-3ilhfqdgn96rniqdenujp0hfhs2pc7dk.apps.googleusercontent.com
    // VtXcW9lNvw9qmkQQUrJJ6mvy
    if(isset($_SESSION['login'])){
        header('Location: dashboard.php');
    }
    if(isset($_POST['username'])&&isset($_POST['password'])){
        $con=mysqli_connect("localhost","root","","youtube");
        if($con){
            $query='select * from login where mailid="'.mysqli_real_escape_string($con,$_POST['username']).'" and password="'.mysqli_real_escape_string($con,md5($_POST['password'])).'";';
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows ( $result ) ==1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['login']=true;
                $_SESSION['username']=$row['firstname'];
                header('Location: dashboard.php');
            }else{
                $_SESSION['login']=false;
                echo "Invalid Login";
            }

        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login System</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
	body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 350px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
</head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="#" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required="">
                            </div>
                            <div class="form-group text-center">
                              <!--   <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                             <div class="form-group text-center">
                                <a href="<?=$google->createAuthUrl(); ?>"><img src="google.png"></a>
                            </div>
                            <!-- <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>