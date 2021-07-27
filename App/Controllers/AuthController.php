<?php
	
namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	// Método para realizar a autenticação do usuário
	public function autenticar() {

		// Recuperando o Model Usuário, que contém fluxo com o banco de dados
		$usuario = Container::getModel('Usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);

		$usuario->autenticar();

		if($usuario->__get('id') != '' && $usuario->__get('nome') != '') {

			// Iniciando as tratativas com a superGlobal Session
			session_start();

			$_SESSION['variable'];

		} else {

			header('Location: /?login=erro');
		}

	}
}

?>
