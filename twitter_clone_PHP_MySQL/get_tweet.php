<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('location: index.php?erro=1');
}

require_once('db.class.php');

$id_utilizador = $_SESSION['id'];

$objDb = new db();
$link = $objDb->conecta_bd();

$sql = " SELECT DATE_FORMAT(t.data, '%d %b %Y %T') AS data_formatada, t.tweet, u.utilizador FROM tweet AS t 
		JOIN utilizadores AS u 
			ON t.id_utilizador = u.id
		WHERE id_utilizador = '$id_utilizador'";

$sql .= " OR id_utilizador IN (SELECT seguir_id_utilizador FROM utilizadores_seguidores WHERE id_utilizador = '$id_utilizador') ";

$sql .= " ORDER BY data DESC ";

$resultado = mysqli_query($link, $sql);

if ($resultado) {

	while ($registo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		echo '<a href="#" class="list-group-item">';
			echo '<h4 class="list-group-item-heading">'.$registo['utilizador'].' <small> - '.$registo['data_formatada'].'</small></h4>'; 
			echo '<p class="list-group-item-text">'.$registo['tweet'].'</p>';
		echo '</a>';
	}

} else {
	echo 'Erro';
}

?>