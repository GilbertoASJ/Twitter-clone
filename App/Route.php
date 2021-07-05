<?php
	
	namespace App;

	class Route {

		private $routes;

		public function __construct() {

			$this->initRoutes();
			$this->run($this->getUrl());
		}

		public function getRoutes() {
			return $this->routes;
		}

		public function setRoutes(array $routes) {
			$this->routes = $routes;
		}

		public function initRoutes() {

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

		// Função para executar determinada ação de acordo com a url atual do client
		public function run($url) {

			foreach ($this->getRoutes() as $key => $route) {
				
				if($url = $route['route']) {

					// Criando e instânciando a class indexController
					$class = "App\\Controllers\\".ucfirst($route['controller']);

					$controller = new $class;

					$action = $route['action'];
					$controller->$action();
				}
			}
		}

		public function getUrl() {
			// Utilizando uma superglobal do php para recuperar a url do client
			return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		}
	}

?>