<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<title><?php echo isset($title_for_layout)?$title_for_layout:'Mon cms';?></title>
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo router::webroot('css/carrousel.css');?>">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo router::webroot('js/carrousel.js');?>"></script>
	
</head>
<body>
	<!--<div class='navbar' style='position:static;'>
		<div class='navbar-inner'>
		<a class="brand" href='#'>CMS</a>
			<div class="btn-toolbar">
				<div class="btn-group">
					<a class="btn" href="<?php //echo router::url('home/index');?>"><i class="icon-home"></i></a>
					<a class="btn" href='<?php //echo router::url('post/index');?>'><i class="icon-tag"></i>&nbsp;Actualit&eacute;</a>
					
					<?php //$pagesMenu = $this->request('Page','getMenu');?>
					<?php //foreach($pagesMenu as $p):?>
						<a class="btn" href='<?php //echo BASE_URL.'/page/view/'.$p->id; ?>'><i class="icon-file"></i>&nbsp;<?php //echo $p->name;?></a>
					<?php //endforeach;?>
					// <?php
					// if($this->session->isLogged())
					// {
						// $url = router::url('cockpit');
						// $html = "<a class='btn' href='$url'>";
						// $html .= "<i class='icon-wrench'></i>";
						// $html .= "&nbsp;Administration</a>";
						// echo $html;
					// }
					// else
					// {
						// $url = router::url('user/login');
						// $html = "<a class='btn' href='$url'>";
						// $html .= "<i class='icon-barcode'></i>";
						// $html .= "&nbsp;Connexion</a>";
						// echo $html;
					// }
					// ?>
				</div>
			</div>
		</div>
	</div>-->
	
	<div class='container' style="padding-top:60px;">
		<?php echo $this->session->flash(); ?>
		<?php echo $content_for_layout;?>
	</div>
</body>
</html>