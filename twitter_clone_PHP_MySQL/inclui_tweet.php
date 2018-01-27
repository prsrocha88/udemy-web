<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('location: index.php?erro=1');
}

require_once('db.class.php');

$texto_tweet = $_POST['texto_tweet'];
$id_utilizador = $_SESSION['id'];

if ($texto_tweet == '' || $id_utilizador == '') {
 	die();
}

$objDb = new db();
$link = $objDb->conecta_bd();

$sql = " INSERT INTO tweet (id_utilizador, tweet) VALUES ('$id_utilizador', '$texto_tweet') ";

mysqli_query($link, $sql);

?>