<?php
	
namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function timeline() {

		// Abrir a sessão
		session_start();

		// Verificar se os dados de seção existem, ou seja, verificar se o usuário fez o login
		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('timeline');

		} else {

			header('Location: /?login=erro');
		}
	}

	// Método para a manipulação do tweet
	public function tweet() {

		// Abrir a sessão
		session_start();

		// Verificar se os dados de seção existem, ou seja, verificar se o usuário fez o login
		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			// Instânciar o Model tweet
			$tweet = Container::getModel('Tweet');

			// Atribuindo valores aos parâmetros do Model tweet
			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);

			// Salvar o tweet no banco
			$tweet->salvar();


		} else {

			header('Location: /?login=erro');
		}

	}
}

?>
