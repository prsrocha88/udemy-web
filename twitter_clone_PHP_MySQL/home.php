<?php

session_start();

if (!isset($_SESSION['utilizador'])) {
	header('Location: index.php?erro=1');
}

require_once('db.class.php');

$objDb = new db();
$link = $objDb->conecta_bd();

$id_utilizador = $_SESSION['id'];

$sql = " SELECT COUNT(*) AS qt_tweets FROM tweet WHERE id_utilizador = '$id_utilizador' ";
$resultado_id = mysqli_query($link, $sql);
$qt_tweets = 0;
if ($resultado_id) {
	$registo = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	$qt_tweets = $registo['qt_tweets'];
} else {
	echo 'ERRO';
}

$sql = " SELECT COUNT(*) AS qt_seguidores FROM utilizadores_seguidores WHERE seguir_id_utilizador = '$id_utilizador' ";
$resultado_id = mysqli_query($link, $sql);
$qt_seguidores = 0;
if ($resultado_id) {
	$registo = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	$qt_seguidores = $registo['qt_seguidores'];
} else {
	echo 'ERRO';
}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<script type="text/javascript">

			$(document).ready( function() {

				$('#btn_tweet').click( function() {

					if ($('#texto_tweet').val().length > 0) {
						
						$.ajax({
							url: 'inclui_tweet.php',
							method: 'post',
							data: $('#form_tweet').serialize(),  // { texto_tweet: $('#texto_tweet').val() } também podia fazer assim 
							success: function(data) {
								$('#texto_tweet').val(''); // limpa o campo
								atualizaTweet();
							}
						})

					}

				});

				function atualizaTweet() {

					$.ajax({
						url: 'get_tweet.php',
						success: function(data) {
							$('#tweets').html(data);
						}
					});

				}

				atualizaTweet();

			});

		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['utilizador'] ?></h4>

	    				<hr />
	    				<div class="col-md-6">
	    					TWEETS <br /><?= $qt_tweets ?>
	    				</div>
	    				<div class="col-md-6">
	    					SEGUIDORES <br /><?= $qt_seguidores ?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
    					<form id="form_tweet" method="post"  class="input-group">
	    					<input id="texto_tweet" name="texto_tweet" type="text" class="form-control" placeholder="O que se passa?" maxlength="140"> 
	    					<span class="input-group-btn">
	    						<button id="btn_tweet" class="btn btn-default" type="button">Tweet</button>
	    					</span>
	    				</form>
	    			</div>
	    		</div>

	    		<div id="tweets" class="list-group">

	    		</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoa</a></h4>
					</div>
				</div>
			</div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>