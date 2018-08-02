<?php

$db = mysqli_connect("db.db.db.db", "db", "db", "db"); 


/////////////////////////////
//  CRIPTOGRAFIA EXEMPLO   //
/////////////////////////////

//Texto a ser criptografado
$cleartext = $_GET['text']; //para testes: $cleartext = '1234 5678 9012 3456';
echo "Clear text:<br>$cleartext<br><br>";


//Remove espaços do texto digitado
$cartao = str_replace(" ", "", $cleartext);

//Faz o texto digitado poder ser dividido em blocos de 4 caracteres sem sobrar caracteres soltos
while (((strlen($cartao)) % 4) != 0)
{
    $cartao = "a" . $cartao;
}

//Divide o texto digitado em blocos de 4 caracteres
$cartao = wordwrap($cartao, 4 , ' ', true);


//Criptografa
$criptografado = encrypt($cartao);
echo "criptografado:<br>$criptografado<br><br>";


//Salva o dado criptografado, no BD 
mysqli_query($db, "INSERT INTO db.tabela(coluna) VALUES('$criptografado');");





//////////////////////////
//  FUNÇÃO CRIPTOGRAFAR //
//////////////////////////

function encrypt($cleartext)
{
    
//Busca pc, na pasta       
$publickey = file_get_contents('publickey--exemplo.txt');
    
//Encrypta o dado informado no parametro
openssl_public_encrypt($cleartext, $crypted, $publickey);
    
//Substitui caracteres problematicos antes de retornar  
$crypted = str_replace("\\", "#barrainvertida#", $crypted);    
$crypted = str_replace("<", "#menorque#", $crypted); 
$crypted = str_replace("'", "#aspassimples#", $crypted);

//Retorna o dado decryptado
return $crypted;
  
}



?>