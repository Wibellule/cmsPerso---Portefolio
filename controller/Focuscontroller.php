<?php
class Focuscontroller extends controller{

	function index(){
	}
	
	function view(){
	}

	function admin_index(){
		$this->loadModel('focus');
		$d['focus'] = $this->focus->find(array(
			'fields'	=>	'id,name,slug,file,online,position'
		));
		$d['total'] = count($d['focus']);
		// debug($d['total']);
		$this->set($d);
	}
	
	function admin_edit($id = null){
		$this->loadModel('focus');
		if($id === null)
		{
			$focus = $this->focus->findFirst(array(
				'conditions'	=> array('online'=> -1)
			));
			if(!empty($focus))
			{
				$id = $focus->id;
			}
			else
			{
				$this->focus->save(array(
					'online'	=> -1
				));
				$id = $this->focus->id;
			}
		}
		$d['id'] = $id;
		if($this->request->data && !empty($_FILES['file']['name']))
		{
			//Faire les vérifications de type ici
			if(strpos($_FILES['file']['type'], 'image') !== false)
			{
				$dir = WEBROOT.DS.'img'.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777);//Crée le répertoire s'il n'existe pas
				move_uploaded_file($_FILES['file']['tmp_name'],$dir.DS.$_FILES['file']['name']);
				$this->focus->save(array(
					'name'		=> $this->request->data->name,
					'file'		=> date('Y-m').'/'.$_FILES['file']['name'],
					'type'		=> 'img'
				));
				$this->session->write('file_focus',date('Y-m').'/'.$_FILES['file']['name']);
				$this->session->setFlash("L'image a bien &eacute;t&eacute; upload&eacute;e");
			}
			else
			{
				$this->form->errors['file'] = "Le fichier n'est pas une image";
			}
		}
		if($this->request->data)
		{			
			if($this->focus->validates($this->request->data)){
				$this->request->data->file = $this->session->read('file_focus');
				// $this->request->data->online = $this->request->data->online;
				$this->focus->save($this->request->data);
				$this->session->setFlash('Le contenu a bien &eacute;t&eacute; modifi&eacute;');
				$id = $this->focus->id;
				$this->redirect('admin/focus/index');
			}else{
				$this->session->setFlash('Merci de bien vouloir corriger vos informations','error');
			}
		}else{
			if($id){
				$this->request->data = $this->focus->findFirst(array(
					'conditions'	=> array('id'=>$id)		
				));
				// $d['id'] = $id;
			}
		}
		$d['image'] = $this->focus->find(array(
			'conditions'	=> array('id'	=> $id)
		));
		$this->set($d);
	}

}
?>