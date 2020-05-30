<?php

include "vendor/autoload.php";

$google=new Google_Client();
$google->setClientId("986017034574-3ilhfqdgn96rniqdenujp0hfhs2pc7dk.apps.googleusercontent.com");
$google->setClientSecret("VtXcW9lNvw9qmkQQUrJJ6mvy");
$google->setRedirectUri("http://localhost/youtube/login_sys/index.php");
$google->addScope("email");
$google->addScope("profile");

?>