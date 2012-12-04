<div class='page-header'>
	<h1>Editer une page</h1>
</div>
<form class="form-horizontal" action="<?php echo router::url('admin/page/edit/'.$id);?>" method="post">
		<?php echo $this->form->input('id','hidden');?>
		<?php echo $this->form->input('name','Titre');?>
		<?php echo $this->form->input('slug','Url');?>
		<?php echo $this->form->input('content','Contenu',array('type'=>'textarea','class'=>'input-xxlarge wysiwyg','rows'=>5));?>
		<?php echo $this->form->input('online','En ligne',array('type'=>'checkbox'));?>
		<input class="btn btn-primary" type="submit" value="Envoyer">
</form>

<script type="text/javascript" src="<?php echo router::webroot('js/tinymce/tiny_mce.js');?>"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "specific_textareas",
		editor_selector : "wysiwyg",
        theme : "advanced",
		relative_urls : false,
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,image",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
		
		//Répertoire pour les images
		file_browser_callback : 'fileBrowser'

        
});

function fileBrowser(field_name, url, type, win)
{
	if(type == 'file'){
		var explorer = '<?php echo router::url('admin/post/tinymce/');?>';
	}else{
		var explorer = '<?php echo router::url('admin/media/index/'.$id);?>';
	}
	tinyMCE.activeEditor.windowManager.open
	(
		{
			file : explorer,
			title : 'Gallerie',
			width : 500,
			height : 500,
			resizable : 'yes',
			inline : 'yes',
			close_previous : 'no'
		},
		{
			window : win,
			input : field_name
		}
	);
	return false;//pour eviter que le clic declenche autre chose
}
</script>