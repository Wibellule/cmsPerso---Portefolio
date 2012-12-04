<?php 
class conf
{
	static $debug = 1;
	static $databases = array(
	'default' => array(
		'host'		=> 'localhost',
		'database' 	=> 'cms',
		'login'		=> 'root',
		'password'	=> ''
		)
	);
}

router::prefix('cockpit','admin');

router::connect('/','home/index');
router::connect('cockpit','cockpit/post/index');
router::connect('post/:slug-:id','post/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
router::connect('blog/:action','post/:action');
router::connect('page/:slug-:id','page/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
?>