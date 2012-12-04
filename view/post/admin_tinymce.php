<ul>
	<?php foreach($posts as $k=>$v):?>
		<li><a href="#" onclick="FileBrowserDialogue.sendURL('<?php echo router::url($v->type.'/view/id:'.$v->id.'/slug:'.$v->slug);?>')"><?php echo ucfirst($v->type);?> : <?php echo $v->name;?></a></li>
	<?php endforeach;?>
</ul>
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