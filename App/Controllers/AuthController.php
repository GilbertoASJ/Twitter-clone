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
		$usuario->__set('senha', md5($_POST['senha']));

		$usuario->autenticar();

		if($usuario->__get('id') != '' && $usuario->__get('nome') != '') {

			// Iniciando as tratativas com a superGlobal Session
			session_start();

			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');

			header('Location: /timeline');

		} else {

			// Caso a autenticação tenha falhado, o usuário será redirecionado para a página inicial com um atributo no corpo da url, fazendo que a partir desse atributo, seja adicionado uma mensagem de erro no html da página
			header('Location: /?login=erro');
		}
	}

	// Método para realizar o logout do usuário quando já estiver autenticado
	public function sair() {

		// Sempre ao trabalhar com o recursod e sessão precisamos utilizar o session_start,
		session_start();

		// Encerramos a sessão
		session_destroy();

		// E redirecionamos o usuário para a home
		header('Location: /');
	}
}

?>
