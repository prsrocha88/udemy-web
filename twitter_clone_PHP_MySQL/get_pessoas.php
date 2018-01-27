<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('location: index.php?erro=1');
}

require_once('db.class.php');

$nome_pessoa = $_POST['nome_pessoa'];
$id_utilizador = $_SESSION['id'];

$objDb = new db();
$link = $objDb->conecta_bd();

$sql = " SELECT u.*, s.* FROM utilizadores AS u 
		LEFT JOIN utilizadores_seguidores AS s
			ON (s.id_utilizador = $id_utilizador AND u.id = s.seguir_id_utilizador)
	 	WHERE u.utilizador LIKE '%$nome_pessoa%' AND u.id != '$id_utilizador' ";

$resultado = mysqli_query($link, $sql);

if ($resultado) {

	while ($registo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		echo '<a href="#" class="list-group-item">';
			echo '<strong>'.$registo['utilizador'].'</strong> <small> - '.$registo['email'].' </small>';
			echo '<p class="list-group-item-text pull-right">';

				$esta_seguir_utilizador = isset($registo['id_utilizador_seguidor']) && !empty($registo['id_utilizador_seguidor']) ? 'S' : 'N';

				$btn_seguir_display = 'block';
				$btn_deixar_seguir_display = 'block';

				if ($esta_seguir_utilizador == 'N') {
					$btn_deixar_seguir_display = 'none';
				} else if ($esta_seguir_utilizador == 'S') {
					$btn_seguir_display = 'none';
				} 
				
				echo '<button type="button" id="btn_seguir_'.$registo['id'].'" style="display:'.$btn_seguir_display.'" class="btn btn-default btn_seguir" data-id_utilizador="'.$registo['id'].'">Seguir</button>';
				echo '<button type="button" id="btn_deixar_seguir_'.$registo['id'].'" style="display:'.$btn_deixar_seguir_display.'" class="btn btn-primary btn_deixar_seguir" data-id_utilizador="'.$registo['id'].'">Deixar de Seguir</button>';
			echo '</p>';
			echo '<div class="clearfix"></div>';
		echo '</a>';
	}

} else {
	echo 'Erro';
}

?>