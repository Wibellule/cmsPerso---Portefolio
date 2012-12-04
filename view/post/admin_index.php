<div class="page-header">
	<h1><?php echo $total;?> Articles</h1>
</div>
<table class='table'>
	<thead>
		<tr>
			<th>ID</th>
			<th>Titre</th>
			<th>Statut</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($posts as $k=>$v):?>
			<tr>
				<td><?php echo $v->id;?></td>
				<td><?php echo $v->name;?></td>
				<td><span class="label <?php echo ($v->online==1)?'label-success':'label-important';?>"><?php echo ($v->online==1)?'En ligne':'Hors ligne';?></span></td>
				<td>
					<a href="<?php echo router::url('admin/post/edit/'.$v->id);?>"><i class="icon-edit"></i>&nbsp;Editer</a>
					<a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?');" href="<?php echo router::url('admin/post/delete/'.$v->id);?>"><i class="icon-trash"></i>&nbsp;Supprimer</a>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<a href="<?php echo router::url('admin/post/edit');?>" class="btn btn-primary">Ajouter un article</a>