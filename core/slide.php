<?php
class slide{
	
	public $controller;
	public $errors;
	
	public function __construct($controller)
	{
		$this->controller = $controller;
	}
	
	public function create($name,$img,$id){
		$html = '<div id="slide'.$id.'" class="slide">';
		$html .= '<div class="visual"><img src="'.router::webroot('img/'.$img).'"/></div>';
		$html .= '<div class="title">'.$name.'</div></div>';
		return $html;
	}

}
?>