<?php
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
    
// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);
echo $privKey;
// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

$data = 'plaintext data goes here';

// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, $privKey);

echo $decrypted;
?>


$plaintext = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eleifend vestibulum nunc sit amet mattis. Nulla at volutpat nulla. Pellentesque sodales vel ligula quis consequat. Suspendisse dapibus dolor nec viverra venenatis. Pellentesque blandit vehicula eleifend. Duis eget fermentum velit. Vivamus varius ut dui vel malesuada. Ut adipiscing est non magna posuere ullamcorper. Proin pretium nibh nec elementum tincidunt. Vestibulum leo urna, porttitor et aliquet id, ornare at nibh. Maecenas placerat justo nunc, varius condimentum diam fringilla sed. Donec auctor tellus vitae justo venenatis, sit amet vulputate felis accumsan. Aenean aliquet bibendum magna, ac adipiscing orci venenatis vitae.';
 
echo 'Plain text: ' . $plaintext;
// Compress the data to be sent
$plaintext = gzcompress($plaintext);
 
// Get the public Key of the recipient
$publicKey = openssl_pkey_get_public(file_get_contents('keys/pub/'.$keyname.'-pub.key'));

$a_key = openssl_pkey_get_details($publicKey);
 
// Encrypt the data in small chunks and then combine and send it.
$chunkSize = ceil($a_key['bits'] / 8) - 11;
$output = '';
 
while ($plaintext)
{
    $chunk = substr($plaintext, 0, $chunkSize);
    $plaintext = substr($plaintext, $chunkSize);
    $encrypted = '';
    if (!openssl_public_encrypt($chunk, $encrypted, $publicKey))
    {
        die('Failed to encrypt data');
    }
    $output .= $encrypted;
}
openssl_free_key($publicKey);
 
// This is the final encrypted data to be sent to the recipient
$encrypted = $output;

echo $encrypted;





// Get the private Key
if (!$privateKey = openssl_pkey_get_private(file_get_contents('keys/priv/'.$keyname.'-priv.key',$passphrase)))
{
    die('Private Key failed');
}
$a_key = openssl_pkey_get_details($privateKey);
 
// Decrypt the data in the small chunks
$chunkSize = ceil($a_key['bits'] / 8);
$output = '';
 
while ($encrypted)
{
    $chunk = substr($encrypted, 0, $chunkSize);
    $encrypted = substr($encrypted, $chunkSize);
    $decrypted = '';
    if (!openssl_private_decrypt($chunk, $decrypted, $privateKey))
    {
        die('Failed to decrypt data');
    }
    $output .= $decrypted;
}
openssl_free_key($privateKey);
 
// Uncompress the unencrypted data.
$output = gzuncompress($output);
 
echo '<br /><br /> Unencrypted Data: ' . $output;