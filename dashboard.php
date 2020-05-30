<?php 
session_start();

if(!$_SESSION['login']){
	header('Location: index.php');
}
echo "Hi ", $_SESSION['username'];
?>
<a href="logout.php">Logout</a>

<?php 

if(isset($_SESSION['userimage'])){
?>
<img src="<?=$_SESSION['userimage'] ?>">

<?php } ?>