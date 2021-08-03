<?php

namespace App\Models;
use MF\Model\Model;

class Usuario extends Model {

private $id;
private $nome;
private $email;
private $senha;

public function __get($attr) {

	return $this->$attr;
}

public function __set($attr, $value) {

	$this->$attr = $value;
}	

	// Salvar
	public function salvar() {

	// Query para inserir dados dentro da tabela
	$query = "insert into usuarios (nome, email, senha) values (:nome, :email, :senha)";
	$stmt = $this->db->prepare($query);

	$stmt->bindValue(':nome', $this->__get('nome'));
	$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); // md5() -> 32 caracteres

		$stmt->execute();

		// Retorno do próprio objeto para salvar as novas credenciais.
		return $this;
	}

	// Validar se um cadastro pode ser feito
	public function validarCadastro() {

		$valido = true;

		if(strlen($this->__get('nome')) < 3) {

			$valido = false;
		}

		if(strlen($this->__get('email')) < 3) {

			$valido = false;
		}

		if(strlen($this->__get('senha')) < 3) {

			$valido = false;
		}

		return $valido;
	}

	// Recuperar um usuário por email
	public function getUsuarioPorEmail() {

		$query = "select nome, email from usuarios where email = :email";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	// Método para realizar a autenticação do usuário
	public function autenticar() {

		$query = "select id, nome, email from usuarios where email = :email and senha = :senha";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		// Caso o usuário exista, será atribuido nome e id ao mesmo
		if(!empty($usuario['id']) && !empty($usuario['nome'])) {

			$this->__set('id', $usuario['id']);
			$this->__set('nome', $usuario['nome']);
		}

		return $this;

	}

	public function getAll() {

		// Query para buscar as ocorrências de nomes devido a respectiva pesquisa
		$query = "
			select 
				id, nome, email 
			from 
				usuarios 
			where 
				nome like :nome and id != :id_usuario
		";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
		$stmt->bindValue(':id_usuario', $this->__get('id'));

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function seguirUsuario($id_usuario_seguindo) {

		// Query para seguir um usuário
		$query = "insert into usuarios_seguidores(id_usuario, id_usuario_seguindo) values(:id_usuario, :id_usuario_seguindo)";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->bindValue(':id_usuario_seguindo', $id_usuario_seguindo);

		$stmt->execute();

		return true;
	}

	public function deixarDeSeguirUsuario($id_usuario_seguindo) {

		$query = "delete from usuarios_seguidores where id_usuario = :id_usuario and id_usuario_seguindo = :id_usuario_seguindo";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->bindValue(':id_usuario_seguindo', $id_usuario_seguindo);

		$stmt->execute();

		
	}
}
?>