<div class="page-header">
	<h1>Le blog</h1>
</div>
<div class='hero-unit'>
<?php //echo BASE_URL.'/post/view/'.$v->id;?>
<?php foreach($posts as $k=>$v):?>
<div class="clearfix">
	<h2><?php echo $v->name; ?></h2>
	<?php echo $v->content; ?>
	<p><a href='<?php echo router::url("post/view/id:{$v->id}/slug:{$v->slug}");?>'>Lire la suite &rarr;</a></p>
</div>
<?php endforeach;?>
</div>
<div class="pagination">
	<ul>
		<?php for($i=1;$i <= $page; $i++):?>
		<li <?php if($i==$this->request->page) echo "class='active'";?>><a href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
		<?php endfor;?>
	</ul>
</div>
