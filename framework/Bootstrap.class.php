<?php
class Bootstrap extends Request{

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Obtem o primeiro endereco do router e verifica se o arquivo existe, caso nao exista chama o index.router
	 * TODO: (roberson) Possibilidade de ir para a pagina de erro 404
	 */
	public function boot(){
		$file = explode('/', ltrim($this->getUri(), '/'))[0];
		if(file_exists(str_replace('/', DS, ltrim(Config::get('route'), '/').'/'.$file.'.route.php'))){
			$route = new Router($file);
			require_once(str_replace('/', DS, ltrim(Config::get('route'), '/').'/'.$file.'.route.php'));
			$route->route();
		}else if(file_exists(str_replace('/', DS, ltrim(Config::get('route'), '/').'/index.route.php'))){
			$route = new Router();
			require_once(str_replace('/', DS, ltrim(Config::get('route'), '/').'/index.route.php'));
			$route->route();
		}else{

		}
	}

}
