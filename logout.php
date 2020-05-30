<?php 
session_start();

include 'google_config.php';
$google->revokeToken();

session_destroy();
header('Location: index.php');



?>
