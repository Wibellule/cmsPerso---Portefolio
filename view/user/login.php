<div class="page-header">
	<h1><?php echo 'Zone r&eacute;serv&eacute;e';?></h1>
</div>
	<form class="form-horizontal" method="post" action="<?php echo router::url('user/login');?>">
		<?php echo $this->form->input('login','Identifiant');?>
		<?php echo $this->form->input('password','Mot de passe', array('type'=>'password'));?>
		<div class="controls">
			<input class="btn btn-primary" type="submit" value="Connexion">
		</div>
	</form>
<div class="page-header">
</div>