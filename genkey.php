<?php include("includes/options.php"); ?>
<?php include("includes/db.php"); ?>
<?php
session_start();
if(isset($_POST['passphrase'])){
$passphrase = $_POST['passphrase'];

$sql=$dbh->prepare("SELECT psalt FROM users WHERE id=?");
$sql->execute(array($_SESSION['user']));
 while($r=$sql->fetch()){
  $p_salt=$r['psalt'];
 } 
$timestamp = time();

$keyname = $p_salt.$timestamp;
$keyname = base64_encode($keyname);

$opconfig = array(
	'digest_alg' => 'sha512',
    'private_key_bits' => 2048,      // Size of Key.
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
);
$res = openssl_pkey_new($opconfig);
openssl_pkey_export($res, $privKey, $passphrase);
file_put_contents('keys/priv/'.$keyname.'-priv.key', $privKey);


$a_key = openssl_pkey_get_details($res);

file_put_contents('keys/pub/'.$keyname.'-pub.key', $a_key['key']);
openssl_free_key($res);

$sql=$dbh->prepare("INSERT INTO `userkeys` (`id`, `userid`, `keyname`) VALUES (NULL, ?, ?);");
$sql->execute(array($_SESSION['user'], $keyname));









}else{

}
?>