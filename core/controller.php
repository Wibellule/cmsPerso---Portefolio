<?php 
class controller
{
	public $request;//Objet request
	private $vars = array();//Variable à passer à la vue
	public $layout = 'default';//Layout à utiliser pour rendre la vue
	private $rendered = false;//Si le rendu a été fait ou pas
	
	/**
	*Constructeur
	*@param $request Objet request de notre application
	**/
	function __construct($request = null)
	{
		/**
		*Charge les helpers
		*/
		$this->session = new session();
		$this->form = new form($this);
		$this->slide = new slide($this);
		$this->Hfocus = new Hfocus($this);
		if($request)
		{
			$this->request = $request;//On stock la request dans l'instance
			require ROOT.DS.'config'.DS.'hook.php';
		}
	}
	
	/**
	*Permet de rendre une vue
	*@param $view fichier à rendre (chemin depuis view ou nom de la vue
	**/
	public function render($view) // permet de rendre une vue
	{
		if($this->rendered){return false;}
		extract($this->vars);
		if(strpos($view,'/')===0)
		{
			$view = ROOT.DS.'view'.$view.'.php';
		}
		else
		{
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		}
		ob_start();
		require($view);
		$content_for_layout = ob_get_clean();
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rendered = true;
	}
	
	/**
	*Permet de passer une ou plusieurs variables à la vue
	*@param $key nom de la variable OU Tableau de variables, on préfèrera le tableau
	*@param $value Valeur de la variable
	**/
	public function set($key,$value=null)
	{
		if(is_array($key))
		{
			$this->vars += $key;
		}
		else
		{
			$this->vars['key'] = $value;
		}
	}
	
	/**
	*Permet de charger un model
	*@param $name nom du model
	**/
	function loadModel($name)
	{
		if(!isset($this->$name))
		{
			$file = ROOT.DS.'model'.DS.$name.'.php';
			require_once($file);
			$this->$name = new $name();
			if(isset($this->form))
			{
				$this->$name->form = $this->form;
			}
			// debug($this->$name->form);
		}
		// else
		// {
			// echo 'Pas chargé';
		// }
	}
	
	/**
	*Permet de gérer les erreurs 404
	*@param $message message d'erreur
	**/
	function e404($message)
	{
		header("HTTP/1.0 404 Not Found");
		$this->set(array('message' => $message));
		$this->render('/errors/404');
	}
	
	/**
	*Permet d'appeller un controleur depuis une vue
	*@param $controller nom du controleur
	*@param $action nom de l'action
	**/
	function request($controller,$action)
	{
		$controller .= 'controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action();
	}	
	
	/**
	*Redirection
	**/
	function redirect($url,$code = null)
	{
		if($code == 301)
		{
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".router::url($url));
	}	
	
	
	
}
?>










