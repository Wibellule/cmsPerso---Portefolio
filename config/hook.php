<?php
if($this->request->prefix == 'admin')
{
	$this->layout = 'admin';
	if(!$this->session->isLogged())
	{
		$this->redirect('user/login');
	}
}
?>