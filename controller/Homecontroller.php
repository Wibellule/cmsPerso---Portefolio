<?php
class Homecontroller extends controller{

	function index(){
	
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