<?php 
class Postcontroller extends controller
{
	function index()
	{
		$perPage = 1;
		$this->loadModel('post');
		$conditions = array('type' => 'post','online' => 1);
		$d['posts'] = $this->post->find(array(
			'conditions' 	=> $conditions,
			'limit' 		=> ($perPage*($this->request->page-1)).','.$perPage
		));
		// die(($perPage*($this->request->page)).','.$perPage);
		$d['total'] = $this->post->findCount($conditions);
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}
	
	function view($id,$slug)
	{
		$this->loadModel('post');
		$d['posts'] = $this->post->findFirst(array(
			'fiels'			=> 'id,slug,content,name',
			'conditions'	=> array('type' => 'post','id' => $id,'online' => 1)
		));
		if(empty($d['posts']))
		{
			$this->e404('Page introuvable');
		}
		if($slug != $d['posts']->slug)
		{
			$this->redirect("post/view/id:$id/slug:".$d['posts']->slug,301);
		}
		// debug($d['posts']);
		$this->set($d);
	}
	
	/**
	*Administration
	**/
	function admin_index()
	{
		$perPage = 10;
		$this->loadModel('post');
		$conditions = array('type' => 'post');
		$d['posts'] = $this->post->find(array(
			'fields'		=> 'id,name,online',
			'conditions' 	=> $conditions,
			'limit' 		=> ($perPage*($this->request->page-1)).','.$perPage
		));
		$d['total'] = $this->post->findCount($conditions);
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}
	/**
	*Permet de éditer un article
	**/
	function admin_edit($id = null)
	{
		$this->loadModel('post');
		if($id === null)
		{
			$post = $this->post->findFirst(array(
				'conditions'	=> array('online'=> -1)
			));
			if(!empty($post))
			{
				$id = $post->id;
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
				$this->request->data->type = 'post';
				$this->request->data->created = date('Y-m-d h:i:s');
				//$this->request->data->user_id = '0';//Id utilisateur
				$this->post->save($this->request->data);
				$this->session->setFlash('Le contenu a bien &eacute;t&eacute; modifi&eacute;');
				$id = $this->post->id;
				$this->redirect('admin/post/index');
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
		// debug($this->request->data);
	}
	/**
	*Permet de supprimer un article
	**/
	function admin_delete($id)
	{
		$this->loadModel('post');
		$this->post->delete($id);
		$this->session->setFlash('Le contenu a bien &eacute;t&eacute; supprim&eacute;');
		$this->redirect('admin/post/index');
		// session_destroy();
	}
	
	/**
	*Permet de lister les contenus
	**/
	function admin_tinymce()
	{
		$this->loadModel('post');
		$this->layout = 'modal';
		$d['posts'] = $this->post->find();
		$this->set($d);
	}
	
	
	
}
?>






















