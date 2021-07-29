<?php
	
namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	// Método para verificar se o usuário está autenticado
	public function validaSessao() {

		// Abrir a sessão
		session_start();

		// Verificar se os dados de seção existem, ou seja, verificar se o usuário fez o login
		if(!isset($_SESSION['id']) || $_SESSION['id'] != '' || !isset($_SESSION['nome']) || $_SESSION['nome'] != '') {

			header('Location: /?login=erro');

		}
	}

	public function timeline() {

		// Verificar se o usuário está autenticado
		$this->validaSessao();

		// Recuperação do Model tweet e dos tweet´s
		$tweet = Container::getModel('Tweet');
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweets = $tweet->getAll();

		$this->view->tweets = $tweets;         

		// Renderização da página timeline
		$this->render('timeline');
	}

	// Método para a manipulação do tweet
	public function tweet() {

		// Verificar se o usuário está autenticado
		$this->validaSessao();

		// Instânciar o Model tweet
		$tweet = Container::getModel('Tweet');

		// Atribuindo valores aos parâmetros do Model tweet
		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('id_usuario', $_SESSION['id']);

		// Salvar o tweet no banco
		$tweet->salvar();

		header('Location: /timeline');


	}
}

?>
