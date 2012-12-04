<?php
class session
{
	public function __construct()
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
	}
	
	public function setFlash($message,$type = 'success')
	{
		$_SESSION['flash'] = array(
			'message'	=> $message,
			'type'		=> $type
		);
	}
	
	public function flash()
	{
		if(isset($_SESSION['flash']['message']))
		{
			$html = '<div class="alert alert-'.$_SESSION['flash']['type'].'">'.$_SESSION['flash']['message'].'</div>';
			$_SESSION['flash'] = array();
			return $html;
		}
	}
	
	public function write($key,$value)
	{
		$_SESSION[$key] = $value;
	}
	
	public function delete($key){
		unset($_SESSION[$key]);
	}
	
	public function read($key = null)
	{
		if($key)
		{
			if(isset($_SESSION[$key]))
			{
				return $_SESSION[$key];
			}
			else
			{
				return false;
			}
		}
		else
		{
			return $_SESSION;
		}
	}
	
	public function isLogged()
	{
		return isset($_SESSION['user']->id);
	}
	
}
?>

























