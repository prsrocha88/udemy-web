<?php

Class Pessoa {

	private $nome;

	public function correr() {
		echo $this->nome . " está a correr<br>";
	}

	function __construct($parametro_nome) {

		echo "Construtor iniciado <br>";
		$this->nome = $parametro_nome;
	}

	function __destruct() {
		echo "Objeto removido<br>";
	}

}

$pessoa = new Pessoa('Paulo Rocha');
$pessoa->correr();

?>