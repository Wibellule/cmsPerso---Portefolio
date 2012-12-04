<?php 
class request
{
	public $url; // URL appel�e par l'utilisateur
	public $page = 1;//Pagination
	public $prefix = false;//Pour acceder � l'admin
	public $data = false;//Pour l'envoie des donn�es de modif des articles
	
	function __construct()
	{
		$this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		if(isset($_GET['page']))
		{
			if(is_numeric($_GET['page']))
			{
				if($_GET['page'] > 0)
				{
					$this->page = round($_GET['page']);
				}
			}
		}
		if(!empty($_POST))
		{
			$this->data = new stdClass();//Seule mani�re de d�clarer un nouvel objet vide
			foreach($_POST as $k=>$v)
			{
				$this->data->$k=$v;
			}
			// debug($this->data);
		}
	}
}
?>