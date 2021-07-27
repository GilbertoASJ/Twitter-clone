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
}

?>
