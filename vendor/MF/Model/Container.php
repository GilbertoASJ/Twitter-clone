<?php
	
	namespace MF\Model;
	use App\Connection;

	class Container {

		public static function getModel($model) {

			$class = "\\App\\Models\\".ucfirst($model);

			// 	Instância de conexão
			$connection = Connection::getBd();

			return new $class($connection);
		}
	}
?>
