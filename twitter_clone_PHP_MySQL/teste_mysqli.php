<?php

require_once('db.class.php');

$sql = " SELECT * FROM utilizadores ";
$objDb = new db();
$link = $objDb->conecta_bd();

$resultado = mysqli_query($link, $sql);

if ($resultado) {
	//$dados_utilizador = mysqli_fetch_array($resultado, MYSQLI_NUM);
	//$dados_utilizador = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	//$dados_utilizador = mysqli_fetch_array($resultado, MYSQLI_BOTH);

	$dados_utilizador = array();	
	while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
		$dados_utilizador[] = $linha;
	}

	foreach ($dados_utilizador as $utilizador) {
		echo $utilizador['email'];
		echo "<br />";
	}
} else {
	echo 'Erro';
}



?>