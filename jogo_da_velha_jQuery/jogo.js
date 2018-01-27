var rodada = 1;
var matriz_jogo = Array(3);

matriz_jogo['a'] = Array(3);
matriz_jogo['b'] = Array(3);
matriz_jogo['c'] = Array(3);

matriz_jogo['a'][1] = 0;
matriz_jogo['a'][2] = 0;
matriz_jogo['a'][3] = 0;

matriz_jogo['b'][1] = 0;
matriz_jogo['b'][2] = 0;
matriz_jogo['b'][3] = 0;

matriz_jogo['c'][1] = 0;
matriz_jogo['c'][2] = 0;
matriz_jogo['c'][3] = 0;

$(document).ready( function() {

	$('#btn_iniciar_jogo').click( function() {

		if ( $('#nome_jogador_1').val() == '' ) {
			alert('Tem que preencher o nome do jogador 1');
			return false;
		}

		if ( $('#nome_jogador_2').val() == '' ) {
			alert('Tem que preencher o nome do jogador 2');
			return false;
		}

		$('#nome_jogador_1_saida').html($('#nome_jogador_1').val());
		$('#nome_jogador_2_saida').html($('#nome_jogador_2').val());


		$('#pagina_inicial').hide();
		$('#jogo').show();

	});


	$('.jogada').click( function() { 

		var id_campo = this.id;
		$('#'+id_campo).off();
		jogada(id_campo);

	});

	function jogada(id) {
		var icone = '';
		var ponto = 0;

		if ( (rodada % 2) == 1 ) { // jogador 1 joga nas jogadas impares e o jogador 2 nas pares
			icone = 'url("imagens/marcacao_1.png")'; 
			ponto = -1;
		} else {
			icone = 'url("imagens/marcacao_2.png")'; 
			ponto = 1;
		}

		rodada++;

		$('#'+id).css('background-image', icone);

		var linha_coluna = id.split('-'); 	//faz o mesmo que a função explode no PHP

		matriz_jogo[linha_coluna[0]][linha_coluna[1]] = ponto;

		verifica_combinacao();

	}

	function verifica_combinacao() {

		var pontos = 0;
		for (var i = 1; i <= 3; i++) {
			pontos = pontos + matriz_jogo['a'][i];
		}
		vencedor(pontos);
		
		var pontos = 0;
		for (var i = 1; i <= 3; i++) {
			pontos = pontos + matriz_jogo['b'][i];
		}
		vencedor(pontos);
		
		var pontos = 0;
		for (var i = 1; i <= 3; i++) {
			pontos = pontos + matriz_jogo['c'][i];
		}
		vencedor(pontos);
		
		for (var i = 1; i <= 3; i++) {
			var pontos = 0;
			pontos = pontos + matriz_jogo['a'][i];
			pontos = pontos + matriz_jogo['b'][i];
			pontos = pontos + matriz_jogo['c'][i];

			vencedor(pontos);
		}

		var pontos = 0;
		pontos = matriz_jogo['a'][1] + matriz_jogo['b'][2] + matriz_jogo['c'][3];
		vencedor(pontos);

		var pontos = 0;
		pontos = matriz_jogo['c'][1] + matriz_jogo['b'][2] + matriz_jogo['a'][3];
		vencedor(pontos);
	}

	function vencedor(pontos) {
		if (pontos == -3) {
			alert($('#nome_jogador_1').val() + ' é o vencedor' );
			$('.jogada').off();
		} else if (pontos == 3) {
			alert($('#nome_jogador_2').val() + ' é o vencedor' );
			$('.jogada').off();
		}
	}

});