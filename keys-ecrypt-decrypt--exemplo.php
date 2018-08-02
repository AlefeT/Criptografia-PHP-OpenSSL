<?php

// Create the keypair
$res=openssl_pkey_new();

// Get private key
openssl_pkey_export($res, $privatekey);

// Get public key
$publickey=openssl_pkey_get_details($res);
$publickey=$publickey["key"];

// Echo privKey e pubKey
echo "Private Key:<BR>$privatekey<br><br>Public Key:<BR>$publickey<BR><BR>";


// Texto a ser encryptado
$cleartext = '1234 5678 9012 3456';
echo "Clear text:<br>$cleartext<BR><BR>";

// Encrypta o texto
openssl_public_encrypt($cleartext, $crypttext, $publickey);
echo "Crypt text:<br>$crypttext<BR><BR>";

// Decrypta o texto
openssl_private_decrypt($crypttext, $decrypted, $privatekey);
echo "Decrypted text:<BR>$decrypted<br><br>";


?>
