<?php

	namespace App;

	// Classe que irá fazer a conexão com o banco de dados
	class Connection {

		public static function getBd() {

			try {

				$connection = new PDO(
					"mysql:host=localhost;dbname=mvc;charset=utf-8",
					"root",
					""
				);

				return $connection;

			} catch (PDOException $e) {

				echo $e;
			}
		}
	}
?>