<?php

//Classe mãe ou superclasse
class Felino {

	var $mamifero = 'sim';

	function correr() {
		echo 'Correr como felino';
	}
 
}

//Classe filha ou subclasse
class Chita extends Felino { 

	//Polimorfismo
	function correr() {
		echo 'Correr como Chita a 100k/h';
	}

}

$chita = new Chita();

echo $chita->mamifero; 	//Herança -> a subclasse Felina herda 
echo "<br>"; 			//os atributos e metodos da sua classe mãe
$chita->correr();

?>