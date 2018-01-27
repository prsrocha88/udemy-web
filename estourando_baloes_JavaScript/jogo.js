var timerId = null;

function iniciaJogo() {

	var url = window.location.search;
	
	var nivel_jogo = url.replace("?nivel=", "");

	//console.log(nivel_jogo);

	var tempo_segundos = 0;

	if (nivel_jogo == 1) {
		tempo_segundos = 120;
	} else if (nivel_jogo == 2) {
		tempo_segundos = 60;
	} else if (nivel_jogo == 3) {
		tempo_segundos = 30;
	}

	document.getElementById('cronometro').innerHTML = tempo_segundos;

	qt_baloes = 20;

	cria_baloes(qt_baloes);

	document.getElementById('baloes_inteiros').innerHTML = qt_baloes;
	document.getElementById('baloes_rebentados').innerHTML = 0;

	contagem_tempo(tempo_segundos);

}

function contagem_tempo(segundos) {

	segundos = segundos - 1;

	if (segundos == -1) {
		clearTimeout(timerId); // para de descontar segundos
		game_over();
		return false;
	}

	document.getElementById('cronometro').innerHTML = segundos;

	timerId = setTimeout("contagem_tempo("+segundos+")", 1000);

}

function game_over() {
	alert ("PERDEU!!!");
	/* como eu fiz, usando o qt_baloes como uma variavel global
	for ( i = 1; i <= qt_baloes; i++) {
		document.getElementById('b'+i).setAttribute("onclick", "");
	}
	*/
	var i = 1; 
    
     while(document.getElementById('b'+i)) {
        document.getElementById('b'+i).onclick = '';
        i++; 
    }
}

function cria_baloes(qt_baloes) {

	for (var i = 1; i <= qt_baloes; i++) {

		var balao = document.createElement("img");
		balao.src = 'imagens/balao_azul_pequeno.png';
		balao.style.margin = '10px';
		balao.id = 'b'+i;
		balao.onclick = function(){ estourar(this); };

		document.getElementById('cenario').appendChild(balao);
	}

}

function estourar(e) {

	var id_balao = e.id;

	document.getElementById(id_balao).setAttribute("onclick", ""); 	// resetar botao depois do balao 
																	// estar rebentado, nao permite 
																	// rebentar novamente
	document.getElementById(id_balao).src = 'imagens/balao_azul_pequeno_estourado.png';

	pontuacao(-1);
}

function pontuacao(acao) {

	var baloes_inteiros = document.getElementById('baloes_inteiros').innerHTML;
	var baloes_rebentados = document.getElementById('baloes_rebentados').innerHTML;

	baloes_inteiros = parseInt(baloes_inteiros);
	baloes_rebentados = parseInt(baloes_rebentados);

	baloes_inteiros = baloes_inteiros + acao;
	baloes_rebentados = baloes_rebentados - acao;

	document.getElementById('baloes_inteiros').innerHTML = baloes_inteiros;
	document.getElementById('baloes_rebentados').innerHTML = baloes_rebentados;

	situacao_jogo(baloes_inteiros, baloes_rebentados);

}

function situacao_jogo(baloes_inteiros, baloes_rebentados) {
	if (baloes_inteiros == 0) {
		alert('Parabéns, ganhou o jogo!!!');
		para_jogo();
	}
}

function para_jogo() {
	clearTimeout(timerId);
}