<?php 
class Pagecontroller extends controller
{
	// function view($name)
	// {
		// $this->set(array('phrase' => 'Salut','nom' => 'Machin'));
		// $this->render('index');
	// }
	
	// function index(){
		// $this->render('index');
	// }
	
	function admin_index()
	{
		$this->loadModel('post');
		$conditions = array('type' => 'page');
		$d['total'] = $this->post->findCount($conditions);
		$d['pages'] = $this->post->find(array(
			"conditions"	=>	$conditions
		));
		$this->set($d);
	}
	
	function view($id,$slug)
	// function view($id)
	{
		/*Ancienne version du code*/
		// $this->loadModel('post');
		// $d['page'] = $this->post->findFirst(array('conditions' => array('id' => $id,'type' => 'page','online' => 1)));
		// if(empty($d['page']))
		// {
			// $this->e404('Page introuvable');
		// }
		// $d['pages'] = $this->post->find(
			// array('conditions' => array('type' => 'page'))
		// );

		// $this->set($d);
		
		$this->loadModel('post');
		$d['pages'] = $this->post->findFirst(array(
			'fiels'			=> 'id,slug,content,name',
			'conditions'	=> array('type' => 'page','id' => $id,'online' => 1)
		));
		// debug($d['pages']);
		if(empty($d['pages']))
		{
			$this->e404('Page introuvable');
		}
		if($slug != $d['pages']->slug)
		{
			$this->redirect("page/view/id:$id/slug:".$d['pages']->slug,301);
		}
		$this->set($d);
	}
	
	/**
	*Permet de récupérer les pages pour le menu
	**/
	function getMenu()
	{
		$this->loadModel('post');
		return $this->post->find(array('conditions' => array('type' => 'page','online' => 1)));
	}
	
	/**
	*Permet de éditer une page
	**/
	function admin_edit($id = null)
	{
		$this->loadModel('post');
		if($id === null)
		{
			$page = $this->post->findFirst(array(
				'conditions'	=> array('online'=> -1)
			));
			if(!empty($page))
			{
				$id = $page->id;
			}
			else
			{
				$this->post->save(array(
					'online'	=> -1
				));
				$id = $this->post->id;
			}
		}
		$d['id'] = $id;
		if($this->request->data)
		{
			if($this->post->validates($this->request->data))
			{
				$this->request->data->type = 'page';
				$this->request->data->created = date('Y-m-d h:i:s');
				//$this->request->data->user_id = '0';//Id utilisateur
				$this->post->save($this->request->data);
				$this->session->setFlash('Le contenu a bien &eacute;t&eacute; modifi&eacute;');
				$id = $this->post->id;
				$this->redirect('admin/page/index');
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
				$this->request->data = $this->post->findFirst(array(
					'conditions'	=> array('id'=>$id)		
				));
				// $d['id'] = $id;
			}
		}
		$this->set($d);
	}
	/**
	*Permet de supprimer un article
	**/
	function admin_delete($id)
	{
		$this->loadModel('post');
		$this->post->delete($id);
		$this->session->setFlash('Le contenu a bien &eacute;t&eacute; supprim&eacute;');
		$this->redirect('admin/page/index');
		// session_destroy();
	}
	
	/**
	*Permet de lister les contenus
	**/
	function admin_tinymce()
	{
		$this->loadModel('post');
		$this->layout = 'modal';
		$d['pages'] = $this->post->find();
		$this->set($d);
	}
	
}
?>