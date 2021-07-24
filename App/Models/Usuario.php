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
	}
?>