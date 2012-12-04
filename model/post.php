<?php

class post extends model
{
	var $validate = array(
		'name'	=> array(
			'rule'		=> 'notEmpty',
			'message'	=> 'Vous devez pr&eacute;ciser un titre'
		),
		'slug'	=> array(
			'rule'		=> '([a-z0-9\-]+)',
			'message'	=> 'L\'url n\'est pas valide'
		)
	);

	function validates($data)//à mettre dans le model.php
	{
		$errors = array();
		foreach($this->validate as $k=>$v)
		{
			if(!isset($data->$k))
			{
				$errors[$k] = $v['message'];
			}
			else
			{
				if($v['rule'] == 'notEmpty')
				{
					if(empty($data->$k))
					{
						$errors[$k] = $v['message'];
					}
				}
				elseif(!preg_match('/^'.$v['rule'].'$/',$data->$k))//Mettre les futures règles ici, genre pour le mail
				{
					$errors[$k] = $v['message'];
				}
			}
		}
		// debug($errors);
		// die();
		$this->errors = $errors;
		if(isset($this->form))
		{
			$this->form->errors = $errors;
		}
		if(empty($errors))
		{
			return true;
		}
		return false;
	}
}

?>