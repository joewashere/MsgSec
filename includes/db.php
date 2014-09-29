<?php
$username = "root";
$password = "";


//connection to the database
$dbh = new PDO('mysql:host=localhost;dbname=msgsec', $username, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($debug = 'true'){$debuginfo .= "Connected to MySQL</br>";}


?>