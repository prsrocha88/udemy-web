<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('location: index.php?erro=1');
}

require_once('db.class.php');

$id_utilizador = $_SESSION['id'];
$seguir_id_utilizador = $_POST['seguir_id_utilizador'];

if ($seguir_id_utilizador == '' || $id_utilizador == '') {
 	die();
}

$objDb = new db();
$link = $objDb->conecta_bd();

$sql = " INSERT INTO utilizadores_seguidores (id_utilizador, seguir_id_utilizador) VALUES ($id_utilizador, $seguir_id_utilizador) ";

$resultado = mysqli_query($link, $sql);

if ($resultado) {
	echo 'SUCESSO';
} else {
	echo 'Erro '.mysqli_error($link);
}

?>