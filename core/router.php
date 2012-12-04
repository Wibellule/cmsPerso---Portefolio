<?php
/**
* Classe de routing � utiliser pour un MVC 
* Permet de rediriger des URLs vers des URL au format MVC controller/action/param/param/param....
* Router::prefix('cockpit','admin');
* Router::connect('','posts/index');
* Router::connect('cockpit','cockpit/posts/index');
* Router::connect('blog/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
* Router::connect('blog/*','posts/*');
*
**/ 

class Router
{
	static $routes = array(); 
	static $prefixes = array(); 

	/**
	* Ajoute un prefix au Routing
	**/
	static function prefix($url,$prefix){
		self::$prefixes[$url] = $prefix; 
	}


	/**
	* Permet de parser une url
	* @param $url Url � parser
	* @return tableau contenant les param�tres
	**/
	static function parse($url,$request){
		$url = trim($url,'/'); 
		if(empty($url)){
			$url = Router::$routes[0]['url']; 
		}else{
			$match = false; 
			foreach(Router::$routes as $v){
				if(!$match && preg_match($v['redirreg'],$url,$match)){
					$url = $v['origin'];
					foreach($match as $k=>$v){
						$url = str_replace(':'.$k.':',$v,$url); 
					} 
					$match = true; 
				}
			}
		}

		$params = explode('/',$url);
		if(in_array($params[0],array_keys(self::$prefixes))){
			$request->prefix = self::$prefixes[$params[0]];
			array_shift($params); 
		}
		$request->controller = $params[0];
		$request->action = isset($params[1]) ? $params[1] : 'index';
		foreach(self::$prefixes as $k=>$v)
		{
			if(strpos($request->action, $v.'_') === 0)
			{
				$request->prefix = $v;
				$request->action = str_replace($v.'_','',$request->action);
			}
		}
		$request->params = array_slice($params,2);
		return true; 
	}


	/**
	* Permet de connecter une url � une action particuli�re
	**/
	static function connect($redir,$url){
		$r = array();
		$r['params'] = array();
		$r['url'] = $url;  

		$r['originreg'] = preg_replace('/([a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})',$url);
		$r['originreg'] = str_replace('/*','(?P<args>/?.*)',$r['originreg']);
		$r['originreg'] = '/^'.str_replace('/','\/',$r['originreg']).'$/'; 
		// MODIF
		$r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/',':${1}:',$url);
		$r['origin'] = str_replace('/*',':args:',$r['origin']); 

		$params = explode('/',$url);
		foreach($params as $k=>$v){
			if(strpos($v,':')){
				$p = explode(':',$v);
				$r['params'][$p[0]] = $p[1]; 
			}
		} 

		$r['redirreg'] = $redir;
		$r['redirreg'] = str_replace('/*','(?P<args>/?.*)',$r['redirreg']);
		foreach($r['params'] as $k=>$v){
			$r['redirreg'] = str_replace(":$k","(?P<$k>$v)",$r['redirreg']);
		}
		$r['redirreg'] = '/^'.str_replace('/','\/',$r['redirreg']).'$/';

		$r['redir'] = preg_replace('/:([a-z0-9]+)/',':${1}:',$redir);
		$r['redir'] = str_replace('/*',':args:',$r['redir']); 

		self::$routes[] = $r; 
	}

	/**
	* Permet de g�n�rer une url � partir d'une url originale
	* controller/action(/:param/:param/:param...)
	**/
	static function url($url = ''){
		trim($url,'/'); 
		foreach(self::$routes as $v){
			if(preg_match($v['originreg'],$url,$match)){
				$url = $v['redir']; 
				foreach($match as $k=>$w){
					$url = str_replace(":$k:",$w,$url); 
				}
			}
		}
		foreach(self::$prefixes as $k=>$v){
			if(strpos($url,$v) === 0){
				$url = str_replace($v,$k,$url); 
			}
		}
		return BASE_URL.str_replace('//','/','/'.$url); 
	}

	static function webroot($url)//Pour avoir les chemins jusqu'� la racine
	{
		trim($url,'/');
		return BASE_URL.'/'.$url; 
	}
	
	// static function redirUrl($url){
		// trim($url,'/');
		// return 
	// }

}

/** ANCIENNE CLASS ROUTER **/
// class router
// {
	// static $routes = array();
	// static $prefixes = array();
	
	// static function prefix($url,$prefix)
	// {
		// self::$prefixes[$url] = $prefix;
	// }	
	
	/***
	*Permet de parser une url
	*@param $url -> url � parser
	*@return tableau contenant les parametres
	***/
	// static function parse($url,$request)
	// {
		// $url = trim($url,'/');//Permet d'enlever les espaces au d�but et en fin de cha�ne
		// if(empty($url))
		// {
			// $url = router::$routes[0]['url'];
		// }
		// else
		// {
			// $match = false;
			// foreach(router::$routes as $v)
			// {
				// if(preg_match($v['catcher'],$url,$match))
				// {
					// $request->controller = $v['controller'];
					// $request->action = isset($match['action']) ? $match['action'] : $v['action'];
					// $request->params = array();
					// foreach($v['params'] as $k=>$v)
					// {
						// $request->params[$k] = $match[$k];
					// }
					// if(!empty($match['args']))
					// {
						// $request->params += explode('/',trim($match['args'],'/'));
					// }
					// return $request;
				// }
			// }
		// }
		// $params = explode('/',$url);
		// if(in_array($params[0],array_keys(self::$prefixes)))//Test si le mot est dans ce tableau la pour l'admin (cockpit)
		// {
			// $request->prefix = self::$prefixes[$params[0]];
			// array_shift($params);
		// }
		// $request->controller = $params[0];
		// $request->action = isset($params[1]) ? $params[1] : 'index';
		// $request->params = array_slice($params,2);//Pour sauter des �lements
		// return true;
	// }
	
	/**
	*Pour connecter deux url
	**/
	// static function connect($redir,$url)
	// {
		// $r = array();
		// $r['params'] = array();
		// $r['url'] = $url;
		// $r['redir'] = $redir;
		// $r['origin'] = str_replace(':action','(?P<action>([a-z0-9]+))',$url);
		// $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})',$r['origin']);
		// $r['origin'] = '/^'.str_replace('/','\/',$r['origin']).'(?P<args>\/?.*)$/';
		// debug($url);
		// $params = explode('/',$url);
		// foreach($params as $k=>$v)
		// {
			// if(strpos($v,':'))
			// {
				// $p = explode(':',$v);
				// $r['params'][$p[0]] = $p[1];
			// }
			// else
			// {
				// if($k==0)//On est dans le controleur
				// {
					// $r['controller'] = $v;
				// }
				// elseif($k==1)//On est sur l'action
				// {
					// $r['action'] = $v;
				// }
			// }
		// }
		// $r['catcher'] = $redir;
		// $r['catcher'] = str_replace(':action','(?P<action>([a-z0-9]+))',$r['catcher']);
		// foreach($r['params'] as $k=>$v)
		// {
			// $r['catcher'] = str_replace(":$k","(?P<$k>$v)",$r['catcher']);
		// }
		// $r['catcher'] = '/^'.str_replace('/','\/',$r['catcher']).'(?P<args>\/?.*)$/';
		// self::$routes[] = $r;
	// }
	
	// static function url($url)
	// {
		// foreach(self::$routes as $v)
		// {
			// if(preg_match($v['origin'],$url,$match))
			// {
				// foreach($match as $k=>$w)
				// {
					// if(!is_numeric($k))
					// {
						// $v['redir'] = str_replace(":$k",$w,$v['redir']);
					// }
				// }
				// return BASE_URL.str_replace('//','/','/'.$v['redir']).$match['args'];
			// }
		// }
		// foreach(self::$prefixes as $k=>$v)
		// {
			// if(strpos($url,$v) === 0)
			// {
				// $url = str_replace($v,$k,$url);
			// }
		// }
		// return BASE_URL.'/'.$url;
	// }
// }
?>