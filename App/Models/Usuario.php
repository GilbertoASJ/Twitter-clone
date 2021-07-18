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

			if(strlen($this->__get('nome'))) {

				
			}

			return $valido;
		}

		// Recuperar um usuário por email
	}
?>