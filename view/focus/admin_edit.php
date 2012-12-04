<div class='page-header'>
	<h1>Editer un focus</h1>
</div>
<form class="form-horizontal" action="<?php echo router::url('admin/focus/edit/'.$id);?>" method="post" enctype="multipart/form-data">
		<?php echo $this->form->input('id','hidden');?>
		<?php echo $this->form->input('name','Titre');//echo debug($image[0]->file);?>
		<?php echo $this->form->input('slug','Lien');?>
		<?php //if($focus[0]->file != ''){?>
		<?php foreach($image as $k=>$v):?>
		<div class="controls"><img width="100px" height="100px" src="<?php echo router::webroot('img/'.$v->file);?>"></div>
		<div class="controls"><a onclick="return confirm('Voulez-vous vraiment supprimer cette image ?');" href="<?php echo router::url('admin/focus/delete_pic/'.$v->id);?>"><i class="icon-trash"></i>&nbsp;Supprimer</a></div>
		<?php endforeach;?>
		<?php //}else{?><!--<div class="controls"><p>Il n'y a pas d'image associ&eacute;e &agrave; ce focus</p></div>--><?php //} ?>
		<?php echo $this->form->input('file','Image',array('type'=>'file'));?>
		<?php echo $this->form->input('online','En ligne',array('type'=>'checkbox'));?>
		<?php echo $this->form->input('position','Position');?>
		<input class="btn btn-primary" type="submit" value="Envoyer">
</form>

