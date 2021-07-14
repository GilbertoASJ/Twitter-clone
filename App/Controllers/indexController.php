<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Os Models
use App\Models\Produto;
use App\Models\Info;

class IndexController extends Action {

	// Para recuperar os respectivos arquivos de cada action, utilizaremos o require_once, porém o caminho indicado deve ser baseado a partir do arquivo index.php, visto que, ele que está fazendo o require do autoload que recupera todos os outros arquivos.

	public function index() {

		// Instância da classe
		$produto = Container::getModel('Produto');

		$produtos = $produto->getProdutos();

		$this->view->dados = $produtos;

		$this->render('index', 'layout1');
	}

	public function sobreNos() {
		
		// Instância da classe
		$info = Container::getModel('Info');
		
		$informacoes = $info->getInfo();
	
		$this->view->dados = $informacoes;
		
		$this->render('sobreNos', 'layout1');
	}

}


?>
