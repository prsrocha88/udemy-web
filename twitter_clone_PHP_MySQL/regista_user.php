<?php

require_once('db.class.php');

$utilizador = $_POST['utilizador'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$objDb = new db();
$link = $objDb->conecta_bd();

$utilizador_existe = false;
$email_existe = false;

$sql = " SELECT * FROM utilizadores WHERE utilizador = '$utilizador' OR email = '$email' ";
if ($resultado = mysqli_query($link, $sql)) {

	$dados_utilizador = mysqli_fetch_array($resultado);

	if ($dados_utilizador['utilizador'] == $utilizador) {
		$utilizador_existe = true;
	} 

	if ($dados_utilizador['email'] == $email) {
		$email_existe = true;
	} 

} else {
	echo "Erro";
}


if ($utilizador_existe || $email_existe) {

	$retorno_get = '';

	if ($utilizador_existe) {
		$retorno_get .= 'erro_utilizador=1&';
	}

	if ($email_existe) {
		$retorno_get .= 'erro_email=1&';
	}

	header ('Location: inscrevase.php?'.$retorno_get);
	die();

}

$sql = " INSERT INTO utilizadores (utilizador, email, password) 
		VALUES ('$utilizador', '$email', '$password') ";

if (mysqli_query($link, $sql)) {
	echo 'Sucesso';
} else {
	echo 'Erro';
}
	

?>