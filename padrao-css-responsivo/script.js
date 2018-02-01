(function ( w, d) {
	'use strict';

	var $botao = d.querySelector('[data-js="acao"]');

	$botao.addEventListener('click', function () {
		alert('Olá Mundo!');
	}, false);

	var $botao2 = d.querySelector('[data-js="mudar"]');

	

})( window, document);