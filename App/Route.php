<?php
	
	namespace App;

	// Recuperando a classe abstrata para Route herda-la
	use MF\Init\Bootstrap;

	class Route extends Bootstrap {

		// Iniciando as rotas
		protected function initRoutes() {

			$routes['home'] = array(
				'route' => '/', 
				'controller' => 'indexController',
				'action' => 'index',
			);

			$routes['sobreNos'] = array(
				'route' => '/sobreNos', 
				'controller' => 'indexController',
				'action' => 'sobreNos',
			);

			$this->setRoutes($routes);
		}
	}

?>