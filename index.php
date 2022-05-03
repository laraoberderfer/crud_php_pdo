<?php //login 
require 'conexao.php';

if(isset($_SESSION['login_id'])){
  header('Location: acesso.php');
  exit;
}
//conexao com a api do google
require 'google-api/vendor/autoload.php';
$client = new Google_Client();
//pegar do google https://console.cloud.google.com/apis/
$client->setClientId('xxx');
//pegar do google https://console.cloud.google.com/apis/
$client->setClientSecret('xx');
$client->setRedirectUri('http://localhost/oficina/');
$client->addScope("email");
$client->addScope("profile");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login with Google Account Using PHP</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="main-content">

        <?php

            if(isset($_GET['code'])) {

                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                if(!isset($token["error"])){

                    $client->setAccessToken($token['access_token']);

                    // getting profile information
                    $google_oauth = new Google_Service_Oauth2($client);
                    $user_info = $google_oauth->userinfo->get();
                
                    // escape string and storing data into database
                    $id = mysqli_real_escape_string($db_connection, $user_info->id);
                    $full_name = mysqli_real_escape_string($db_connection, trim($user_info->name));
                    $email = mysqli_real_escape_string($db_connection, $user_info->email);
                    $profile_pic = mysqli_real_escape_string($db_connection, $user_info->picture);

                    // checking user already exists or not
                    $get_user = mysqli_query($db_connection, "SELECT `google_id` FROM `users` WHERE `google_id` = '$id'");
                    if(mysqli_num_rows($get_user) > 0){

                        $_SESSION['login_id'] = $id; 
                        header('Location: dashboard.php');
                        exit;

                    } else{

                        // if user not exists in db then insert the user
                        $insert = mysqli_query($db_connection, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

                        if($insert){
                            $_SESSION['login_id'] = $id; 
                            header('Location: dashboard.php');
                            exit;
                        } else {
                            echo "Sign in failed!(Something went wrong!!!).";
                        }

                    }

                }
                else{
                    header('Location: login.php');
                    exit;
                }
                
            } else {

            ?>

            <div class="login_img">
                <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>"><img  alt="Sign in with Google" data-src="assets/images/google.png" class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="><noscript><img src="assets/images/google.png" alt="Sign in with Google"></noscript></a>
            </div>

            <?php 

            }

        ?>  

    </div>
</body>
</html>
