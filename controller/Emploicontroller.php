<?php
class Emploicontroller extends controller{

	function index(){
	}
	
	function view(){
	}

	function admin_index(){
		$this->loadModel('emploi');
		$d['emploi'] = $this->emploi->find(array(
			'fields'	=>	'id,title,subtitle,content,date,online'
		));
		$d['total'] = count($d['emploi']);
		// debug($d['total']);
		$this->set($d);
	}
	
	function admin_edit($id = null){
		$this->loadModel('emploi');
		if($id === null)
		{
			$emploi = $this->emploi->findFirst(array(
				'conditions'	=> array('online'=> -1)
			));
			if(!empty($emploi))
			{
				$id = $emploi->id;
			}
			else
			{
				$this->emploi->save(array(
					'online'	=> -1
				));
				$id = $this->emploi->id;
			}
		}
		$d['id'] = $id;
		if($this->request->data)
		{
			if($this->emploi->validates($this->request->data))
			{
				// $this->request->data->type = '';
				// $this->request->data->created = date('Y-m-d h:i:s');
				//$this->request->data->user_id = '0';//Id utilisateur
				$this->emploi->save($this->request->data);
				$this->session->setFlash('Le contenu a bien &eacute;t&eacute; modifi&eacute;');
				$id = $this->emploi->id;
				$this->redirect('admin/emploi/index');
			}
			else
			{
				$this->session->setFlash('Merci de bien vouloir corriger vos informations','error');
			}
		}
		else
		{
			if($id)
			{
				$this->request->data = $this->emploi->findFirst(array(
					'conditions'	=> array('id'=>$id)		
				));
				// $d['id'] = $id;
			}
		}
		$this->set($d);
	}

}
?>