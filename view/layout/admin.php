<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<title><?php echo isset($title_for_layout)?$title_for_layout:'Administration';?></title>
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
</head>
<body>
	<div class='navbar' style='position:static;'>
		<div class='navbar-inner'>
			<a class="brand" href="<?php echo router::url('admin/post/index');?>">Administration</a>
			
				<div class="btn-toolbar">
					<div class="btn-group">
						<a class="btn" href="<?php echo router::url('/');?>" title=""><i class="icon-home"></i></a>
						<a class="btn" href="<?php echo router::url('admin/post/index');?>" title=""><i class="icon-tag"></i>&nbsp;Articles</a>
						<a class="btn" href="<?php echo router::url('admin/page/index');?>" title=""><i class="icon-file"></i>&nbsp;Pages</a>
						<a class="btn" href="<?php echo router::url('admin/slider/index');?>" title=""><i class="icon-th-large"></i>&nbsp;Sliders</a>
						<a class="btn" href="<?php echo router::url('admin/focus/index');?>" title=""><i class="icon-th"></i>&nbsp;Focus</a>
						<a class="btn" href="<?php echo router::url('admin/emploi/index');?>" title=""><i class="icon-briefcase"></i>&nbsp;Emplois</a>
						<a class="btn" href="<?php echo router::url('admin/education/index');?>" title=""><i class="icon-tasks"></i>&nbsp;Etudes</a>
						<a class="btn" href="<?php echo router::url('admin/skill/index');?>" title=""><i class="icon-refresh"></i>&nbsp;Compétences</a>
						<a class="btn" href="<?php echo router::url('user/logout');?>" title=""><i class="icon-ban-circle"></i>&nbsp;Déconnexion</a>
					</div>
				</div>
			
		</div>
	</div>
		
	<div class='container' style="padding-top:60px;">
		<?php echo $this->session->flash(); ?>
		<?php echo $content_for_layout;?>
	</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</body>
</html>
















