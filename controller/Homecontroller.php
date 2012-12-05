<?php
class Homecontroller extends controller{

	function index(){
		/**
		*DATAS
		*/
		$this->loadModel('data');
		$conditions = array('id' => 1);
		$d['datas'] = $this->data->find(array(
			'conditions' 	=> $conditions
		));
		/**
		*EMPLOIS
		*/
		$this->loadModel('emploi');
		$conditions = array('online' => 1);
		$d['emplois'] = $this->emploi->find(array(
			'conditions'	=> $conditions
		));
		$this->set($d);
		/**
		*SLIDERS
		*/
		$this->loadModel('slider');
		$conditions = array('online' => 1);
		$d['sliders'] = $this->slider->find(array(
			'conditions' 	=> $conditions
		));
		$this->set($d);
		
		/**
		*FOCUS
		*/
		$this->loadModel('focus');
		$conditions = array('online' => 1);
		$d['focus'] = $this->focus->find(array(
			'conditions' 	=> $conditions
		));
		$this->set($d);
		
		/**
		*FOOTER
		*/
	}
	
	function admin_index(){
	}

}
?>