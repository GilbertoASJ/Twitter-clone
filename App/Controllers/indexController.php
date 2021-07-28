<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		// Caso o login não tenha sido efetuado com sucesso:
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$this->render('index');
	}

	public function inscreverse() {

		$this->view->dadosUsuario = array(
			'nome' => '',
			'email' => '',
			'senha' => ''
		);

		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

	// Método para fazer o registro de usuário
	public function registrar() {

		// Receber os dados do formulário
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		// echo "<pre>";
		// 	print_r($usuario);
		// echo "</pre>";

		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) <= 0) {

			// Sucesso
			$usuario->salvar();
			$this->render('cadastro');

		} else {

			// Erro
			$this->view->dadosUsuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);

			$this->view->erroCadastro = true;

			$this->render('inscreverse');
		}
	}

}


?>
