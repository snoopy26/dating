<!-- breadcumb -->
<ul class="breadcrumb">
	<?php 
	$menus = array(
		'about',
		'details',
		'design',
		'looking for',
		'questions',
		'finish'
	);
	$count = count($menus);
	foreach($menus as $i => $menu){
		$sel = "";
		if ($menu == $current_menu) $sel = "active";
	?>
		<li class="<?php echo $sel; ?>">
			<?php 
			if (!empty($sel)){
			?>
			<b><?php echo ucfirst($menu); ?></b> 
			<?php }else{ ?>
			<a href="#"><?php echo ucfirst($menu); ?></a>
			<?php } ?>
			<?php if ($i != $count - 1){ ?>
			<span class="divider">&raquo;</span>
			<?php } ?>
		</li>
	<?php
	}
	?>
</ul>