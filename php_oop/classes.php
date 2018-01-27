<?php

class Pessoa {

	//Atributos
	var $nome;

	//Metodos
	function setNome($nome_definido) { //Metodo do tipo Setter
		$this->nome = $nome_definido;
	}

	function getNome() { //Metodo do tipo Getter
		return $this->nome;
	}
}

$pessoa = new Pessoa();

$pessoa->setNome('Paulo Rocha');
print_r($pessoa);
echo "<br>";
echo $pessoa->nome;
echo "<br>";
echo $pessoa->getNome();

?>