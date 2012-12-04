<?php
function debug($var)
{
	if(conf::$debug>0)
	{
		$debug = debug_backtrace();
		echo '<p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle();return false;"><strong>'.$debug[0]['file'].'</strong> '.$debug[0]['line'].'</a></p>';
		echo '<ol>';
		foreach($debug as $k=>$v)
		{
			if($k>0)//on ne veut pas les infos concernant le 1er fichier
			{
				echo '<li><strong>'.$v['file'].'</strong> '.$v['line'].'</li>';
			}
		}
		echo '</ol>';
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
}

function getElement($name){
	if(file_exists(ELEMENTS.DS.$name.'.php')){
		require ELEMENTS.DS.$name.'.php';
	}else{
		echo "le fichier est manquant";
	}
}
?>