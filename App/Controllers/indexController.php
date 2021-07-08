<?php

namespace App\Controllers;

use MF\Controller\Action;

class IndexController extends Action {

	// Para recuperar os respectivos arquivos de cada action, utilizaremos o require_once, porém o caminho indicado deve ser baseado a partir do arquivo index.php, visto que, ele que está fazendo o require do autoload que recupera todos os outros arquivos.

	public function index() {

		$this->view->dados = array('Sofá', 'Cadeira', 'Cama');
		$this->render('index', 'layout1');
	}

	public function sobreNos() {
		
		$this->view->dados = array('Notebook', 'Smartphone');
		$this->render('sobreNos', 'layout1');
	}

}


?>