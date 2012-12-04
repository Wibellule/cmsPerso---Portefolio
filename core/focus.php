<?php
class Hfocus{

	public $controller;
	public $errors;
	
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	
	public function create($name,$img,$slug,$id){
		// $html = '<style>.focus{ width: 199px;display: inline;float: left;margin: 0 15px 0 0;padding: 0 17px 0 0;}<style>';
		$html = '<div class="focus'.$id.' style="height: 189px; position: relative;">';
		$html .='<h3>'.$name.'</h3>';
		$html .='<p><img alt="" src="'.router::webroot('img/'.$img).'" style="margin-right: 5px; margin-bottom: 5px; float: left; width: 48px; height: 48px;"></p>';
		$html .='<p><a href="'.router::webroot('').'" style="position: absolute; bottom: 0px;">En savoir plus</a></p></div>';
		return $html;
	}

}
?>