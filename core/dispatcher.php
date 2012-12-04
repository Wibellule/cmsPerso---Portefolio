<?php 
/**
*Dispatcher
*Permet de charger le controller en fonction de la requete utilisateur
**/
class dispatcher
{
	var $request; //Objet request
	/**
	*Fonction principale du dispatcher
	*Charge le controller en fonction du routing
	**/
	function __construct()
	{
		$this->request = new request();
		router::parse($this->request->url,$this->request);
		$controller = $this->loadController();
		$action = $this->request->action;
		// debug($controller);
		if($this->request->prefix)
		{
			$action = $this->request->prefix.'_'.$action;
		}
		//get_class_methods($controller)  Retourne l'ensemble des methodes disponibles
		if(!in_array($action,array_diff(get_class_methods($controller),get_class_methods('Controller'))))
		{
			$this->errors('Le controleur '.$this->request->controller.' n\'a pas de m&eacute;thode '.$action);
		}
		call_user_func_array(array($controller,$action),$this->request->params);
		$controller->render($action);
	}
	/**
	*Permet de générer une page d'erreur en cas de problème au niveau du routing
	**/
	function errors($message)
	{
		$controller = new controller($this->request);
		$controller->e404($message);
	}
	/**
	*Permet de charger le controller en fonction de la requete utilisateur
	**/
	function loadController()
	{
		$name = ucfirst($this->request->controller).'Controller';
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		require $file;
		$controller = new $name($this->request);
		return $controller;
	}
}
?>