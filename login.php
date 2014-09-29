<?php include("includes/options.php"); ?>
<?php include("includes/db.php"); ?>
<?php
session_start();
if($_SESSION['user']!=''){header("Location:home.php");}
$email=$_POST['username'];
$password=$_POST['password'];
if(isset($_POST) && $email!='' && $password!=''){
 $sql=$dbh->prepare("SELECT id,password,psalt FROM users WHERE username=?");
 $sql->execute(array($email));
 while($r=$sql->fetch()){
  $p=$r['password'];
  $p_salt=$r['psalt'];
  $id=$r['id'];
 }
 $site_salt="subinsblogsalt";/*Common Salt used for password storing on site. You can't change it. If you want to change it, change it when you register a user.*/
 $salted_hash = hash('sha256',$password.$site_salt.$p_salt);
 if($p==$salted_hash){
  $_SESSION['user']=$id;
  header("Location:home.php");
 }else{
  echo "<h2>Username/Password is Incorrect.</h2>";
 }
}
?>