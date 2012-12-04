<?php 
class usercontroller extends controller
{
	/**
	*Login
	**/
	function login()
	{
		// debug($this->session->read());
		if($this->request->data)
		{
			$data = $this->request->data;
			$data->password = sha1($data->password);
			$this->loadModel('user');
			$user = $this->user->findFirst(array(
				'conditions'	=> array('login' => $data->login,'password'	=> $data->password)
			));
			if(!empty($user))
			{
				// debug($user);
				$this->session->write('user',$user);
			}
			// debug($data);
			$this->request->data->password = '';
		}
		if($this->session->isLogged())
		{
			$this->redirect('cockpit');
		}
	}
	
	/**
	*Logout
	**/
	function logout()
	{
		unset($_SESSION['user']);
		$this->session->setFlash('Vous &ecirc;tes maintenant d&eacute;connect&eacute;');
		$this->redirect('/');
	}
}
?>