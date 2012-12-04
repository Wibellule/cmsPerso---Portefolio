<?php 
class model
{
	static $connections = array(); //Pour sauvegarder les connexions

	public $conf = 'default';
	public $table = false;
	public $db;
	public $primaryKey = 'id';//Pour changer la clé primaire dans certains modèles
	public $id;//clé primaire de ma table
	public $errors = array();//Pour gérer les erreurs lors de la validation des formulaires
	public $form;//Formulaire qui correspondra au model donné
	
	public function __construct()
	{
		//Initialisation de plusieurs variables
		if($this->table === false)//table non initialisé dans le model
		{
			$this->table = strtolower(get_class($this)).'s';
		}
		//Connexion à la base
		$conf = conf::$databases[$this->conf];
		if(isset(model::$connections[$this->conf]))//Vérifier si la connexion est deja existante
		{
			$this->db = model::$connections[$this->conf];
			return true;
		}
		try
		{
			$pdo = new PDO(
			'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
			$conf['login'],$conf['password']);
			$pdo->exec('SET NAMES utf8');
			// $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
			model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;
		}
		catch(PDOException $e)
		{
			if(conf::$debug >= 1)
			{
				die($e->getMessage());
			}
			else
			{
				die('Impossible de se connecter à la base');
			}
		}
	}
	
	public function find($req = array())
	{
		$sql = 'SELECT ';	

		//Selection des champs
		if(isset($req['fields']))
		{
			if(is_array($req['fields']))
			{
				$sql .= implode(', ',$$req['fields']);
			}
			else
			{
				$sql .= $req['fields'];
			}
		}
		else
		{
			$sql .='*';
		}
		
		$sql .= ' FROM '.$this->table.' as '.get_class($this).' ';
		
		//Construction de la condition
		if(isset($req['conditions']))
		{
			$sql .= 'WHERE ';
			if(!is_array($req['conditions']))
			{
				$sql .= $req['conditions'];
			}
			else
			{
				$cond = array();
				foreach($req['conditions'] as $k=>$v)
				{
					if(!is_numeric($v))
					{
						$v = "'".mysql_real_escape_string($v)."'";
						//print_r($v);
					}
					$cond[] = "$k=$v";
				}
				$sql .= implode(' AND ',$cond);
			}
		}
		//Construction de la limite
		if(isset($req['limit']))
		{
			$sql .= ' LIMIT '.$req['limit'];
		}
		// die($sql);
		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function findFirst($req)
	{
		return current($this->find($req));
	}
	
	public function findCount($conditions)
	{
		$res = $this->findFirst(array(
			'fields' 		=> 'COUNT('.$this->primaryKey.') as count',
			'conditions' 	=> $conditions
		));
		return $res->count;
	}
	
	public function delete($id)
	{
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->db->query($sql);
	}
	
	public function save($data)
	{
		$key = $this->primaryKey;
		$fields = array();
		$d = array();
		// if(isset($data->$key))unset($data->$key);//NE PAS METTRE
		foreach($data as $k=>$v)
		{
			if($k!=$this->primaryKey)
			{
				$fields[] = "$k=:$k";
				$d[":$k"] = $v;
			}
			elseif(!empty($v))
			{
				$d[":$k"] = $v;
			}
		}
		if(isset($data->$key) && !empty($data->$key))
		{
			$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key;
			$action = 'update';
		}
		else
		{
			// if(isset($data->$key))unset($data->$key);NE PAS METTRE
			$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$action = 'insert';
		}
		// debug($sql);
		// debug($data->$key);
		// debug($data);
		$pre = $this->db->prepare($sql);
		$pre->execute($d);
		if($action == 'insert')
		{
			$this->id = $this->db->lastInsertId();//Objet PDO
		}
		// debug($this->id);
	}
}
?>



















