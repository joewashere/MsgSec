<?php include("includes/options.php"); ?>
<?php include("includes/db.php"); ?>
<?php


if(isset($_POST['contact']) && isset($_POST['address'])){
	
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$salt = substr($contact,0,5).substr($address,0,5);
	
	$sql=$dbh->prepare("INSERT INTO `handshakes` (`id`, `contact1`, `contact2`, `salt`) VALUES (NULL, ?, ?, ?);");
    $sql->execute(array($contact, $address, $salt));
	
	echo "Success";
	
}else{

}

?>