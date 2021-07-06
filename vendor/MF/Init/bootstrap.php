<?php
	
	namespace MF\Init;

	abstract class Bootstrap {

		private $routes;

		abstract protected function initRoutes();

		public function __construct() {

			$this->initRoutes();
			$this->run($this->getUrl());
		}

		// Recuperar as rotas
		public function getRoutes() {
			return $this->routes;
		}

		// Setar as rotas
		public function setRoutes(array $routes) {
			$this->routes = $routes;
		}

		// Função para executar determinada ação de acordo com a url atual do client
		protected function run($url) {

			foreach ($this->getRoutes() as $key => $route) {
				
				if($url == $route['route']) {

					// Criando e instânciando a class indexController
					$class = "App\\Controllers\\".ucfirst($route['controller']);

					$controller = new $class;

					$action = $route['action'];
					$controller->$action();
				}
			}
		}

		protected function getUrl() {
			// Utilizando uma superglobal do php para recuperar a url do client
			return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		}
	}

?>