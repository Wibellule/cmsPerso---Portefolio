<?php 
class Mediacontroller extends controller
{
	function admin_index($id)
	{
		$this->loadModel('media');
		if($this->request->data && !empty($_FILES['file']['name']))
		{
			//Faire les vérifications de type ici
			if(strpos($_FILES['file']['type'], 'image') !== false)
			{
				$dir = WEBROOT.DS.'img'.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777);//Crée le répertoire s'il n'existe pas
				move_uploaded_file($_FILES['file']['tmp_name'],$dir.DS.$_FILES['file']['name']);
				$this->media->save(array(
					'name'		=> $this->request->data->name,
					'file'		=> date('Y-m').'/'.$_FILES['file']['name'],
					'post_id'	=> $id,
					'type'		=> 'img'
				));
				$this->session->setFlash("L'image a bien &eacute;t&eacute; upload&eacute;e");
			}
			else
			{
				$this->form->errors['file'] = "Le fichier n'est pas une image";
			}
		}
		// debug($this->request->data);
		// debug($_FILES);
		$this->layout = 'modal';
		$d['images'] = $this->media->find(array(
			'conditions'	=> array('post_id'	=> $id)
		));
		$d['post_id'] = $id;
		$this->set($d);
	}
	
	function admin_delete($id)
	{
		$this->loadModel('media');
		$media = $this->media->findFirst(array(
			'conditions'	=> array('id'=>$id)
		));
		unlink(WEBROOT.DS.'img'.DS.$media->file);
		$this->media->delete($id);
		$this->session->setFlash("L'image a bien &eacute;t&eacute; supprim&eacute;e");
		$this->redirect('admin/media/index/'.$media->post_id);
	}
}
?>