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
			$query = "";
		}

		// Validar se um cadastro pode ser feito

		// Recuperar um usuário por email
	}
?>