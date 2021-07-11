<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Connection;
use App\Models\Produto;
use App\Models\Info;

class IndexController extends Action {

	// Para recuperar os respectivos arquivos de cada action, utilizaremos o require_once, porém o caminho indicado deve ser baseado a partir do arquivo index.php, visto que, ele que está fazendo o require do autoload que recupera todos os outros arquivos.

	public function index() {

		// $this->view->dados = array('Sofá', 'Cadeira', 'Cama');

		// 	Instância de conexão
		$connection = Connection::getBd();

		// Instanciar modelo
		$produto = new Produto($connection);
		$produtos = $produto->getProdutos();

		$this->view->dados = $produtos;

		$this->render('index', 'layout1');
	}

	public function sobreNos() {
		
		// 	Instância de conexão
		$connection = Connection::getBd();

		// Instanciar modelo
		$info = new Info($connection);
		$informacoes = $info->getInfo();

		$this->view->dados = $informacoes;

		$this->render('sobreNos', 'layout1');
	}

}


?>