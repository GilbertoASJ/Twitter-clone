<?php
	
	namespace App\Controllers;

	class IndexController {

		private $view;

		public function __construct() {
			$this->view = new \stdClass();
		}

		// Para recuperar os respectivos arquivos de cada action, utilizaremos o require_once, porém o caminho indicado deve ser baseado a partir do arquivo index.php, visto que, ele que está fazendo o require do autoload que recupera todos os outros arquivos.

		public function index() {

			$this->view->dadosTeste = array('Fulano', 'Ciclano', 'Beltrano');
			$this->render('index.phtml');
		}

		public function sobreNos() {

			$this->view->dadosTeste = array('Gilberto', 'Otanko', 'Scy');
			$this->render('sobreNos.phtml');
		}

		public function render($view) {

			$classAtual = get_class($this);

			$classAtual = str_replace('App\\Controllers\\', '', $classAtual);
			$classAtual =  strtolower(str_replace('Controller', '', $classAtual));

			require_once("../App/Views/$classAtual/$view");
		}
	}

?>