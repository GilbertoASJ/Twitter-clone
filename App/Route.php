<?php
	
	namespace App;

	class Route {

		public function initRoutes() {

			$routes = array('home', 'sobreNos');

			$routes[0] = array(
				'route' => '/', 
				'controller' => 'indexController',
				'action' => 'index',
			);

			$routes[1] = array(
				'route' => '/sobreNos', 
				'controller' => 'indexController',
				'action' => 'sobreNos',
			);
		}

		public function getUrl() {
			// Utilizando uma superglobal do php para recuperar a url do client
			return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		}
	}

?>