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

				$('#btn_procurar_pessoa').click( function() {

					if ($('#nome_pessoa').val().length > 0) {
						
						$.ajax({
							url: 'get_pessoas.php',
							method: 'post',
							data: $('#form_procurar_pessoa').serialize(),  // { texto_tweet: $('#texto_tweet').val() } também podia fazer assim 
							success: function(data) {
								$('#pessoas').html(data);

								$('.btn_seguir').click( function() {
									var id_utilizador = $(this).data('id_utilizador');

									$('#btn_seguir_'+id_utilizador).hide();
									$('#btn_deixar_seguir_'+id_utilizador).show();
									
									$.ajax({
										url: 'seguir.php',
										method: 'post',
										data: { seguir_id_utilizador: id_utilizador },
										success: function(data) {
											alert(data);
										}
									});
								});

								$('.btn_deixar_seguir').click( function() {
									var id_utilizador = $(this).data('id_utilizador');

									$('#btn_seguir_'+id_utilizador).show();
									$('#btn_deixar_seguir_'+id_utilizador).hide();
									
									$.ajax({
										url: 'deixar_seguir.php',
										method: 'post',
										data: { deixar_seguir_id_utilizador: id_utilizador },
										success: function(data) {
											alert(data);
										}
									});
								});
							}	
						})

					}

				});

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
	            <li><a href="home.php">Home</a></li>
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
    					<form id="form_procurar_pessoa" method="post"  class="input-group">
	    					<input id="nome_pessoa" name="nome_pessoa" type="text" class="form-control" placeholder="Quem quer procurar?" maxlength="140"> 
	    					<span class="input-group-btn">
	    						<button id="btn_procurar_pessoa" class="btn btn-default" type="button">Procurar</button>
	    					</span>
	    				</form>
	    			</div>
	    		</div>

	    		<div id="pessoas" class="list-group">

	    		</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>