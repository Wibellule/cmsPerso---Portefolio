<?php //echo debug($images); echo debug($_FILES);?>
<table class='table'>
	<thead>
		<tr>
			<th>Image</th>
			<th>Titre</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($images as $k=>$v):?>
			<tr>
				<td>
					<a href="#" onclick="FileBrowserDialogue.sendURL('<?php echo router::webroot('img/'.$v->file);?>')">
						<img width="100px" height="100px" src="<?php echo router::webroot('img/'.$v->file);?>">
					</a>
				</td>
				<td><?php echo $v->name;?></td>
				<td>
					<a onclick="return confirm('Voulez-vous vraiment supprimer cette image ?');" href="<?php echo router::url('admin/media/delete/'.$v->id);?>"><i class="icon-trash"></i>&nbsp;Supprimer</a>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<div class="page-header">
	<h1>Ajouter une image</h1>
</div>
<form class="form-horizontal" action="<?php echo router::url('admin/media/index/'.$post_id);?>" method="post" enctype="multipart/form-data">
	<?php echo $this->form->input('file','Image',array('type'=>'file'));?>
	<?php echo $this->form->input('name','Titre');?>
	<input class="btn btn-primary" type="submit" value="Envoyer">
</form>
<script type="text/javascript" src="<?php echo router::webroot('js/tinymce/tiny_mce_popup.js');?>"></script>
<script type="text/javascript">
var FileBrowserDialogue = {
    init : function () {
        // Here goes your code for setting your custom things onLoad.
    },
    sendURL : function (URL) {
        // var URL = document.my_form.my_field.value;
        var win = tinyMCEPopup.getWindowArg("window");

        // insert information now
        win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

        // are we an image browser
        if (typeof(win.ImageDialog) != "undefined") {
            // we are, so update image dimensions...
            if (win.ImageDialog.getImageData)
                win.ImageDialog.getImageData();

            // ... and preview if necessary
            if (win.ImageDialog.showPreviewImage)
                win.ImageDialog.showPreviewImage(URL);
        }

        // close popup window
        tinyMCEPopup.close();
    }
}

tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script>