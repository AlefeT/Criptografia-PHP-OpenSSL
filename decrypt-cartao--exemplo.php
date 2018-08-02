<?php

$db = mysqli_connect("db.db.db.db", "db", "db", "db"); 


//////////////////////////////
//  DESCRIPTOGRAFIA EXEMPLO //
//////////////////////////////

//Escolhe id
$id = $_GET['id'];

//Busca o dado encryptado do ID informado no parametro, no BD 
$crypted = mysqli_query($db, "SELECT coluna FROM db.tabela WHERE idcripto = $id");
$rowp = mysqli_fetch_row($crypted);
$crypted = $rowp[0];
echo "crypted:<br>$crypted<br><br>";

//Descriptografa
$descriptografado = decrypt($crypted); 
echo "descriptografado:<br>$descriptografado<br><br>";








/////////////////////////////
//  FUNÇÃO DESCRIPTOGRAFAR //
/////////////////////////////

function decrypt($crypted)
{    
 
//Substitui caracteres problematicos antes de utilizar   
$crypted = str_replace("#barrainvertida#", "\\", $crypted);
$crypted = str_replace("#menorque#", "<", $crypted); 
$crypted = str_replace("#aspassimples#", "'", $crypted);
    
//Busca pv, na pasta    
$privatekey = file_get_contents('privatekey--exemplo.txt');
    
//Decrypta o dado
openssl_private_decrypt($crypted, $decrypted, $privatekey);
   
//Desfaz o tratamento feito no encriptar
$decrypted = str_replace("a", "", $decrypted);
$decrypted = str_replace(" ", "", $decrypted);
    
//Retorna o dado decryptado
return $decrypted;
    
}


?>