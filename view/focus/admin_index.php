<div class="page-header">
	<h1><?php echo $total;?> Focus</h1>
</div>
<?php 
	if($total == 0){
		echo "<div class='hero-unit'>Il n'y a actuellement aucun focus en base</div>";
	}else{?>
<table class='table'>
	<thead>
		<tr>
			<th>ID</th>
			<th>Titre</th>
			<th>Lien</th>
			<th>Image</th>
			<th>Statut</th>
			<th>Position</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($focus as $k=>$v):?>
			<tr>
				<td><?php echo $v->id;?></td>
				<td><?php echo $v->name;?></td>
				<td><?php echo $v->slug;?></td>
				<td><?php echo $v->file;?></td>
				<td><span class="label <?php echo ($v->online==1)?'label-success':'label-important';?>"><?php echo ($v->online==1)?'En ligne':'Hors ligne';?></span></td>
				<td>
					<a href="<?php echo router::url('admin/focus/edit/'.$v->id);?>"><i class="icon-edit"></i>&nbsp;Editer</a>
					<a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?');" href="<?php echo router::url('admin/focus/delete/'.$v->id);?>"><i class="icon-trash"></i>&nbsp;Supprimer</a>
				</td>
				<td><?php echo $v->position;?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php }?>
<a href="<?php echo router::url('admin/focus/edit');?>" class="btn btn-primary">Ajouter un focus</a>