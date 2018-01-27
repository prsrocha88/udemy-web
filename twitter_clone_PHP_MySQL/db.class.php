<?php

class db {

	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $database = 'twitter_clone';

	public function conecta_bd() {

		$con = mysqli_connect($this->host, $this->user, $this->password, $this->database);

		mysqli_set_charset($con, 'utf8');

		if (mysqli_connect_errno()) {
			echo 'Erro na ligação à base de dados: '.mysqli_connect_error();
		}

		return $con;
	}

}

?>