<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function inscreverse() {

		$this->render('inscreverse');
	}

	// Método para fazer o registro de usuário
	public function registrar() {

		// Receber os dados do formulário
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', $_POST['senha']);

		echo "<pre>";
			print_r($usuario);
		echo "</pre>";

		$usuario->salvar();

		// Sucesso


		// Erro


	}

}


?>
