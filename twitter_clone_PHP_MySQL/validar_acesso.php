<?php

session_start();

require_once('db.class.php');

$utilizador = $_POST['utilizador'];
$password = md5($_POST['password']);

$sql = " SELECT * FROM utilizadores WHERE utilizador = '$utilizador' AND password = '$password' ";
$objDb = new db();
$link = $objDb->conecta_bd();

$resultado = mysqli_query($link, $sql);

if ($resultado) {
	$dados_utilizador = mysqli_fetch_array($resultado);

	if (isset($dados_utilizador['utilizador'])) {

		$_SESSION['id'] = $dados_utilizador['id'];
		$_SESSION['utilizador'] = $dados_utilizador['utilizador'];
		$_SESSION['email'] = $dados_utilizador['email'];

		header('Location: home.php');

	} else {
		header('Location: index.php?erro=1');
	}
} else {
	echo 'Erro';
}



?>