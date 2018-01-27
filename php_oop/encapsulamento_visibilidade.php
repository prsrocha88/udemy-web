<?php

class Veiculo {

	/* modificadores
	public
	private
	protected
	*/

	public $cor;
	private $matricula;
	protected $tipo = 'Desportivo'; 

	public function setMatricula($parametro) {
		$this->matricula = $parametro;
	}

	public function getMatricula() {
		return $this->matricula;
	}

}

class Carro extends Veiculo {
	public function exibirTipo() {
		echo $this->tipo;
	}
}

$veiculo = new Veiculo();


$veiculo->cor = 'azul';
echo $veiculo->cor; //Um atributo public tanto posso alterar dentro da classe como fora

echo "<br>";

//$veiculo->matricula = 'AA-BB-33';
//Um atributo do tipo private só pode ser alterado dentro da propria classe, 
//logo isto dá erro. a forma correta seria utilizar o metodo para 
//alterar a matricula dentro da classe. Desta forma, era possivel conter dentro
//da classe uma validação para a matricula

$veiculo->setMatricula('AA-BB-33');
echo $veiculo->getMatricula();

echo "<br>";

//Os atributos do tipo protected têm um funcionamento identico aos do tipo private
//a diferença é que podem ser alterados em respetivas subclasses
$carro = new Carro();

$carro->exibirTipo();
 
?>