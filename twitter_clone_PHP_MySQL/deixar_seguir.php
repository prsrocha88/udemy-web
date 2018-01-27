<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('location: index.php?erro=1');
}

require_once('db.class.php');

$id_utilizador = $_SESSION['id'];
$deixar_seguir_id_utilizador = $_POST['deixar_seguir_id_utilizador'];

if ($deixar_seguir_id_utilizador == '' || $id_utilizador == '') {
 	die();
}

$objDb = new db();
$link = $objDb->conecta_bd();

$sql = " DELETE FROM utilizadores_seguidores WHERE id_utilizador = '$id_utilizador' AND seguir_id_utilizador = '$deixar_seguir_id_utilizador' ";

$resultado = mysqli_query($link, $sql);

if ($resultado) {
	echo 'SUCESSO';
} else {
	echo 'Erro '.mysqli_error($link);
}

?>