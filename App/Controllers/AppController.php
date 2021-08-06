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
		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {

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

	// Método para listar usuários para serem seguidos
	public function quemSeguir() {

		// Verificar se o usuário está autenticado
		$this->validaSessao();

		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

		$usuarios = array();

		if($pesquisarPor != '') {

			// Instância do Model Usuario e atribuição ao 'nome', pelo termo de pesquisa($pesquisarPor)
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id', $_SESSION['id']);

			// Recuperando todas as ocorrências da pesquisa
			$usuarios = $usuario->getAll();

		}

		$this->view->usuarios = $usuarios;

		// Ao acessar a página é feita a renderização da view quemSeguir
		$this->render('quemSeguir');

	}

	// Método que executará a ação de seguir ou deixar de seguir
	public function acao() {

		// Verificar se o usuário está autenticado
		$this->validaSessao();

		// Ação
		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

		// Id_usuario_Seguindo
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		// Tratativas para seguir ou deixar de seguir um usuário
		if($acao == 'seguir') {

			$usuario->seguirUsuario($id_usuario_seguindo);

		} else if($acao = 'deixar_de_seguir') {

			$usuario->deixarDeSeguirUsuario($id_usuario_seguindo);
		}

		header('Location: /quemSeguir');

	}

	// Método para deletar um tweet
	public function removerTweet() {

		// Verificar se o usuário está autenticado
		$this->validaSessao();

		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$tweet = Container::getModel('Tweet');

		$tweet->__set('id', $id);

		$tweet->remover();

		header('Location: /timeline');

	}
}

?>
